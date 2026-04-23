
<div class="box-rounded box-shadow">
    <div class="box-body">
        @include('Shared.Calendar.calendar')        
    </div>
</div>

@push('scripts')
    <script type="module" src="{{ asset('assets/js/admin/modules/Home/Calendar/calendar-admin.js') }}"></script>
@endpush

@push('modals')
    @include('Admin.Dashboard.Home.calendar.components.calendar-create-modal')
@endpush



