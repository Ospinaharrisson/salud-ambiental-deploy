@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <div>
            <h1 class="text-title">Navegación del Menú</h1>
            <div class="text-note">Gestión de referencias</div>
        </div>
    </div>

    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Themes\NavCollection"
        :customQuery="[
            ['method' => 'where', 'field' => 'module_id', 'value' => $module->id]
        ]"
        :module="$module"
        :header="[
            'enabled' => true,
            'title' => 'Listado de paginas del módulo '.$module->name,
            'action' => [
                'enabled' => true,
                'name' => 'Agregar colección de archivos',
                'icon' => 'bi bi-patch-plus',
                'redirect' => false,
                'id' => 'openCollectionCreateModal'
            ],
        ]"
        :columns="[
            ['label' => 'Nombre', 'width' => '20%'],
            ['label' => 'Fecha de creación','width' => '20%'],
            ['label' => 'Ultima actualización', 'width' => '20%']
        ]"
        :fields="['name', 'created_at', 'updated_at']"
        :sort="['enabled' => true, 'id' => 'sortable-collections', 'route' => 'admin.themes.navigation.sort', 'params' => ['module' => $module]]"
        :status="['enabled' => true]"
        :actions="[
            'enabled' => true,
            'buttons' => [
                [
                    'icon' => 'bi bi-file-earmark-arrow-up',
                    'route' => 'admin.themes.navigation.entries',
                    'params' => [
                        'collection_id' => 'item-id'
                    ],
                    'class' => 'btn-dashboard-primary'
                ]
            ]
        ]"
        :edit="['enabled' => true, 'route' => 'admin.themes.navigation.edit', 'params' => ['collection_id' => 'item-id']]"
        :toggle="['enabled' => true, 'route' => 'admin.themes.navigation.toggle', 'params' => ['collection_id' => 'item-id']]"

        :delete="[
            'enabled' => true,
            'route' => 'admin.themes.navigation.destroy',
            'params' => ['collection_id' => 'item-id'],
            'message' => '¿Está seguro de eliminar esta colección de archivos? Esta acción no se puede deshacer.',
        ]"
    />
@endsection

@push('modals')
    @include('Admin.Dashboard.Themes.navigation.Components.collection-create-modal')
@endpush



