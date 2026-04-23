@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Añadir Referencia a la categoria: {{ $category->name }}
        </h5>
        <a href="{{ route('admin.themes.page.categories.asset', ['module' => $module, 'page_id' => $page_id, 'category_id' => $category->id]) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

        @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Nuevo documento',
        'form' => [
            'action' => 'create',
            'route' => 'admin.themes.page.categories.asset.store',
            'params' => [
                'module' => $module,
                'page_id' => $page_id,
                'category_id' => $category->id
            ],
        ],
        'fields' => [
            [
                'label' => 'Nombre del archivo',
                'name' => 'name',
                'required' => true
            ],
            [
                'label' => 'Titulo del documento',
                'name' => 'title',
                'required' => false
            ],
            [
                'name' => 'page_asset_category_id',
                'value' => $category->id,
                'hidden' => true
            ]
        ],
        'widgets' => [
            'select' => [
                'enabled' => true,
                'label' => 'Tipo de referencia',
                'required' => true
            ]
        ]
    ])
@endsection