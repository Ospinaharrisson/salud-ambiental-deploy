@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Agregar elemento a la categoría: {{ $category }}
        </h5>
        <a href="{{ route('admin.home.footer') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @php
        $linkCategories = ['Aliados estratégicos', 'Ayudas de accesibilidad', 'Acerca del sitio'];
        $link = in_array($category, $linkCategories);
    @endphp

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Nuevo Elemento',
        'form' => [
            'enabled' => true,
            'action' => 'create',
            'route' => 'admin.home.footer.store'
        ],
        'fields' => array_merge([
            [
                'name' => 'category',
                'value' => $category,
                'hidden' => true
            ],
            [
                'label' => 'Nombre del elemento',
                'name' => 'name',
                'required' => true
            ]
        ],
        $link ? [[
            'label' => 'Enlace del elemento',
            'name' => 'link',
            'required' => false,
            'type' => 'url'
        ]] : [])
    ])
@endsection