@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Nueva Imagen de la Galería
        </h5>
        <a href="{{ route('admin.home.gallery') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Añadir Imagen a la galería: ' . $event->name,
        'form' => [
            'action' => 'create',
            'route' => 'admin.home.gallery.images.store',
            'params' => [
                'event_id' => $event->id
            ]
        ],
        'fields' => [
            [
                'label' => 'nombre de la imagen',
                'name' => 'name',
                'required' => true,
            ]
        ],
        'widgets' => [
            'image' => [
                'enabled' => true,
                'label' => 'seleccione la imagen',
                'name' => 'image',
                'required' => true
            ]
        ]
    ])
@endsection