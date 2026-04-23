<?php

namespace App\Http\Controllers\Admin\Themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Themes\RecordsPage;
use App\Models\Shared\Themes\ChemicalItem;
use App\Models\Shared\Themes\ChemicalStamp;
use App\Services\Admin\Content\Themes\ChemicalItemService;

use App\Helpers\Admin\CurrentModule;

class RecordItemController extends Controller
{
    protected $itemService;

    public function __construct(ChemicalItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    /* #region vistas */
    
    public function recordTableHomeView($module, $page_id)
    {
        $page = RecordsPage::findOrFail($page_id);
        return view('Admin.Dashboard.Themes.records.table.table-home', compact('page'));
    }

    public function recordItemCreateView($module, $page_id)
    {
        $step = $this->itemService->currentStep();
        $images = ChemicalStamp::all();
        $imagesSelected = $this->itemService->getSelectedImages();

        return view('Admin.Dashboard.Themes.records.table.item-create', [
            'module'      => CurrentModule::get(),
            'page_id'     => $page_id,
            'currentStep' => $step,
            'images'      => $images,
            'selected'    => $imagesSelected,
        ]);
    }

    public function recordItemEditView($module, $page_id, $item_id)
    {
        $images = ChemicalStamp::all();
        $item = ChemicalItem::findOrFail($item_id);
        $details = $item->details->groupBy('type')->map->pluck('value');

        return view('Admin.Dashboard.Themes.records.table.item-edit', [
            'page_id' => $page_id,
            'item' => $item,
            'images' => $images,
            'economyDetails' => ($details['economy'] ?? collect())->toArray(),
            'dangerDetails'  => ($details['danger'] ?? collect())->toArray(),
        ]);
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeItem(Request $request, $module, $page_id)
    {
        $this->itemService->saveItem($request);
        
        return redirect()->route('admin.themes.record.item.create', [
            'module'  => $module,
            'page_id' => $page_id,
        ]);
    }

    public function storeRecordStamp(Request $request, $module, $page_id) 
    {
        if (!$this->itemService->saveImages($request)) {
            return redirect()->route('admin.themes.record.item.create', compact('module','page_id'))
            ->with('error', 'Selecciona al menos una imagen.');
        }

        return redirect()->route('admin.themes.record.item.create', [
            'module'  => $module,
            'page_id' => $page_id,
        ]);
    }

    public function storeRecordDetails(Request $request, $module, $page_id) 
    {
        $this->itemService->saveDetails($request, $request->type, $request->step);

        return redirect()->route('admin.themes.record.item.create', [
            'module'  => $module,
            'page_id' => $page_id,
        ]);
    }

    public function storeRecordItem(Request $request, $module, $page_id) 
    {
        $item = session('item');

        if (
            !is_array($item) ||
            empty($item) ||
            empty($item['selected_images']) ||
            !is_array($item['details'] ?? null) ||
            empty($item['details']['economy'] ?? []) ||
            empty($item['details']['danger'] ?? [])
        ) {
            return redirect()
                ->route('admin.themes.record.item', ['module' => CurrentModule::get(), 'page_id' => $page_id])
                ->with('mensajeError', 'Ocurrio un error al almacenar los datos.');
        }

        $this->itemService->store($item);

        session()->forget(['item', 'step-1', 'step-2', 'step-3', 'step-4', 'step-5']);
        return redirect()
            ->route('admin.themes.record.item', ['module' => CurrentModule::get(), 'page_id' => $page_id])
            ->with('mensaje', 'Elemento actualizado correctamente.');
    }

    public function updateRecordStamp(Request $request, $module, $page_id, $item_id)
    {
        $this->itemService->updateStamp($request->input('selected_images'), $item_id);

        return redirect()
            ->route('admin.themes.record.item', ['module' => CurrentModule::get(), 'page_id' => $page_id])
            ->with('mensaje', 'Elemento actualizado correctamente.');
    }

    public function updateRecordDetails(Request $request, $module, $page_id, $item_id)
    {
        $this->itemService->updateDetails($request->input('descriptions', []),$item_id,$request->input('type'));

        return redirect()
            ->route('admin.themes.record.item', ['module' => CurrentModule::get(), 'page_id' => $page_id])
            ->with('mensaje', 'Elemento actualizado correctamente.');
    }

    public function updateRecordItem(Request $request, $module, $page_id, $item_id)
    {
        $item = ChemicalItem::findOrFail($item_id);
        $this->itemService->update($request, $item);
        return redirect()
            ->route('admin.themes.record.item', ['module' => CurrentModule::get(), 'page_id' => $page_id])
            ->with('mensaje', 'Elemento actualizado correctamente.');
    }

    public function toggleRecordItem($module, $page_id, $item_id)
    {
        $item = ChemicalItem::findOrFail($item_id);
        $this->itemService->toggle($item);

        return redirect()
            ->route('admin.themes.record.item', ['module' => CurrentModule::get(), 'page_id' => $page_id])
            ->with('mensaje', 'Elemento actualizado correctamente.');
    }

    public function destroyRecordItem($module, $page_id, $item_id)
    {
        $item = ChemicalItem::findOrFail($item_id);
        $this->itemService->destroy($item);
        return redirect()
            ->route('admin.themes.record.item', ['module' => CurrentModule::get(), 'page_id' => $page_id])
            ->with('mensaje', 'Elemento actualizado correctamente.');
    }

    /* #endregion acciones */
}
