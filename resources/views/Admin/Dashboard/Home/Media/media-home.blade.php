@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Muro Social')

@section('content')
    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Content\MediaGallery"
        :header="[
            'enabled' => true,
            'title' => 'Listado de imágenes del Muro Social',
            'action' => [
                'enabled' => true,
                'name' => 'Agregar Imagen al Muro Social',
                'icon' => 'bi bi-plus-circle',
                'route' => 'admin.home.media.create'
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
        :edit="['enabled' => true, 'route' => 'admin.home.media.edit']"
        :toggle="['enabled' => true, 'route' => 'admin.home.media.toggle']"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.media.destroy',
            'message' => '¿Está seguro de eliminar esta imagen del muro social? Esta acción no se puede deshacer.',
        ]"
        :sort="['enabled' => true, 'id' => 'sortable-media', 'route' => 'admin.home.media.sort']"
    />
@endsection
