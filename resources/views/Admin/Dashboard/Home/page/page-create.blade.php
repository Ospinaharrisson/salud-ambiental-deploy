@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Nueva pagina Principal
        </h5>
        <a href="{{ route('admin.home.page') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Agregar Pagina',
        'form' => [
            'action' => 'create',
            'route' => 'admin.home.page.store'
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