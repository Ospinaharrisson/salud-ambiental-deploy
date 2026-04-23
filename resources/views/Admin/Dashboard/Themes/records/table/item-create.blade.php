@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Registros')

@push('styles')    
    <link rel="stylesheet" href="{{ asset('assets/css/admin/modules/chemical-asset.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Crear nuevo elemento
        </h5>
        <a href="{{ route('admin.themes.record.item', ['module' => $module, 'page_id' => $page_id]) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    <div class="progress">
        <div id="progress-bar" class="progress-bar"
            role="progressbar" style="width: 25%;"
            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
            data-current-step="{{ $currentStep }}">
            Paso 1 de 5
        </div>
    </div>

    @include('Admin.Dashboard.Themes.records.table.includes.create.item-form')

    <div id="step-2" class="step d-none">
        @include('Admin.Dashboard.Themes.records.table.includes.image-form', [
            'config' => [
                'route' => 'admin.themes.record.item.store.stamp',
                'parmas' => ['module'=>$module,'page_id'=>$page_id]
            ],
            'images' => $images,
            'selected' => session('item.selected_images', [])
        ])

        <button type="button" class="btn btn-secondary prev-step">Anterior</button>
        <button type="button" class="btn btn-primary next-step"
            @unless(session('step-2')) disabled @endunless>
            Siguiente
        </button>
    </div>

    <div id="step-3" class="step d-none">
        @include('Admin.Dashboard.Themes.records.table.includes.description-form', [
            'config' => [
                'id' => 'economy',
                'title' => 'Actividades economicas asociadas',
                'route' => 'admin.themes.record.item.store.detail',
                'params' => ['module'=>$module,'page_id'=>$page_id],
                'type' => 'economy',
                'step' => 'step-3'
            ],
            'descriptions' => session('item.details.economy')
        ])

        <button type="button" class="btn btn-secondary prev-step">Anterior</button>
        <button type="button" class="btn btn-primary next-step"
            @unless(session('step-3')) disabled @endunless>
            Siguiente
        </button>
    </div>

    <div id="step-4" class="step d-none">
        @include('Admin.Dashboard.Themes.records.table.includes.description-form', [
            'config' => [
                'id' => 'danger',
                'title' => 'Categorías de peligros Asociados',
                'route' => 'admin.themes.record.item.store.detail',
                'params' => ['module'=>$module,'page_id'=>$page_id],
                'type' => 'danger',
                'step' => 'step-4'
            ],
            'descriptions' => session('item.details.danger')
        ])

        <button type="button" class="btn btn-secondary prev-step">Anterior</button>
        <button type="button" class="btn btn-primary next-step"
            @unless(session('step-4')) disabled @endunless>
            Siguiente
        </button>
    </div>

    @include('Admin.Dashboard.Themes.records.table.includes.create.item-info')
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/admin/modules/Themes/Records/description-form.js') }}"></script>
    <script src="{{ asset('assets/js/admin/modules/Themes/Records/record-step.js') }}"></script>
@endpush
