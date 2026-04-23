<?php
namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Content\CalendarEvent;
use App\Services\Admin\Content\Home\CalendarEventService;

class CalendarEventController extends Controller
{
    protected $calendarManager;

    public function __construct(CalendarEventService $calendarManager)
    {
        $this->calendarManager = $calendarManager;
    }

    /* #region vista */

    public function calendarHomeView()
    {
        return view('Admin.Dashboard.Home.calendar.calendar-home');
    }

    public function calendarUpdateView($id)
    {
        $event = CalendarEvent::findOrFail($id);
        return view('Admin.Dashboard.Home.calendar.calendar-edit', compact('event'));
    }

    /* #endregion vista */

    /* #region acciones */

    public function storeCalendarEvent(Request $request)
    {
        $this->calendarManager->store($request);
        return redirect()->route('admin.home.calendar')->with('mensaje', 'Evento de calendario guardado exitosamente.');
    }

    public function updateCalendarEvent(Request $request, $id)
    {
        $event = CalendarEvent::findOrFail($id);
        $this->calendarManager->update($request, $event);

        return redirect()->route('admin.home.calendar')->with('mensaje', 'Evento de calendario actualizado exitosamente.');
    }

    public function toggleCalendarEvent($id)
    {
        $event = CalendarEvent::findOrFail($id);
        $this->calendarManager->toggle($event);

        return redirect()->back()->with('mensaje', 'El estado del evento ha sido actualizado exitosamente.');
    }

    public function destroyCalendarEvent($id)
    {
        $event = CalendarEvent::findOrFail($id);
        $this->calendarManager->destroy($event);
        return redirect()->route('admin.home.calendar')->with('mensaje', 'Evento eliminado exitosamente.');
    }
    /* #endregion acciones */
}
