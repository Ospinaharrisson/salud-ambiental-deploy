@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Botones del módulo')

@section('content')
    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Themes\ModuleButton"
        :customQuery="[
            ['method' => 'where', 'field' => 'module_id', 'value' => $module->id]
        ]"
        :module="$module"
        :header="[
            'enabled' => true,
            'title' => 'Listado de botones del módulo '.$module->name,
            'action' => [
                'enabled' => true,
                'name' => 'Agregar botón',
                'icon' => 'bi bi-patch-plus',
                'route' => 'admin.themes.buttons.create'
            ],
        ]"
        :columns="[
            ['label' => 'Nombre', 'width' => '20%'],
            ['label' => 'Fecha de creación','width' => '20%'],
            ['label' => 'Ultima actualización', 'width' => '20%']
        ]"
        :fields="['name', 'created_at', 'updated_at']"
        :sort="['enabled' => true, 'id' => 'sortable-buttons', 'route' => 'admin.themes.buttons.sort']"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.themes.buttons.edit', 'params' => ['button_id' => 'item-id']]"
        :toggle="['enabled' => true, 'route' => 'admin.themes.buttons.toggle', 'params' => ['button_id' => 'item-id']]"

        :delete="[
            'enabled' => true,
            'route' => 'admin.themes.buttons.destroy',
            'params' => ['button_id' => 'item-id'],
            'message' => '¿Está seguro de eliminar este botón? Esta acción no se puede deshacer.',
        ]"
    />
@endsection
