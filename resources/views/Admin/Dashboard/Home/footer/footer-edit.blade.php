@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar información de: {{ $item->name }}
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
        'title' => 'Elemento: ' . $item->name . ' - ' . $category,
        'form' => [
            'enabled' => true,
            'action' => 'edit',
            'route' => 'admin.home.footer.update',
            'params' => [
                'category' => $category,
                'id' => $item->id
            ],
            'object' => $item
        ],
        'fields' => array_merge([
            [
                'label' => 'Nombre del elemento',
                'name' => 'name',
                'required' => false
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