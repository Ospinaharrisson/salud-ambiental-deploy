@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Establecimientos favorables del módulo')

@section('content')
    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Content\EstablishmentAsset"
        :customQuery="[
            ['method' => 'where', 'field' => 'module_id', 'value' => $module->id],
            ['method' => 'where', 'field' => 'category', 'value' => 'favorable']
        ]"
        :module="$module"
        :header="[
            'enabled' => true,
            'title' => 'Listado de establecimientos favorables del módulo '.$module->name,
            'action' => [
                'enabled' => true,
                'name' => 'Agregar establecimiento',
                'icon' => 'bi bi-patch-plus',
                'route' => 'admin.themes.favorable.create',
                'params' => [
                    'module' => $module->id
                ]
            ],
        ]"
        :columns="[
            ['label' => 'Nombre', 'width' => '30%'],
            ['label' => 'Fecha de creación','width' => '20%'],
            ['label' => 'Última actualización', 'width' => '20%']
        ]"
        :fields="['name', 'created_at', 'updated_at']"
        :sort="['enabled' => true, 'id' => 'sortable-favorable', 'route' => 'admin.themes.favorable.sort', 'params' => ['module' => $module->id]]"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.themes.favorable.edit', 'params' => ['favorable_id' => 'item-id', 'module' => $module->id]]"
        :toggle="['enabled' => true, 'route' => 'admin.themes.favorable.toggle', 'params' => ['favorable_id' => 'item-id', 'module' => $module->id]]"
        :delete="[
            'enabled' => true,
            'route' => 'admin.themes.favorable.destroy',
            'params' => ['favorable_id' => 'item-id', 'module' => $module->id],
            'message' => '¿Está seguro de eliminar este establecimiento? Esta acción no se puede deshacer.',
        ]"
    />
@endsection