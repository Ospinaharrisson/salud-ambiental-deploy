@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar Galería
        </h5>
        <a href="{{ route('admin.home.gallery') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar Galería: ' . $event->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.home.gallery.update',
            'object' => $event,
            'params' => [
                'event_id' => $event->id
            ]
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
            ]
        ]
    ])
@endsection
