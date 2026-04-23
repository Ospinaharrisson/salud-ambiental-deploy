<?php

namespace App\Http\Livewire\Admin\Modules\Home\Calendar;

use Livewire\Component;
use App\Services\Shared\CalendarService;

class EventCalendar extends Component
{
    protected CalendarService $calendarService;

    public function mount(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    public function render()
    {
        $events = $this->calendarService->getActiveEvents();

        return view('Admin.Dashboard.Home.calendar.components.event-calendar', [
            'events' => $events
        ]);
    }
}