<?php

namespace App\Services\Admin\Content\Home;

use Illuminate\Http\Request;
use App\Models\Shared\Content\FeaturedImage;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;
use App\Services\Admin\Request\ConditionalFileHandler;

class FeaturedImageService
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

    public function store(Request $request): FeaturedImage
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateImageField(request: $request, field: 'image', required: true);

        $image = new FeaturedImage();
        $image->name = $request->name;
        $image->image = $this->fileConverter->convertToBase64($request->file('image'));

        $this->fileHandler->handle(request: $request, model: $image);

        $maxOrder = FeaturedImage::max('order') ?? 0;
        $image->order = $maxOrder + 1;

        $image->save();

        return $image;
    }

    public function update(Request $request, FeaturedImage $image): FeaturedImage
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);

        if ($request->name !== $image->name) {
            $image->name = $request->name;
        }

        if ($request->hasFile('image')) {
            $this->validator->validateImageField(request: $request, field: 'image', required: true);
            $image->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $this->fileHandler->handle(request: $request, model: $image);

        $image->save();

        return $image;
    }

    public function toggle(FeaturedImage $image): FeaturedImage
    {
        $image->is_active = !$image->is_active;
        $image->save();

        return $image;
    }

    public function destroy(FeaturedImage $image): void
    {
        $image->delete();
    }
}
