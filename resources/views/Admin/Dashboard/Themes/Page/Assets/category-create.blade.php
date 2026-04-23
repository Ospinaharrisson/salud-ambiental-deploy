@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Nueva categoria para Documentos {{ $page->name }}
        </h5>
        <a href="{{ route('admin.themes.page.categories', ['module' => $module, 'page_id' => $page->id]) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Nueva categoria',
        'form' => [
            'action' => 'create',
            'route' => 'admin.themes.page.categories.store',
            'params' => [
                'module' => $module,
                'page_id' => $page->id
            ],
        ],
        'fields' => [
            [
                'label' => 'Nombre de la categoria',
                'name' => 'name',
                'required' => true
            ],
            [
                'label' => 'Grupo (opcional)',
                'name' => 'groupTitle',
                'required' => false
            ],
        ],
        'widgets' => [
            'textarea' => [
                'enabled' => true,
                'label' => 'Descripción de la categoria',
                'name' => 'description',
            ]
        ]
    ])
@endsection
