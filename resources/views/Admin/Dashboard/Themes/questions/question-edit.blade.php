@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar pregunta: {{ $question->name }}
        </h5>
        <a href="{{ route('admin.themes.questions', ['module' => $module]) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => $question->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.themes.questions.update',
            'object' => $question,
            'params' => [
                'module' => $module,
                'question_id' => $question->id
            ],
        ],
        'fields' => [
            [
                'label' => 'Título de la pregunta',
                'name' => 'name',
                'required' => true
            ],
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