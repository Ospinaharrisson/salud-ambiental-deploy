@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="box-rounded d-flex justify-content-between align-items-center bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar Subred de Hospital
        </h5>
        <a href="{{ route('admin.home.network') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar Subred de Hospital: ' . $network->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.home.network.update',
            'object' => $network,
            'params' => [
                'id' => $network->id
            ]
        ],
        'fields' => [
            [
                'label' => 'Nombre de la Subred',
                'name' => 'name',
                'required' => true
            ]
        ],
        'widgets' => [
            'image' => [
                'enabled' => true,
                'label' => 'Icono del botón',
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