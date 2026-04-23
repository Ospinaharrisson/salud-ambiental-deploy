@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Archivos de la colección: {{ $collection->name }}
        </h5>
        <a href="{{ route('admin.themes.navigation', ['module' => $module]) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>
    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Content\NavEntry"
        :customQuery="[
            ['method' => 'where', 'field' => 'nav_collection_id', 'value' => $collection->id]
        ]"
        :module="$module"
        :ancestors="['collection_id' => $collection->id]"
        :header="[
            'enabled' => true,
            'title' => 'Listado de archivos de la colección '.$collection->name,
            'action' => [
                'enabled' => true,
                'name' => 'Agregar archivo',
                'icon' => 'bi bi-patch-plus',
                'route' => 'admin.themes.navigation.entries.create',
                'params' => ['collection_id' => $collection->id],
            ],
        ]"
        :columns="[
            ['label' => 'Nombre', 'width' => '20%'],
            ['label' => 'Fecha de creación','width' => '20%'],
            ['label' => 'Ultima actualización', 'width' => '20%']
        ]"
        :fields="['name', 'created_at', 'updated_at']"
        :sort="['enabled' => true, 'id' => 'sortable-entries', 'route' => 'admin.themes.navigation.entries.sort', 'params' => ['module' => $module, 'collection_id' => $collection]]"
        :status="['enabled' => true]"
        :edit="[
            'enabled' => true, 
            'route' => 'admin.themes.navigation.entries.edit',  
            'params' => [
                'entry_id' => 'item-id'
                ]
            ]"
        :toggle="['enabled' => true, 'route' => 'admin.themes.navigation.entries.toggle',  'params' => ['entry_id' => 'item-id']]"
        :delete="[
            'enabled' => true,
            'route' => 'admin.themes.navigation.entries.destroy',
            'params' => ['entry_id' => 'item-id'],
            'message' => '¿Está seguro de eliminar este archivo? Esta acción no se puede deshacer.',
        ]"
    />
@endsection