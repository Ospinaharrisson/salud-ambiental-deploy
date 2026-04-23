@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="box-rounded d-flex justify-content-between align-items-center bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar Linea de interes
        </h5>
        <a href="{{ route('admin.home.line') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar Linea de interes: ' . $line->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.home.line.update',
            'object' => $line,
            'params' => [
                'id' => $line->id
            ]
        ],
        'fields' => [
            [
                'label' => 'Nombre de la linea de interes',
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