<?php

namespace App\Services\Admin\Content\Home;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Models\Shared\Home\FooterItem;
use App\Services\Admin\Request\ValidationService;


class FooterItemService
{
    protected $validator;

    public function __construct(ValidationService $validator)
    {
        $this->validator = $validator;
    }
    
    public function store(Request $request) : FooterItem
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true, customMessage: 'El Nombre del elemento no es valido.');

        $item = new FooterItem();
        $item->name = $request->name;
        $item->category = $request->category;

        if($request->filled('link'))
        {
            $this->validator->validateLinkField(request: $request, field: 'link', customMessage: 'El enlace no es valido.');
            $item->link = $request->link;
        }

        $maxOrder = FooterItem::max('order') ?? 0;
        $item->order = $maxOrder + 1;

        $item->save();

        return $item;
    }

    public function update(Request $request, FooterItem $item): FooterItem
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true, customMessage: 'El Nombre del elemento no es valido.');
        $item->name = $request->name;

        if($request->filled('link'))
        {
            $this->validator->validateLinkField(request: $request, field: 'link', customMessage: 'El enlace no es valido.');
            $item->link = $request->link;
        }

        $item->save();

        return $item;
    }

    public function toggle(FooterItem $item): FooterItem
    {
        $item->is_active = !$item->is_active;
        $item->save();

        return $item;
    }

    public function getPaginatedFooterGroups(int $perPage = 1): LengthAwarePaginator
    {
        $items = FooterItem::orderByDesc('is_active')
            ->orderBy('order')
            ->get();

        $grouped = $items->groupBy('category');

        $groupedItems = $grouped->map(function ($items, $category) {
            return [
                'category' => $category,
                'items' => $items,
            ];
        })->values();

        $currentPage = request()->input('page', 1);

        return new LengthAwarePaginator(
            $groupedItems->forPage($currentPage, $perPage),
            $groupedItems->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
}
