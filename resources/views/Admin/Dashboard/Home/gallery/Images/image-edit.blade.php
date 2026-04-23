@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar Imagen de la Galería
        </h5>
        <a href="{{ route('admin.home.gallery.images', ['event_id' => $image->gallery_event_id]) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar imagen: ' . $image->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.home.gallery.images.update',
            'params' => [
                'event_id' => $image->gallery_event_id,
                'image_id' => $image->id
            ],
            'object' => $image
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
            ]
        ]
    ])
@endsection