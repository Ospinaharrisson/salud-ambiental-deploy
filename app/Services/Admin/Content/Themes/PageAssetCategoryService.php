<?php

namespace App\Services\Admin\Content\Themes;

use Illuminate\Http\Request;
use App\Models\Shared\Themes\PageAssetCategory;
use App\Services\Admin\Request\ValidationService;

class PageAssetCategoryService
{
    protected $validator;

    public function __construct(ValidationService $validator)
    {
        $this->validator = $validator;
    }

    public function store(Request $request): PageAssetCategory
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateStringField(request: $request, field: 'groupTitle', max: 200, required: false);
        $this->validator->validateRichTextField(request: $request, field: 'description', min: 30, required: false);

        $this->validateUniqueName($request->name, $request->page_id);

        $category = new PageAssetCategory();
        $category->name = $request->name;
        $category->groupTitle = $request->groupTitle ?? '';
        $category->description = $request->description;
        $category->page_id = $request->page_id;
        $category->save();

        return $category;
    }

    public function update(Request $request, PageAssetCategory $category): PageAssetCategory
    {
        if ($request->name !== $category->name) {
            $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
            $this->validateUniqueName($request->name, $category->page_id);
            $category->name = $request->name;
        }
        if ($request->has('groupTitle')) {
            $this->validator->validateStringField(request: $request, field: 'groupTitle', max: 200, required: false);
            $category->groupTitle = $request->groupTitle ?? '';
        }

        $this->validator->validateRichTextField(request: $request, field: 'description', min: 0, required: false);
        $category->description = $request->description;
        $category->save();

        return $category;
    }

    public function toggle(PageAssetCategory $category): PageAssetCategory
    {
        $category->is_active = !$category->is_active;
        $category->save();

        return $category;
    }

    public function destroy(PageAssetCategory $category): void
    {
        $category->delete();
    }

    protected function validateUniqueName(string $name, int $pageId): void
    {
        $exists = PageAssetCategory::where('page_id', $pageId)
            ->whereRaw('LOWER(name) = ?', [strtolower($name)])
            ->exists();

        if ($exists) {
            back()
                ->with('mensajeError', 'Ya existe una categoría con ese nombre en esta página.')
                ->throwResponse();
        }
    }
}
