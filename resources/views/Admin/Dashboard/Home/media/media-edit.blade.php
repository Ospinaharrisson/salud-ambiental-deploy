@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Editar - Muro Social')

@section('content')
    <div class="box-rounded d-flex justify-content-between align-items-center bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar Imagen del Muro Social
        </h5>
        <a href="{{ route('admin.home.media') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar: ' . $banner->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.home.media.update',
            'params' => [
                'id' => $banner->id
            ],
            'object' => $banner
        ],
        'fields' => [
            [
                'label' => 'Nombre de la imagen',
                'name' => 'name',
                'required' => true
            ]
        ],
        'widgets' => [
            'image' => [
                'enabled' => true,
                'label' => 'Añadir Imagen',
                'name' => 'image'
            ],
            'select' => [
                'enabled' => true,
                'label' => 'Tipo de redirección',
                'required' => true
            ]
        ]
    ])
@endsection
