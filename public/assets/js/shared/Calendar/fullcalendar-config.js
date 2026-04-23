export function initCalendar(calendarEl, events = []) {
    return new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        themeSystem: 'bootstrap5',
        height: 650,
        events: events
    });
}