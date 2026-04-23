@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Indicadores')

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Nuevo Indicador del Clima
        </h5>
        <a href="{{ route('admin.home.insight') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Agregar Indicador',
        'form' => [
            'action' => 'create',
            'route' => 'admin.home.insight.store'
        ],
        'fields' => [
            [
                'label' => 'Nombre del Indicador',
                'name' => 'name',
                'required' => true
            ]
        ],
        'widgets' => [
            'image' => [
                'enabled' => true,
                'label' => 'Icono',
                'name' => 'image',
                'required' => true
            ],
            'select' => [
                'enabled' => true,
                'label' => 'Tipo de Redirección',
                'required' => true
            ]
        ]
    ])
@endsection