@extends('Admin.Components.Layout.layout', [ 'sidebar' => true])

@section('title', 'Nuevo - Muro Social')

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Nueva Imagen para el Muro Social
        </h5>
        <a href="{{ route('admin.home.media') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Agregar Imagen al Muro Social',
        'form' => [
            'action' => 'create',
            'route' => 'admin.home.media.store'
        ],
        'fields' => [
            [
                'label' => 'Nombre de la imagen',
                'name' => 'name',
                'required' => true
            ],
        ],
        'widgets' => [
            'image' => [
                'enabled' => true,
                'label' => 'Imagen',
                'name' => 'image',
                'required' => true
            ],
            'select' => [
                'enabled' => true,
                'label' => 'Tipo de redirección',
                'required' => true
            ]
        ]
    ])
@endsection
