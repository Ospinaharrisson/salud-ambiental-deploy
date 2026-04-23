@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Editar noticia')

@section('content')
    <div class="d-flex justify-content-between align-items-center rounded p-3 mt-3 mb-5 bg">
        <h5 class="text-title mb-0">
            Editar Noticia
        </h5>
        <a href="{{ route('admin.home.article') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar noticia',
        'form' => [
            'action' => 'edit',
            'route' => 'admin.home.article.update',
            'params' => ['id' => $article->id],
            'object' => $article
        ],
        'fields' => [
            [
                'label' => 'Título de la noticia',
                'name' => 'name',
                'required' => true
            ],
        ],
        'widgets' => [
            'image' => [
                'enabled' => true,
                'name' => 'image',
                'label' => 'Imagen destacada',
                'required' => false
            ],
            'select' => [
                'enabled' => true,
                'label' => 'Redirección de la noticia'
            ],
            'textarea' => [
                'enabled' => true,
                'name' => 'description',
                'label' => 'Contenido de la noticia'
            ]
        ]
    ])
@endsection
