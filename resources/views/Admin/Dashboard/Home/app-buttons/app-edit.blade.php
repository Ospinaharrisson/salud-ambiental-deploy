@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="box-rounded d-flex justify-content-between align-items-center bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar Botón
        </h5>
        <a href="{{ route('admin.home.app') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar botón: ' . $button->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.home.app.update',
            'object' => $button,
            'params' => [
                'id' => $button->id
            ]
        ],
        'fields' => [
            [
                'label' => 'Nombre del botón',
                'name' => 'name',
                'required' => true
            ]
        ],
        'widgets' => [
            'color' => [
                'enabled' => true,
                'label' => 'Color del Botón',
                'name' => 'theme'
            ],
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
