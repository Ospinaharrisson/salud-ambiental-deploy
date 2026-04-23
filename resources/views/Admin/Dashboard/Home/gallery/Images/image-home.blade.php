@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Imágenes de Galería')

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Galería - Imágenes del evento: {{ $event->name }}
        </h5>
        <a href="{{ route('admin.home.gallery') }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Home\GalleryImage"
        :customQuery="[
            ['method' => 'where', 'field' => 'gallery_event_id', 'value' => $event->id]
        ]"
        :header="[
            'enabled' => true,
            'title' => 'Imagenes de la galería: ' . $event->name,
            'action' => [
                'enabled' => true,
                'name' => 'añadir imagen',
                'icon' => 'bi bi-plus-circle',
                'route' => 'admin.home.gallery.images.create',
                'params' => [
                    'event_id' => $event->id
                ]
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
        :sort="['enabled' => true, 'id' => 'sortable-gallery-images', 'route' => 'admin.home.gallery.images.sort']"
        :edit="[
            'enabled' => true,
            'route' => 'admin.home.gallery.images.edit',
            'params' => [
                'event_id' => $event->id,
                'image_id' => 'item-id'
            ]
        ]"
        :toggle="[
            'enabled' => true,
            'route' => 'admin.home.gallery.images.toggle',
            'params' => [
                'event_id' => $event->id,
                'image_id' => 'item-id'
            ]
        ]"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.gallery.images.destroy',
            'params' => [
                'event_id' => $event->id,
                'image_id' => 'item-id',
            ],
            'message' => '¿Está seguro de eliminar esta imagen de la galería? Esta acción no se puede deshacer.',
        ]"
    />
@endsection