<?php 

namespace App\Services\Shared;

use App\Models\Shared\Content\CalendarEvent;

class CalendarService
{
    public function getActiveEvents()
    {
        return CalendarEvent::select('name', 'date')
            ->where('is_active', true)
            ->get()
            ->map(fn($event) => [
                'title' => $event->name,
                'start' => $event->date,
            ]);
    }
}
