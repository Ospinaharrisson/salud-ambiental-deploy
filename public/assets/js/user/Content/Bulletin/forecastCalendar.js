import { initCalendar } from "../../../shared/Calendar/fullcalendar-config.js";

document.addEventListener("DOMContentLoaded", () => {
  const calendarEl = document.getElementById("calendar");
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

  function handleEventClick(info) {
    const modalEl = document.getElementById("calendarEventModal");
    if (!modalEl) return;
  
    const event = info.event;
    const props = event.extendedProps || {};
  
    document.getElementById("calendarEventTitle").textContent =
      event.title || "Evento";
  
    const imageEl = document.getElementById("calendarEventImage");
    if (props.image) {
      imageEl.src = props.image;
      imageEl.style.display = "block";
    } else {
      imageEl.style.display = "none";
      imageEl.src = "";
    }
  
    const btn = document.getElementById("calendarMoreInfoBtn");
  
    if (props.url) {
      btn.style.display = "inline-block";
    
      btn.onclick = () => window.open(props.url, "_blank", "noopener");
    } else {
      btn.style.display = "none";
      btn.onclick = null;
    }
  
    new bootstrap.Modal(modalEl).show();
  }

  fetch(`${window.location.origin}/calendar/events`)
    .then((r) => (r.ok ? r.json() : []))
    .catch(() => [])
    .then((events = []) => {
      const safeEvents = Array.isArray(events) ? events : [];

      const calendar = initCalendar(calendarEl, safeEvents);

      calendar.setOption("eventClick", handleEventClick);

      calendar.setOption("locale", "es");

      calendar.setOption("buttonText", {
        today: "Hoy",
        month: "Mes",
        week: "Semana",
        day: "Día",
        list: "Lista",
      });

      calendar.setOption("allDayText", "Todo el día");

      calendar.setOption(
        "noEventsContent",
        "No hay eventos para mostrar"
      );

      calendar.render();

      updateCalendarView(calendar);

      window.addEventListener("resize", () =>
        updateCalendarView(calendar)
      );
    });
});