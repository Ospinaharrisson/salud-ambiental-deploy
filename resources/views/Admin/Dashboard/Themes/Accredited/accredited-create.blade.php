@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center rounded p-3 mt-3 mb-5 bg">
        <h1 class="h4 mb-0 text-title">Crear nuevo Establecimiento Acreditado</h1>
        <a href="{{ route('admin.themes.accredited', $module) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Crear Establecimiento Acreditado',
        'form' => [
            'action' => 'create',
            'route' => 'admin.themes.accredited.store',
            'params' => [
                'module' => $module->id
            ]
        ],
        'fields' => [
            [
                'label' => 'Nombre del documento o archivo',
                'name' => 'name',
                'required' => true
            ],
            [
                'name' => 'module_id',
                'value' => $module->id,
                'hidden' => true
            ],
            [
                'name' => 'category',
                'value' => 'accredited',
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