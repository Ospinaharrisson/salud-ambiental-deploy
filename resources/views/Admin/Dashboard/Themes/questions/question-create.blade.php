@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center rounded p-3 mt-3 mb-5 bg">
        <h1 class="h4 mb-0 text-title">Crear nueva Pregunta</h1>
        <a href="{{ route('admin.themes.questions', $module) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>
    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Crear Pregunta',
        'form' => [
            'action' => 'create',
            'route' => 'admin.themes.questions.store',
            'params' => [
                'module' => $module
            ]
        ],
        'fields' => [
            [
                'label' => 'pregunta',
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
                'label' => 'Descripción / Respuesta',
                'name' => 'description',
                'required' => true
            ]
        ]
    ])
@endsection
