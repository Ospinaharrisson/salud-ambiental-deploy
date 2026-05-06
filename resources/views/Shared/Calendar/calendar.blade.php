@push('styles')
  <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" />
  <link rel="stylesheet" href="{{ asset('assets/css/shared/Calendar/calendar.css') }}" />
@endpush

{{-- Calendario --}}
<div class="mt-auto">
  <div id='calendar'></div>
  <input type="hidden" name="start" id="startCalendar" value="">
  <input type="hidden" name="end" id="endCalendar" value="">
</div>
        
@once
  @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/locales-all.global.min.js"></script>
    <script>
      window.calendarEvents = @json($events);
    </script>
  @endpush
@endonce