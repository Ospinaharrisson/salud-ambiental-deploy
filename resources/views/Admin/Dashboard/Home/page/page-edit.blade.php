@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="box-rounded d-flex justify-content-between align-items-center bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar Pagina Principal
        </h5>
        <a href="{{ route('admin.home.page') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar Pagina: ' . $page->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.home.page.update',
            'object' => $page,
            'params' => [
                'id' => $page->id
            ]
        ],
        'fields' => [
            [
                'label' => 'Nombre de la pagina',
                'name' => 'name',
                'required' => true
            ]
        ],
        'widgets' => [
            'image' => [
                'enabled' => true,
                'label' => 'banner de la pagina',
                'name' => 'image',
                'required' => false
            ],
            'textarea' => [
                'enabled' => true,
                'label' => 'Contenido de la pagina',
                'name' => 'description',
                'required' => true
            ]
        ]
    ])
@endsection