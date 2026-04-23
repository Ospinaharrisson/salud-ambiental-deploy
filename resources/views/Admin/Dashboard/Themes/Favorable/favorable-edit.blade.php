@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center rounded p-3 mt-3 mb-5 bg">
        <h1 class="h4 mb-0 text-title">Editar Establecimiento Favorable: {{ $favorable->name }}</h1>
        <a href="{{ route('admin.themes.favorable', $module) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => $favorable->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.themes.favorable.update',
            'object' => $favorable,
            'params' => [
                'module' => $module->id,
                'favorable_id' => $favorable->id
            ]
        ],
        'fields' => [
            [
                'label' => 'Nombre del establecimiento',
                'name' => 'name',
                'required' => true
            ],
            [
                'name' => 'module_id',
                'value' => $module->id,
                'hidden' => true
            ]
        ],
        'widgets' => [
            'textarea' => [
                'enabled' => true,
                'label' => 'Descripción del documento (opcional)',
                'name' => 'description',
                'required' => false
            ],
            'select' => [
                'enabled' => true,
                'label' => 'Tipo de redirección',
                'required' => true
            ]
        ]
    ])
@endsection