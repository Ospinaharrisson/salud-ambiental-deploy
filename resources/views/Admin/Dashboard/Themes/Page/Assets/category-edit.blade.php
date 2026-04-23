@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="mb-0 text-title">
            editar categoria: {{ Str::limit($category->name, 70, '...') }}
        </h5>
        <a href="{{ route('admin.themes.page.categories', ['module' => $module, 'page_id' => $page_id]) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>
     @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => $category->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.themes.page.categories.update',
            'object' => $category,
            'params' => [
                'module' => $module,
                'page_id' => $page_id,
                'category_id' => $category->id
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