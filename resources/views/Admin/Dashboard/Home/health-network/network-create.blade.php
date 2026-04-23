@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Nuevo Botón de Subred de Hospital
        </h5>
        <a href="{{ route('admin.home.network') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Agregar Subred',
        'form' => [
            'action' => 'create',
            'route' => 'admin.home.network.store'
        ],
        'fields' => [
            [
                'label' => 'Nombre de la Subred de hospital',
                'name' => 'name',
                'required' => true
            ]
        ],
        'widgets' => [
            'image' => [
                'enabled' => true,
                'label' => 'Icono del botón',
                'name' => 'image',
                'required' => true
            ],
            'select' => [
                'enabled' => true,
                'label' => 'Tipo de Redirección',
                'required' => true
            ],
        ]
    ])
@endsection