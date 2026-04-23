<?php

namespace App\Services\Admin\Content\Themes;

use Illuminate\Http\Request;
use App\Models\Shared\Content\EstablishmentAsset;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;
use App\Services\Admin\Request\ConditionalFileHandler;

class EstablishmentAssetService
{
    protected ValidationService $validator;
    protected FileConverterService $fileConverter;
    protected ConditionalFileHandler $fileHandler;

    public function __construct(
        ValidationService $validator,
        FileConverterService $fileConverter,
        ConditionalFileHandler $fileHandler
    ) {
        $this->validator = $validator;
        $this->fileConverter = $fileConverter;
        $this->fileHandler = $fileHandler;
    }

    public function store(Request $request): EstablishmentAsset
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateRichTextField(request: $request, field: 'description', min: 30, required: false);

        $asset = new EstablishmentAsset();
        $asset->name = $request->name;
        $asset->category = $request->category;
        $asset->module_id = $request->module_id;

        if ($request->filled('description')) {
            $asset->description = $request->description;
        }

        $this->fileHandler->handle(request: $request, model: $asset);

        $asset->type = in_array($request->select['type'] ?? null, ['link', 'image', 'document']) ? $request->select['type'] : null;

        if ($asset->type === 'link' && str_contains($asset->link, 'sdsgissaludbog.maps.arcgis.com')) {
            $asset->type = 'geo';
        }

        $asset->order = (EstablishmentAsset::where('module_id', $request->module_id)->max('order') ?? 0) + 1;
        $asset->save();

        return $asset;
    }

    public function update(Request $request, EstablishmentAsset $asset): EstablishmentAsset
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateRichTextField(request: $request, field: 'description', min: 30, required: false);

        $asset->name = $request->name;

        if ($request->filled('description') && $request->description !== $asset->description) {
            $asset->description = $request->description;
        }

        $this->fileHandler->handle(request: $request, model: $asset);

        $asset->type = in_array($request->select['type'] ?? null, ['link', 'image', 'document']) ? $request->select['type'] : null;

        if ($asset->type === 'link' && str_contains($asset->link, 'sdsgissaludbog.maps.arcgis.com')) {
            $asset->type = 'geo';
        }
        
        $asset->save();

        return $asset;
    }

    public function toggle(EstablishmentAsset $asset): EstablishmentAsset
    {
        $asset->is_active = !$asset->is_active;
        $asset->save();

        return $asset;
    }

    public function destroy(EstablishmentAsset $asset): void
    {
        $asset->delete();
    }
}
