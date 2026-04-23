<?php

namespace App\Services\Admin\Content\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Shared\Home\GalleryEvent;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\Content\Home\GalleryImageService;

class GalleryEventService
{
    protected $validator;
    protected $ImageService;

    public function __construct(ValidationService $validator, GalleryImageService $ImageService)
    {
        $this->validator = $validator;
        $this->ImageService = $ImageService;
    }

    public function store(Request $request): GalleryEvent
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateRichTextField(request: $request, field: 'description', min: 30, required: false);
        $this->validator->validateDateField(request: $request,field: 'date',required: false);
        
        return DB::transaction(function () use ($request) {
            $event = new GalleryEvent();
            $event->name = $request->name;
            $event->description = $request->description;
            $event->date = $request->date;
            $maxOrder = GalleryEvent::max('order') ?? 0;
            $event->order = $maxOrder + 1;
            $event->is_active = true;
            $event->save();

            $this->ImageService->saveImages($request, $event->id);

            return $event;
        });
    }

    public function update(Request $request, GalleryEvent $event): GalleryEvent
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateDateField(request: $request,field: 'date',required: false);

        if ($request->name !== $event->name) {
            $event->name = $request->name;
        }

        if ($request->date !== $event->date) {
            $event->date = $request->date;
        }

        $this->processRichTextField($request, $event);

        $event->save();

        return $event;
    }

    public function toggle(GalleryEvent $event): GalleryEvent
    {
        $event->is_active = !$event->is_active;
        $event->save();

        return $event;
    }

    private function processRichTextField(Request $request, GalleryEvent $event): void
    {
        $raw = $request->input('description');
        $clean = trim(strip_tags($raw));
        
        if ($clean === '') {
            $event->description = '';
            return;
        }
    
        $this->validator->validateRichTextField(request: $request, field: 'description', min: 30, required: false); 
        $event->description = $raw;
    }

    public function destroy(GalleryEvent $event): void
    {
        $event->delete();
    }
}
