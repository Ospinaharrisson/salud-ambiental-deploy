<?php

namespace App\Services\Admin\Content\Themes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Shared\Themes\ChemicalItem;
use App\Models\Shared\Themes\ChemicalStamp;
use App\Models\Shared\Themes\ChemicalItemStamp;
use App\Models\Shared\Themes\ChemicalItemDetail;
use App\Services\Admin\Request\ValidationService;

class ChemicalItemService
{
    protected $validator;

    public function __construct(ValidationService $validator)
    {
        $this->validator = $validator;
    }

    public function currentStep(): int
    {
        foreach ([5, 4, 3, 2, 1] as $step) {
            if (session()->get("step-$step")) {
                return $step + 1;
            }
        }

        return 1;
    }

    public function getSelectedImages()
    {
        $selected = session('item.selected_images', []);

        if (empty($selected)) {
            return collect();
        }

        $imagesSelected = ChemicalStamp::whereIn('id', $selected)->get()->keyBy('id');
    
        return collect($selected)->map(fn($id) => $imagesSelected[$id] ?? null)->filter();
    }

    public function saveItem(Request $request): void
    {
        $this->validator->validateStringField($request, 'name', 200, true);
        $this->validator->validateStringField($request, 'cas_number', 200, false);
        $this->validator->validateStringField($request, 'onu_number', 200, false);

        $this->validator->validateDecimalField($request, 'monthly_stored', true, 12, 2, null, 0, null);
        $this->validator->validateDecimalField($request, 'monthly_used', true, 12, 2, null, 0, null);
        $this->validator->validateDecimalField($request, 'score', true, 12, 2, 'El puntaje del elemento no debe superar la unidad (1)', 0, 1);

        $newData = $request->only([
            'name',
            'cas_number',
            'onu_number',
            'monthly_stored',
            'monthly_used',
            'score',
            'page_id'
        ]);

        $item = session('item', []);
        foreach ($newData as $key => $value) {
            $item[$key] = $value;
        }

        session([
            'item' => $item,
            'step-1' => true
        ]);
    }

    public function saveImages(Request $request): bool
    {
        $selected = $request->input('selected_images', []);
        $selected = array_values(array_unique(array_filter(array_map('intval', $selected), fn($id) => $id > 0)));
        
        if (empty($selected)) {
            return false;
        }

        $item = session('item', []);
        $item['selected_images'] = $selected;

        session([
            'item'   => $item,
            'step-2' => true,
        ]);

        return true;
    }

    public function saveDetails(Request $request, string $type, string $step): bool
    {
        $descriptions = $request->input('descriptions', []);

        foreach ($descriptions as $description) {
            $this->validator->validateStringFromArray($description, 'value', 200, true);
        }
    
        $item = session('item', []);
        $item['details'][$type] = $descriptions;

        session([
            'item' => $item,
            $step => true,
        ]);

        return true;
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $item = new ChemicalItem();
            $item->name = $data['name'];
            $item->cas_number = $data['cas_number'] ?? 'desconocido';
            $item->onu_number = $data['onu_number'] ?? 'desconocido';
            $item->monthly_stored = $data['monthly_stored'];
            $item->monthly_used = $data['monthly_used'];
            $item->score = $data['score'];
            $item->record_page_id = $data['page_id'];
            $item->save();

            if (!empty($data['selected_images'])) {
                foreach ($data['selected_images'] as $index => $stampId) {
                    ChemicalItemStamp::create([
                        'chemical_item_id' => $item->id,
                        'chemical_stamp_id' => $stampId,
                        'order' => ++$index,
                    ]);
                }
            }

            if (!empty($data['details'])) {
                $this->storeDetail($data['details']['economy'] ?? [], 'economy', $item->id);
                $this->storeDetail($data['details']['danger'] ?? [], 'danger', $item->id);
            }

            return $item;
        });
    }

    public function storeDetail(array $details, string $type, int $chemicalItemId)
    {
        foreach ($details as $index => $value) {
            $detail = new ChemicalItemDetail();
            $detail->chemical_item_id = $chemicalItemId;
            $detail->type = $type;
            $detail->value = $value;
            $detail->order = ++$index;
            $detail->save();
        }
    }

    public function updateStamp(array $stamps, int $itemId): void
    {
        $item = ChemicalItem::findOrFail($itemId);

        $pivotData = collect($stamps)
            ->filter(fn($id) => is_numeric($id))
            ->values()
            ->mapWithKeys(fn($id, $index) => [
                (int) $id => [
                    'order' => $index,
                    'is_active' => true,
                ]
            ]);

        $item->stamps()->sync($pivotData->toArray());
    }
    
    public function updateDetails(array $descriptions, int $itemId, string $type): void
    {
        $item = ChemicalItem::findOrFail($itemId);

        $item->details()
            ->where('type', $type)
            ->delete();

        $insertData = collect($descriptions)
            ->filter(fn($desc) => !empty($desc))
            ->values()
            ->map(function ($desc, $index) use ($type, $itemId) {
                return [
                    'chemical_item_id' => $itemId,
                    'value' => $desc,
                    'type' => $type,
                    'order' => $index + 1,
                ];
            })->toArray();

        if (!empty($insertData)) {
            $item->details()->insert($insertData);
        }
    }

    public function update(Request $request, ChemicalItem $item): ChemicalItem
    {
        $this->validator->validateStringField($request, 'name', 200, true);
        $this->validator->validateStringField($request, 'cas_number', 200, false);
        $this->validator->validateStringField($request, 'onu_number', 200, false);

        $this->validator->validateDecimalField($request, 'monthly_stored');
        $this->validator->validateDecimalField($request, 'monthly_used');
        $this->validator->validateDecimalField($request, 'score');

        $item->name = $request->name;
        $item->cas_number = $request->cas_number ?? 'Desconocido';
        $item->onu_number = $request->onu_number ?? 'Desconocido';
        $item->monthly_stored = $request->monthly_stored;
        $item->monthly_used = $request->monthly_used;
        $item->score = $request->score;

        $item->save();

        return $item;
    }

    public function toggle(ChemicalItem $item): ChemicalItem
    {
        $item->is_active = !$item->is_active;
        $item->save();

        return $item;
    }

    public function destroy(ChemicalItem $item): void
    {
        $item->delete();
    }
}
