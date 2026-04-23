@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="box-rounded d-flex justify-content-between align-items-center bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar Punto de Recolección
        </h5>
        <a href="{{ route('admin.home.collection') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar punto: ' . $point->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.home.collection.update',
            'object' => $point,
            'params' => [
                'id' => $point->id
            ]
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
            ],
            'select' => [
                'enabled' => true,
                'label' => 'Tipo de Redirección',
                'required' => false
            ]
        ]
    ])
@endsection
