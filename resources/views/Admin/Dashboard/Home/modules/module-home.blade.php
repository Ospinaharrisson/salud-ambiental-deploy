@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')    
    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Home\Module"
        :customQuery="[
            ['method' => 'where', 'field' => 'type', 'value' => 'global']
        ]"
        :header="[
            'enabled' => true,
            'title' => 'Listado de Menús',
            'action' => [
                'enabled' => true,
                'name' => 'Agregar Módulo',
                'icon' => 'bi bi-patch-plus',
                'route' => 'admin.home.module.create'
            ],
        ]"
        :columns="['Nombre']"
        :fields="['name']"
        :sort="['enabled' => true, 'id' => 'sortable-modules', 'route' => 'admin.home.module.sort']"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.home.module.edit']"
        :toggle="['enabled' => true, 'route' => 'admin.home.module.toggle']"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.module.destroy',
            'message' => '¿Está seguro de eliminar este módulo? Esta acción no se puede deshacer.',
        ]"
    />
@endsection