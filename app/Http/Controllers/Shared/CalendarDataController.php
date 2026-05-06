<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Shared\Content\CalendarEvent;

class CalendarDataController extends Controller
{
    public function getEvents()
    {
        $events = CalendarEvent::where('is_active', true)
            ->orderBy('date')
            ->get()
            ->map(function ($event) {
                $urlPath = null;

                if (!empty($event->link)) {
                    $urlPath = $event->link;
                } elseif (!empty($event->mime_type) && !empty($event->content_base64)) {
                    $urlPath = generateBlankLink($event->content_base64, $event->mime_type);
                }

                return [
                    'id' => $event->id,
                    'title' => $event->name,
                    'start' => $event->date,
                    'allDay' => true,
                    'extendedProps' => [
                        'image' => !empty($event->image) ? renderBase64Image($event->image) : null,
                        'url' => $urlPath,
                    ]
                ];
            });

        return response()->json($events);
    }
}
