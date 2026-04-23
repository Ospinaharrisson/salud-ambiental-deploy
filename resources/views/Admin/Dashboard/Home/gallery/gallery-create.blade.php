@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Nueva Galería
        </h5>
        <a href="{{ route('admin.home.gallery') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Nueva Galería',
        'form' => [
            'action' => 'create',
            'route' => 'admin.home.gallery.store'
        ],
        'fields' => [
            [
                'label' => 'Nombre de la galería',
                'name' => 'name',
                'required' => true
            ]
        ],
        'widgets' => [
            'date' => [
                'enabled' => true,
                'label' => 'Fecha del evento',
                'required' => false
            ],
            'textarea' => [
                'enabled' => true,
                'label' => 'Descripción del evento',
                'name' => 'description',
                'required' => false
            ],
            'upload' => [
                'enabled' => true,
                'name' => 'images',
                'label' => 'Galería de imagenes',
                'type' => 'image',
                'maxFiles' => 8,
                'required' => true
            ]
        ]
    ])
@endsection
