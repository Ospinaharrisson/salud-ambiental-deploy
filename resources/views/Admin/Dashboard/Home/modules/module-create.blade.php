@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="box-rounded d-flex justify-content-between align-items-center bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Crear Menú
        </h5>
        <a href="{{ route('admin.home.module') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>
    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Agregar Menú',
        'form' => [
            'action' => 'create',
            'route' => 'admin.home.module.store'
        ],
        'fields' => [
            [
                'label' => 'Nombre del Menú',
                'name' => 'name',
                'placeHolder' => 'Menú',
                'required' => true
            ],
            [
                'name' => 'type',
                'value' => 'global',
                'hidden' => true
            ]
        ],
        'widgets' => [
            'color' => [
                'enabled' => true,
                'label' => 'Color del Menú',
                'name' => 'theme'
            ],
            'image' => [
                'enabled' => true,
                'label' => 'Seleccionar Imagen',
                'name' => 'image',
                'required' => true
            ]
        ]
    ])
@endsection