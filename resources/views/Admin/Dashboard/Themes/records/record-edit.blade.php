@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar pagina: {{ $page->name }}
        </h5>
        <a href="{{ route('admin.themes.record', ['module' => $module]) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => $page->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.themes.record.update',
            'object' => $page,
            'params' => [
                'module' => $module,
                'page_id' => $page->id
            ],
        ],
        'fields' => [
            [
                'label' => 'Nombre de la página',
                'name' => 'name',
                'required' => true
            ],
        ],
        'widgets' => [
            'image' => [
                'enabled' => true,
                'label' => 'imagen',
                'name' => 'image'
            ],
            'textarea' => [
                'enabled' => true,
                'label' => 'Descripción de la página',
                'name' => 'description',
                'required' => true
            ]
        ]
    ])
@endsection
