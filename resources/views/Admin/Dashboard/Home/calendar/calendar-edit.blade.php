@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="box-rounded d-flex justify-content-between align-items-center bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar Evento
        </h5>
        <a href="{{ route('admin.home.calendar') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Evento ' . $event->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.home.calendar.update',
            'object' => $event,
            'params' => [
                'id' => $event->id
            ]
        ],
        'fields' => [
            [
                'label' => 'Nombre del evento',
                'name' => 'name',
                'required' => true
            ]
        ],
        'widgets' => [
            'image' => [
                'enabled' => true,
                'label' => 'Imagen del evento',
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