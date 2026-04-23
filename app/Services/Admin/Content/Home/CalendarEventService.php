<?php
namespace App\Services\Admin\Content\Home;

use Illuminate\Http\Request;
use App\Models\Shared\Content\CalendarEvent;
use App\Services\Admin\Request\ValidationService;
use App\Services\Admin\FileConverterService;
use App\Services\Admin\Request\ConditionalFileHandler;

class CalendarEventService
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

    public function store(Request $request): CalendarEvent
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);
        $this->validator->validateDateField(request: $request, field: 'date', required: false); 
        $this->validator->validateImageField(request: $request, field: 'image', required: true);

        $event = new CalendarEvent();
        $event->name = $request->name;
        $event->date = $request->date;
        $event->image = $this->fileConverter->convertToBase64($request->file('image'));

        $this->fileHandler->handle(request: $request, model: $event);

        $event->save();

        return $event;
    }

    public function update(Request $request, CalendarEvent $event): CalendarEvent
    {
        $this->validator->validateStringField(request: $request, field: 'name', max: 200, required: true);

        if ($request->name !== $event->name) {
            $event->name = $request->name;
        }

        if ($request->hasFile('image')) {
            $this->validator->validateImageField(request: $request, field: 'image', required: true);
            $event->image = $this->fileConverter->convertToBase64($request->file('image'));
        }

        $this->fileHandler->handle(request: $request, model: $event);

        $event->save();

        return $event;
    }

    public function toggle(CalendarEvent $event): CalendarEvent
    {
        $event->is_active = !$event->is_active;
        $event->save();

        return $event;
    }

    public function destroy(CalendarEvent $event): void
    {
        $event->delete();
    }

}
