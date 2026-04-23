@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Pagina')

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3">
        <div>
            <h1 class="text-title">Catálogo de productos químicos</h1>
        </div>
    </div>
    
    @php
        if($count > 0) {
            $create = false;
        }
    @endphp

    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Themes\RecordsPage"
        :customQuery="[
            ['method' => 'where', 'field' => 'module_id', 'value' => $module->id]
        ]"
        :module="$module"
        :pageSize="['enabled' => false]"
        :header="[
            'enabled' => true,
            'title' => 'página del módulo '.$module->name,
            'action' => [
                'enabled' => $create ?? true,
                'name' => 'Añadir Catálogo',
                'icon' => 'bi bi-patch-plus',
                'route' => 'admin.themes.record.create',
            ],
        ]"
        :columns="[
            ['label' => 'Nombre', 'width' => '20%'],
            ['label' => 'Fecha de creación','width' => '20%'],
            ['label' => 'Ultima actualización', 'width' => '20%']
        ]"
        :fields="['name', 'created_at', 'updated_at']"
        :status="['enabled' => true]"
        :actions="[
            'enabled' => true,
            'buttons' => [
                [
                    'icon' => 'bi bi-file-earmark-arrow-up',
                    'route' => 'admin.themes.record.item',
                    'params' => [
                        'page_id' => 'item-id'
                    ],
                    'class' => 'btn-dashboard-primary'
                ]
            ]
        ]"
        :edit="['enabled' => true, 'route' => 'admin.themes.record.edit', 'params' => ['page_id' => 'item-id']]"
        :toggle="['enabled' => true, 'route' => 'admin.themes.record.toggle', 'params' => ['page_id' => 'item-id']]"

        :delete="[
            'enabled' => true,
            'route' => 'admin.themes.record.destroy',
            'params' => ['page_id' => 'item-id'],
            'message' => '¿Está seguro de eliminar esta página? Esta acción no se puede deshacer.',
        ]"
    />
@endsection
