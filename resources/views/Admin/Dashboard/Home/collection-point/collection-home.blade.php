@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <livewire:admin.components.dashboard-table
        model="\App\Models\Shared\Content\CollectionPoint"
        :header="[
            'enabled' => true,
            'title' => 'Listado de Puntos de Recolección',
            'action' => [
                'enabled' => true,
                'name' => 'Agregar Punto de Recolección',
                'icon' => 'bi bi-patch-plus',
                'route' => 'admin.home.collection.create'
            ],
        ]"
        :columns="['Nombre']"
        :fields="['name']"
        :sort="['enabled' => true, 'id' => 'sortable-collection', 'route' => 'admin.home.collection.sort']"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.home.collection.edit']"
        :toggle="['enabled' => true, 'route' => 'admin.home.collection.toggle']"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.collection.destroy',
            'message' => '¿Está seguro de eliminar este punto de recolección? Esta acción no se puede deshacer.',
        ]"
    />
@endsection
