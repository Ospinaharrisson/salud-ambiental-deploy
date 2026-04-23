@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="box-rounded d-flex justify-content-between align-items-center bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Crear Menú Distrital
        </h5>
        <a href="{{ route('admin.home.district') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>
    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Agregar Menú Distrital',
        'form' => [
            'action' => 'create',
            'route' => 'admin.home.district.store'
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
                'value' => 'district',
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
