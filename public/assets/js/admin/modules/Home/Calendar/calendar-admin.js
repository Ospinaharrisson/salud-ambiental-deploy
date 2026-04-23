import { initCalendar } from '../../../../shared/Calendar/fullcalendar-config.js';

document.addEventListener('DOMContentLoaded', () => {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const calendar = initCalendar(calendarEl, window.calendarEvents || []);

    calendar.setOption('dateClick', function(info) {
        const isOtherMonth = info.dayEl.classList.contains('fc-day-other');
        if (isOtherMonth) return;

        const selectedDate = info.dateStr;
        const eventsOnDate = calendar.getEvents().filter(event => event.startStr === selectedDate);

        if (eventsOnDate.length >= 3) {
            iziToast.warning({
                title: 'Registrar evento',
                message: 'No es posible registrar un nuevo evento en esta fecha',
                position: 'topRight'
            });
            return;
        }

        const modalEl = document.getElementById('calendarCreateModal');
        const dateInput = document.getElementById('date');

        if (dateInput) {
            dateInput.value = selectedDate;
        }

        if (modalEl) {
            new bootstrap.Modal(modalEl).show();
        }
    });

    calendar.render();
    calendarEl._fullCalendar = calendar;
});
