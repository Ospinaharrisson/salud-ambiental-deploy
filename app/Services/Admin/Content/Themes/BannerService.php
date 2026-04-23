<?php

namespace App\Services\Admin\Content\Themes;

use Illuminate\Http\Request;
use App\Models\Shared\Themes\ModuleBanner;

use App\Services\Admin\FileConverterService;
use App\Services\Admin\Request\ValidationService;

class BannerService
{
    protected $validator;
    protected $fileConverter;

    public function __construct(ValidationService $validator, FileConverterService $fileConverter)
    {
        $this->validator = $validator;
        $this->fileConverter = $fileConverter;
    }

    public function store(Request $request): ModuleBanner
    {
        $this->validator->validateImageField(request: $request, field: 'image', required: true);

        $banner = new ModuleBanner();
        $banner->module_id = $request->module_id;
        $banner->image = $this->fileConverter->convertToBase64($request->file('image'));

        $banner->save();

        return $banner;
    }

    public function update(Request $request, ModuleBanner $banner) : ModuleBanner
    {
        if ($request->image !== $banner->image) {
            $this->validator->validateImageField(request: $request, field: 'image', required: true);
            $banner->image = $this->fileConverter->convertToBase64($request->file('image'));
        }
        
        $banner->save();

        return $banner;
    }

}
