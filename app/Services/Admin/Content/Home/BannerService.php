<?php

namespace App\Services\Admin\Content\Home;

use Illuminate\Http\Request;
use App\Models\Shared\Content\Banner;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;
use App\Services\Admin\Request\ConditionalFileHandler;

class BannerService
{
    protected $validator;
    protected $fileHandler;
    protected $fileConverter;

    public function __construct(ValidationService $validator, FileConverterService $fileConverter, ConditionalFileHandler $fileHandler)
    {
        $this->validator = $validator;
        $this->fileHandler = $fileHandler;
        $this->fileConverter = $fileConverter;
    }

    public function store(Request $request): Banner
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateImageField(request: $request, field: 'image', required: true);
        
        $banner = new Banner();
        $banner->name = $request->name;
        $banner->image = $this->fileConverter->convertToBase64($request->file('image'));
        
        $this->fileHandler->handle(request: $request, model: $banner, required: false);

        $maxOrder = Banner::max('order') ?? 0;
        $banner->order = $maxOrder + 1;

        $banner->save();

        return $banner;
    }

    public function update(Request $request, Banner $banner): Banner
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        
        if ($request->name !== $banner->name) {
            $banner->name = $request->name;
        }

        if ($request->hasFile('image')) {
            $this->validator->validateImageField(request: $request, field: 'image', required: true);
            $banner->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $this->fileHandler->handle(request: $request, model: $banner, required: false);

        $banner->save();

        return $banner;
    }

    public function toggle(Banner $banner): Banner
    {
        $banner->is_active = !$banner->is_active;
        $banner->save();

        return $banner;
    }

    public function destroy(Banner $banner): void
    {
        $banner->delete();
    }
}
