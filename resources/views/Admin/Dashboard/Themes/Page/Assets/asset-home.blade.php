@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <div>
            <h1 class="text-title">{{ $category->page->name }}</h1>
            <div class="text-note">Gestión de archivos de <strong>{{ $category->name }}</strong></div>
        </div>
       <a href="{{ route('admin.themes.page.categories', ['module' => $module, 'page_id' => $category->page_id, 'category_id' => $category->id]) }}" class="btn btn-outline-success">
             Volver a la pagina anterior
        </a>
    </div>

        <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Content\PageAsset"
        :customQuery="[
            ['method' => 'where', 'field' => 'page_asset_category_id', 'value' => $category->id]
        ]"
        :module="$module"
        :ancestors="[ 
            'page_id' => $category->page_id,
            'category_id' => $category->id 
        ]"
        :header="[
            'enabled' => true,
            'title' => 'archivos de la categoría ' . $category->name,
            'action' => [
                'enabled' => true,
                'name' => 'Agregar archivo',
                'icon' => 'bi bi-patch-plus',
                'title' => 'Agregar nuevo archivo a la categoría ' . $category->name,
                'route' => 'admin.themes.page.categories.asset.create',
            ],
        ]"
        :columns="[
            ['label' => 'Nombre del archivo', 'width' => '20%'],
            ['label' => 'fecha de creación', 'width' => '20%'],
            ['label' => 'Ultima actualización', 'width' => '20%']
        ]"
        :fields="['name', 'created_at', 'updated_at']"
        :sort="['enabled' => true, 'id' => 'sortable-assets', 'route' => 'admin.themes.page.categories.asset.sort']"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.themes.page.categories.asset.edit', 'params' => ['asset_id' => 'item-id']]"
        :toggle="['enabled' => true, 'route' => 'admin.themes.page.categories.asset.toggle', 'params' => ['asset_id' => 'item-id']]"
        :delete="[
            'enabled' => true,
            'route' => 'admin.themes.page.categories.asset.destroy',
            'params' => ['asset_id' => 'item-id'],
            'message' => '¿Está seguro de eliminar este archivo? Esta acción no se puede deshacer.',
        ]"
    />
@endsection