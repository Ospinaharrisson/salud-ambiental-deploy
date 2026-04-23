@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar referencia: {{ $asset->name }}
        </h5>
        <a href="{{ route('admin.themes.page.categories.asset', ['module' => $module, 'page_id' => $page_id, 'category_id' => $category_id, 'asset_id' => $asset->id]) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar referencia',
        'form' => [
            'action' => 'edit',
            'route' => 'admin.themes.page.categories.asset.update',
            'object' => $asset,
            'params' => [
                'module' => $module,
                'page_id' => $page_id,
                'category_id' => $category_id,
                'asset_id' => $asset->id
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
        ],
        'widgets' => [
            'select' => [
                'enabled' => true,
                'label' => 'Tipo de refencia',
                'required' => false
            ]
        ]
    ])
@endsection