@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar colección: {{ $collection->name }}
        </h5>
        <a href="{{ route('admin.themes.navigation', ['module' => $module]) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => $collection->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.themes.navigation.update',
            'object' => $collection,
            'params' => [
                'module' => $module,
                'collection_id' => $collection->id
            ],
        ],
        'fields' => [
            [
                'label' => 'Nombre de la colección',
                'name' => 'name',
                'required' => true
            ],
        ],
    ])
@endsection
