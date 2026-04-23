@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Banner')

@section('content')
    <livewire:admin.components.dashboard-table 
        model="\App\Models\Shared\Content\Banner"
        :header="[
            'enabled' => true,
            'title' => 'Listado de imágenes del Banner',
            'action' => [
                'enabled' => true,
                'name' => 'Agregar Imagen Al Banner Principal',
                'icon' => 'bi bi-plus-circle',
                'route' => 'admin.home.banner.create'
            ],
        ]"
        :columns="[
            [
                'label' => 'Nombre de la imagen',
                'width' => '30%'
            ],
            [
                'label' => 'Ultima modificación',
                'width' => '20%'
            ],
        ]"
        :fields="['name', 'updated_at']"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.home.banner.edit']"
        :toggle="['enabled' => true, 'route' => 'admin.home.banner.toggle']"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.banner.destroy',
            'message' => '¿Está seguro de eliminar esta imagen del banner? Esta acción no se puede deshacer.',
        ]"
        :sort="['enabled' => true, 'id' => 'sortable-banners', 'route' => 'admin.home.banner.sort']"
    />
@endsection