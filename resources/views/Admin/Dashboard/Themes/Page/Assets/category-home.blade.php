@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <div>
            <h1 class="text-title">{{ $page->name }}</h1>
            <div class="text-note">Gestión de referencias de la página</div>
        </div>
       <a href="{{ route('admin.themes.page', $module->id) }}" class="btn btn-outline-success">
             Volver al listado de Paginas
        </a>
    </div>

    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Themes\PageAssetCategory"
        :customQuery="[
            ['method' => 'where', 'field' => 'page_id', 'value' => $page->id]
        ]"
        :module="$module"
        :ancestors="[ 'page_id' => $page->id ]"
        :header="[
            'enabled' => true,
            'title' => 'categorías de archivos de la página ' . $page->name,
            'action' => [
                'enabled' => true,
                'name' => 'Agregar categoría',
                'icon' => 'bi bi-patch-plus',
                'route' => 'admin.themes.page.categories.create',
            ],
        ]"
        :columns="[
            ['label' => 'Nombre', 'width' => '20%'],
            ['label' => 'Grupo', 'width' => '20%'],
            ['label' => 'Ultima actualización', 'width' => '20%']
        ]"
        :fields="['name', 'groupTitle', 'updated_at']"
        :sort="['enabled' => true, 'id' => 'sortable-categories', 'route' => 'admin.themes.page.categories.sort']"
        :status="['enabled' => true]"
        :actions="[
            'enabled' => true,
            'buttons' => [
                [
                    'icon' => 'bi bi-file-earmark-arrow-up',
                    'route' => 'admin.themes.page.categories.asset',
                    'title' => 'Gestionar archivos de la categoría',
                    'params' => [
                        'category_id' => 'item-id'
                    ],
                    'class' => 'btn-dashboard-primary'
                ]
            ]
        ]"
        :edit="['enabled' => true, 'route' => 'admin.themes.page.categories.edit', 'params' => ['category_id' => 'item-id']]"
        :toggle="['enabled' => true, 'route' => 'admin.themes.page.categories.toggle', 'params' => ['category_id' => 'item-id']]"

        :delete="[
            'enabled' => true,
            'route' => 'admin.themes.page.categories.destroy',
            'params' => ['category_id' => 'item-id'],
            'message' => '¿Está seguro de eliminar esta categoría? Esta acción no se puede deshacer.',
        ]"
    />
@endsection