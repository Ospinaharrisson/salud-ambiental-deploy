@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'editar Banner')

@section('content')
    <div class="box-rounded d-flex justify-content-between align-items-center bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar Imagen del Banner Principal
        </h5>
        <a href="{{ route('admin.home.banner') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar: ' . $banner->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.home.banner.update',
            'params' => [
                'id' => $banner->id
            ],
            'object' => $banner
        ],
        'fields' => [
            [
                'label' => 'Nombre de la imagen',
                'name' => 'name',
                'required' => true
            ]
        ],
        'widgets' => [
            'image' => [
                'enabled' => true,
                'label' => 'Añadir Imagen',
                'name' => 'image'
            ],
            'select' => [
                'enabled' => true,
                'label' => 'Tipo de redirección',
                'required' => false,
                'current_link' => $banner->link ?? null,
                'current_base64' => $banner->content_base64 ?? null,
                'current_mime' => $banner->mime_type ?? null,
                'allow_clear' => true
            ]
        ]
    ])
@endsection