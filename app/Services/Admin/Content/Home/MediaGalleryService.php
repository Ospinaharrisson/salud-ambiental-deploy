<?php

namespace App\Services\Admin\Content\Home;

use Illuminate\Http\Request;
use App\Models\Shared\Content\MediaGallery;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;
use App\Services\Admin\Request\ConditionalFileHandler;

class MediaGalleryService
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

    public function store(Request $request): MediaGallery
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateImageField(request: $request, field: 'image', required: true);
        
        $media = new MediaGallery();
        $media->name = $request->name;
        $media->image = $this->fileConverter->convertToBase64($request->file('image'));
        
        $this->fileHandler->handle(request: $request, model: $media);

        $maxOrder = MediaGallery::max('order') ?? 0;
        $media->order = $maxOrder + 1;

        $media->save();

        return $media;
    }

    public function update(Request $request, MediaGallery $media): MediaGallery
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        
        if ($request->name !== $media->name) {
            $media->name = $request->name;
        }

        if ($request->hasFile('image')) {
            $this->validator->validateImageField(request: $request, field: 'image', required: true);
            $media->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $this->fileHandler->handle(request: $request, model: $media);

        $media->save();

        return $media;
    }

    public function toggle(MediaGallery $media): MediaGallery
    {
        $media->is_active = !$media->is_active;
        $media->save();

        return $media;
    }

    public function destroy(MediaGallery $media): void
    {
        $media->delete();
    }
}
