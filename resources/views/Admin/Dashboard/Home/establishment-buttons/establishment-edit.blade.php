@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="box-rounded d-flex justify-content-between align-items-center bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar Establecimiento
        </h5>
        <a href="{{ route('admin.home.establishment') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar establecimiento: ' . $establishment->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.home.establishment.update',
            'object' => $establishment,
            'params' => [
                'id' => $establishment->id
            ]
        ],
        'fields' => [
            [
                'label' => 'Nombre del establecimiento',
                'name' => 'name',
                'required' => true
            ]
        ],
        'widgets' => [
            'image' => [
                'enabled' => true,
                'label' => 'Icono',
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