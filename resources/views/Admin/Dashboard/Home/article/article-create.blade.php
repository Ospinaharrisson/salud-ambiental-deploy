@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Crear Noticia')

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Nueva Noticia
        </h5>
        <a href="{{ route('admin.home.article') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'nueva noticia',
        'form' => [
            'action' => 'create',
            'route' => 'admin.home.article.store'
        ],
        'fields' => [
            [
                'label' => 'Nombre de la noticia',
                'name' => 'name',
                'required' => true
            ]
        ],
        'widgets' => [
            'image' => [
                'enabled' => 'true', 
                'label' => 'Imagen de la noticia',
                'name' => 'image',
                'required' => true
            ],
            'select' => [
                'enabled' => true,
                'label' => 'Redirección de la noticia'
            ],
            'textarea' => [
                'enabled' => true,
                'label' => 'contenido de la noticia',
                'name' => 'description',
                'required' => true
            ]
        ]
    ])

@endsection
