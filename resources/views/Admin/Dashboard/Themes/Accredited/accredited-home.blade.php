@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Establecimientos acreditados del módulo')

@section('content')
    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Content\EstablishmentAsset"
        :customQuery="[
            ['method' => 'where', 'field' => 'module_id', 'value' => $module->id],
            ['method' => 'where', 'field' => 'category', 'value' => 'accredited']
        ]"
        :module="$module"
        :header="[
            'enabled' => true,
            'title' => 'Listado de establecimientos acreditados del módulo '.$module->name,
            'action' => [
                'enabled' => true,
                'name' => 'Agregar establecimiento',
                'icon' => 'bi bi-patch-plus',
                'route' => 'admin.themes.accredited.create',
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
        :sort="['enabled' => true, 'id' => 'sortable-accredited', 'route' => 'admin.themes.accredited.sort', 'params' => ['module' => $module->id]]"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.themes.accredited.edit', 'params' => ['accredited_id' => 'item-id', 'module' => $module->id]]"
        :toggle="['enabled' => true, 'route' => 'admin.themes.accredited.toggle', 'params' => ['accredited_id' => 'item-id', 'module' => $module->id]]"
        :delete="[
            'enabled' => true,
            'route' => 'admin.themes.accredited.destroy',
            'params' => ['accredited_id' => 'item-id', 'module' => $module->id],
            'message' => '¿Está seguro de eliminar este establecimiento? Esta acción no se puede deshacer.',
        ]"
    />
@endsection
