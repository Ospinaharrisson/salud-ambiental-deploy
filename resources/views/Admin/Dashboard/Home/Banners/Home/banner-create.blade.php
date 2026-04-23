@extends('Admin.Components.Layout.layout', [ 'sidebar' => true])

@section('title', 'Nuevo Banner')

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Nueva Imagen para el banner principal
        </h5>
        <a href="{{ route('admin.home.banner') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Agregar Imagen al Banner Principal',
        'form' => [
            'action' => 'create',
            'route' => 'admin.home.banner.store'
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
                'required' => false
            ]
        ]
    ])
@endsection