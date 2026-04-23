@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Nuevo Punto de Recolección
        </h5>
        <a href="{{ route('admin.home.collection') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Agregar Punto de Recolección',
        'form' => [
            'action' => 'create',
            'route' => 'admin.home.collection.store'
        ],
        'fields' => [
            [
                'label' => 'Nombre del punto',
                'name' => 'name',
                'required' => true
            ]
        ],
        'widgets' => [
            'image' => [
                'enabled' => true,
                'label' => 'Ícono',
                'name' => 'image',
                'required' => true
            ],
            'select' => [
                'enabled' => true,
                'label' => 'Tipo de Redirección',
                'required' => true
            ]
        ]
    ])
@endsection
