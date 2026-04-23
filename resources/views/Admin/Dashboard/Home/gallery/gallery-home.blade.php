@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <div>
            <h1 class="text-title">Galería de eventos</h1>
            <div class="text-note">Gestión de imágenes por evento</div>
        </div>
    </div>

    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Home\GalleryEvent"
        :header="[
            'enabled' => true,
            'title' => 'Galerias disponibles',
            'action' => [
                'enabled' => true,
                'name' => 'Nueva Galería',
                'icon' => 'bi bi-plus-circle',
                'route' => 'admin.home.gallery.create'
            ],
        ]"
        :columns="[
            [
                'label' => 'Nombre de la galería',
                'width' => '30%'
            ],
            [
                'label' => 'Ultima modificación',
                'width' => '20%'
            ],
        ]"
        :fields="['name', 'updated_at']"
        :actions="[
            'enabled' => true,
            'buttons' => [
                [
                    'icon' => 'bi bi-file-earmark-arrow-up',
                    'route' => 'admin.home.gallery.images',
                    'class' => 'btn btn-sm btn-dashboard-primary'
                ]
            ]
        ]"
        :status="['enabled' => true]"
        :sort="['enabled' => true, 'route' => 'admin.home.gallery.sort', 'event_id' => 'sortable-galleries']"
        :edit="['enabled' => true, 'route' => 'admin.home.gallery.edit']"
        :toggle="['enabled' => true, 'route' => 'admin.home.gallery.toggle']"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.gallery.destroy',
            'message' => '¿Está seguro de eliminar esta galería? Esta acción no se puede deshacer.',
        ]"
    />
@endsection
