@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Botones del módulo')

@section('content')
    <div class="box-rounded d-flex justify-content-between align-items-center bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar Botón
        </h5>
        <a href="{{ route('admin.themes.buttons', ['module' => $module]) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>
    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar Botón' . $button->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.themes.buttons.update',
            'object' => $button,
            'params' => [
                'module' => $module,
                'button_id' => $button->id
            ]
        ],
        'fields' => [
            [
                'label' => 'Nombre',
                'name' => 'name',
                'required' => true
            ],
            [
                'label' => 'Enlace',
                'name' => 'link',
                'required' => true,
                'type' => 'url'
            ],
            [
                'name' => 'module_id',
                'hidden' => true
            ]
        ],
        'widgets' => [
            'image' => [
                'enabled' => true,
                'label' => 'Seleccionar Imagen',
                'name' => 'image',
            ]
        ]
    ])
@endsection
