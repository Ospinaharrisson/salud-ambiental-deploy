@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Crear Pagina
        </h5>
        <a href="{{ route('admin.themes.page', ['module' => $module]) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'crear pagina',
        'form' => [
            'action' => 'create',
            'route' => 'admin.themes.page.store',
            'params' => [
                'module' => $module,
            ],
        ],
        'fields' => [
            [
                'label' => 'Nombre de la página',
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
            'checkbox' => [
                'enabled' => true,
                'label' => 'Mostrar en menú de navegación',
                'name' => 'show_in_navbar',
                'checked' => true
            ],
            'image' => [
                'enabled' => true,
                'label' => 'imagen',
                'name' => 'image',
                'required' => true
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
