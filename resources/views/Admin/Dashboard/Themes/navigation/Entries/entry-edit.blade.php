@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Nueva referencia
        </h5>
        <a href="{{ route('admin.themes.navigation', ['module' => $module]) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Editar referencia: ' . $entry->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.themes.navigation.entries.update',
            'object' => $entry,
            'params' => [
                'module' => $module,
                'collection_id' => $collection_id,
                'entry_id' => $entry->id
            ],
        ],
        'fields' => [
            [
                'label' => 'Nombre de la referencia',
                'name' => 'name',
                'required' => true
            ],
        ],
        'widgets' => [
            'select' => [
                'enabled' => true,
                'label' => 'Información de la referencia',
            ]
        ]
    ])
@endsection
