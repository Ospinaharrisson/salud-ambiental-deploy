@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Bulletin/forecastCalendar.css') }}">
@endpush

<div class="forecast-calendar-container">
    <div class="forecast-calendar-title">
        <h1>Calendario de eventos Salud Ambiental</h1>
    </div>
    <div class="forecast-calendar-content">
        @include('Shared.Calendar.calendar')
    </div>
</div>

@push('scripts')
    <script type="module" src="{{asset('assets/js/user/Content/Bulletin/forecastCalendar.js')}}"></script>
@endpush

@push('modals')
    @include('User.Content.Bulletin.Includes.Calendar.calendarEvent-modal')
@endpush