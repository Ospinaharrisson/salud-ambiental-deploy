@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Botones del módulo')

@section('content')
    <div class="box-rounded d-flex justify-content-between align-items-center bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Crear Botón
        </h5>
        <a href="{{ route('admin.themes.buttons', ['module' => $module]) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>
    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Agregar Botón',
        'form' => [
            'action' => 'create',
            'route' => 'admin.themes.buttons.store',
            'params' => ['module' => $module]
        ],
        'fields' => [
            [
                'label' => 'Nombre',
                'name' => 'name',
                'required' => true
            ],
            [
                'label' => 'Enlace',
                'name' => 'link',
                'required' => true,
                'type' => 'url'
            ],
            [
                'name' => 'module_id',
                'value' => $module->id,
                'hidden' => true
            ]
        ],
        'widgets' => [
            'image' => [
                'enabled' => true,
                'label' => 'Seleccionar Imagen',
                'name' => 'image',
                'required' => true
            ]
        ]
    ])
@endsection
