@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Themes\Page"
        :customQuery="[
            ['method' => 'where', 'field' => 'module_id', 'value' => $module->id]
        ]"
        :module="$module"
        :header="[
            'enabled' => true,
            'title' => 'Listado de paginas del módulo '.$module->name,
            'action' => [
                'enabled' => true,
                'name' => 'Agregar página',
                'icon' => 'bi bi-patch-plus',
                'route' => 'admin.themes.page.create',
                'params' => [
                    'page_id' => 'item-id'
                ]
            ],
        ]"
        :columns="[
            ['label' => 'Nombre', 'width' => '20%'],
            ['label' => 'Fecha de creación','width' => '20%'],
            ['label' => 'Ultima actualización', 'width' => '20%'],
        ]"
        :fields="['name', 'created_at', 'updated_at']"
        :sort="['enabled' => true, 'id' => 'sortable-pages', 'route' => 'admin.themes.page.sort', 'params' => ['module' => $module]]"
        :status="['enabled' => true]"
        :status="[
            'enabled' => true,
            'extra' => [
                'enabled' => true,
                'key' => 'show_in_navbar',
                'label' => 'en menú'
            ]
        ]"
        :actions="[
            'enabled' => true,
            'buttons' => [
                [
                    'icon' => 'bi bi-file-earmark-arrow-up',
                    'route' => 'admin.themes.page.categories',
                    'title' => 'Documentos',
                    'params' => [
                        'page_id' => 'item-id'
                    ],
                    'class' => 'btn-dashboard-primary'
                ]
            ]
        ]"
        :edit="['enabled' => true, 'route' => 'admin.themes.page.edit', 'params' => ['page_id' => 'item-id']]"
        :toggle="['enabled' => true, 'route' => 'admin.themes.page.toggle', 'params' => ['page_id' => 'item-id']]"

        :delete="[
            'enabled' => true,
            'route' => 'admin.themes.page.destroy',
            'params' => ['page_id' => 'item-id'],
            'message' => '¿Está seguro de eliminar esta página? Esta acción no se puede deshacer.',
        ]"
    />
@endsection