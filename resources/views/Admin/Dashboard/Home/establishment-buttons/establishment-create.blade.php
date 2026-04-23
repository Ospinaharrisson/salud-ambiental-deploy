@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Nuevo Botón de Establecimiento
        </h5>
        <a href="{{ route('admin.home.establishment') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Agregar Establecimiento',
        'form' => [
            'action' => 'create',
            'route' => 'admin.home.establishment.store'
        ],
        'fields' => [
            [
                'label' => 'Nombre del establecimiento',
                'name' => 'name',
                'required' => true
            ]
        ],
        'widgets' => [
            'select' => [
                'enabled' => true,
                'label' => 'Tipo de Redirección',
                'required' => true
            ],
            'image' => [
                'enabled' => true,
                'label' => 'Icono',
                'name' => 'image',
                'required' => true
            ],
        ]
    ])
@endsection