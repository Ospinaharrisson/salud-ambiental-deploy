import { initCalendar } from '../../../shared/Calendar/fullcalendar-config.js';

document.addEventListener('DOMContentLoaded', () => {
  const calendarEl = document.getElementById('calendar');
  if (!calendarEl) return;

  function updateCalendarView(calendar) {
    const isMobile = window.matchMedia("(max-width: 768px)").matches;

    if (isMobile) {
      calendar.changeView("listWeek");
      calendar.setOption("height", "auto");
    } else {
      calendar.changeView("dayGridMonth");
      calendar.setOption("height", "auto");
    }
  }

  fetch(`${window.location.origin}/calendar/events`)
    .then(r => (r.ok ? r.json() : []))
    .catch(() => [])
    .then((events = []) => {
      const safeEvents = Array.isArray(events) ? events : [];
      const calendar = initCalendar(calendarEl, safeEvents);

      calendar.setOption("locale", "es");

      calendar.setOption("buttonText", {
        today: "Hoy",
        month: "Mes",
        week: "Semana",
        day: "Día",
        list: "Lista"
      });

      calendar.setOption("allDayText", "Todo el día");

      calendar.setOption("noEventsContent", "No hay eventos para mostrar");

      calendar.render();
      updateCalendarView(calendar);

      window.addEventListener("resize", () => updateCalendarView(calendar));
    });
});
