<?php

namespace App\Services\Admin\Content\Themes;

use Illuminate\Http\Request;
use App\Models\Shared\Content\PageAsset;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\Request\ConditionalFileHandler;

class PageAssetService
{
    protected $validator;
    protected $fileHandler;

    public function __construct(ValidationService $validator, ConditionalFileHandler $fileHandler)
    {
        $this->validator = $validator;
        $this->fileHandler = $fileHandler;
    }

    public function store(Request $request): PageAsset
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateStringField(request: $request, field: 'title', max: 200, required: false);

        $asset = new PageAsset();
        $asset->name = $request->name;
        $asset->title = $request->title;
        $asset->page_asset_category_id = $request->page_asset_category_id;
        
        $this->fileHandler->handle(request: $request, model: $asset);
        $asset->type = in_array($request->select['type'] ?? null, ['link', 'image', 'document']) ? $request->select['type'] : null;

        if ($asset->type === 'link' && str_contains($asset->link, 'sdsgissaludbog.maps.arcgis.com')) {
            $asset->type = 'geo';
        }
        
        $asset->order = (PageAsset::max('order') ?? 0) + 1;
        $asset->save();

        return $asset;
    }

    public function update(Request $request, PageAsset $asset): PageAsset
    {   
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateStringField(request: $request, field: 'title', max: 200, required: false);
        
        if ($request->name !== $asset->name) {
            $asset->name = $request->name;
        }

        if ($request->title !== $asset->title) {
            $asset->title = $request->title;
        }

        $this->fileHandler->handle(request: $request, model: $asset);
        
        $asset->type = in_array($request->select['type'] ?? null, ['link', 'image', 'document']) ? $request->select['type'] : null;

        if ($asset->type === 'link' && str_contains($asset->link, 'sdsgissaludbog.maps.arcgis.com')) {
            $asset->type = 'geo';
        }

        $asset->save();

        return $asset;
    }

    public function toggle(PageAsset $asset): PageAsset
    {
        $asset->is_active = !$asset->is_active;
        $asset->save();

        return $asset;
    }

    public function destroy(PageAsset $asset): void
    {
        $asset->delete();
    }
}
