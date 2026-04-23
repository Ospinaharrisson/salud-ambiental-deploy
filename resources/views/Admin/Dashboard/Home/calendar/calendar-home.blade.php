@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/modules/calendar-events.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <div>
            <h1 class="text-title m-0">Calendario</h1>
            <div class="text-note">Gestión de Eventos del calendario</div>
        </div>
    </div>

    <div x-data="{
        activeTab: 'calendar',
        init() {
            this.$watch('activeTab', value => {
                if (value === 'calendar') {
                    setTimeout(() => {
                        const calendarEl = document.getElementById('calendar');
                        if (calendarEl && calendarEl._fullCalendar) {
                            calendarEl._fullCalendar.updateSize();
                        }
                    }, 10);
                }
            });
        }
    }" class="mb-4">

        {{-- Tabs --}}
        <div class="tabs">
            <div 
                class="tab" 
                :class="activeTab === 'calendar' ? 'tab-active bg' : 'tab-inactive'" 
                @click="activeTab = 'calendar'">
                Calendario de eventos Salud Ambiental
            </div>

            <div 
                class="tab"  
                :class="activeTab === 'table' ? 'tab-active bg' : 'tab-inactive'" 
                @click="activeTab = 'table'">
                Lista de Eventos
            </div>
        </div>

        {{-- Calendario --}}
        <div x-show="activeTab === 'calendar'" x-transition>
            @livewire('admin.modules.home.calendar.event-calendar')
        </div>

        {{-- Tabla --}}
        <div id="calendar-table" x-show="activeTab === 'table'" x-transition>
            <livewire:admin.components.dashboard-table
                model="App\Models\Shared\Content\CalendarEvent"
                :header="[
                    'enabled' => false,
                ]"
                :columns="[
                    'Evento',
                    'Fecha del evento',
                ]"
                :fields="[
                    'name',
                    'date',
                ]"
                :status="[
                    'enabled' => true,
                ]"
                :edit="[
                    'enabled' => true,
                    'route' => 'admin.home.calendar.edit',
                ]"
                :toggle="[
                    'enabled' => true,
                    'route' => 'admin.home.calendar.toggle',
                ]"
                :delete="[
                    'enabled' => true,
                    'route' => 'admin.home.calendar.destroy',
                    'message' => '¿Está seguro de eliminar este evento? Esta acción no se puede deshacer.',
                ]"
            />
        </div>

    </div>
@endsection

@push('scripts')
    <script src="//unpkg.com/alpinejs" defer></script>
@endpush
