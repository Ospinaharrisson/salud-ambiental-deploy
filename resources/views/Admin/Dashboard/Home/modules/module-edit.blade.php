@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="box-rounded d-flex justify-content-between align-items-center bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar Menú: {{ $module->name }}
        </h5>
        <a href="{{ route('admin.home.module') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>
    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar Menú: ' . $module->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.home.module.update',
            'object' => $module,
            'params' => [
                'id' => $module->id
            ]
        ],
        'fields' => [
            [
                'label' => 'Nombre del Menú',
                'name' => 'name',
                'placeHolder' => 'Menú',
                'required' => true
            ]
        ],
        'widgets' => [
            'color' => [
                'enabled' => true,
                'label' => 'Color del Menú',
                'name' => 'theme'
            ],
            'image' => [
                'enabled' => true,
                'label' => 'Seleccionar Imagen',
                'name' => 'image',
            ]
        ]
    ])
@endsection