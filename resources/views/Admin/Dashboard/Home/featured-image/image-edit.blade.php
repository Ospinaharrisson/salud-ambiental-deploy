@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="box-rounded d-flex justify-content-between align-items-center bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar Imagen
        </h5>
        <a href="{{ route('admin.home.featured') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar imagen: ' . $image->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.home.featured.update',
            'object' => $image,
            'params' => [
                'id' => $image->id
            ]
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
                'label' => 'Imagen',
                'name' => 'image',
            ],
            'select' => [
                'enabled' => true,
                'label' => 'Tipo de Redirección',
                'required' => false
            ]
        ]
    ])
@endsection
