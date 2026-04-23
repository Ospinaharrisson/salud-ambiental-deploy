<?php

namespace App\Services\Admin\Content\Home;

use Illuminate\Http\Request;
use App\Models\Shared\Home\GalleryImage;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;

class GalleryImageService
{
    protected ValidationService $validator;
    protected FileConverterService $fileConverter;

    public function __construct(ValidationService $validator, FileConverterService $fileConverter)
    {
        $this->validator = $validator;
        $this->fileConverter = $fileConverter;
    }

    public function saveImages(Request $request, int $eventId): void
    {
        $uploadedImages = $request->file('images', []);

        foreach ($uploadedImages as $index => $image) {
            $this->validator->validateStringFromArray($image->getClientOriginalName(), 'name', 200, true);
            $this->validator->validateImageFromArray($image);

            $galleryImage = new GalleryImage();
            $galleryImage->name = $image->getClientOriginalName();
            $galleryImage->gallery_event_id = $eventId;
            $galleryImage->order = $index;
            $galleryImage->is_active = true;
            $galleryImage->image = $this->fileConverter->convertToBase64($image);

            $galleryImage->save();
        }
    }

    public function saveImage(Request $request, int $eventId): GalleryImage
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateImageField(request: $request, field: 'image', required: true);

        $image = new GalleryImage();
        $image->name = $request->name;
        $image->image = $this->fileConverter->convertToBase64($request->file('image'));
        $image->gallery_event_id = $eventId;

        $maxOrder = GalleryImage::max('order') ?? 0;
        $image->order = $maxOrder + 1;

        $image->save();

        return $image;
    }
    
    public function update(Request $request, GalleryImage $image): GalleryImage
    {
        if ($request->name !== $image->name) {
            $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
            $image->name = $request->name;
        }

        if ($request->hasFile('image')) {
            $this->validator->validateImageField(request: $request, field: 'image', required: true);
            $image->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $image->save();

        return $image;
    }

    public function toggle(GalleryImage $image): GalleryImage
    {
        $image->is_active = !$image->is_active;
        $image->save();

        return $image;
    }

    public function destroy(GalleryImage $image): void
    {
        $image->delete();
    }
}
