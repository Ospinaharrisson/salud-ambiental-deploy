@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Content\EstablishmentButton"
        :header="[
            'enabled' => true,
            'title' => 'Listado de botones de establecimientos',
            'action' => [
                'enabled' => true,
                'name' => 'Agregar Establecimiento',
                'icon' => 'bi bi-plus-circle',
                'route' => 'admin.home.establishment.create'
            ],
        ]"
        :columns="[
            [
                'label' => 'Nombre del botón',
                'width' => '30%'
            ],
            [
                'label' => 'Ultima modificación',
                'width' => '20%'
            ],
        ]"
        :fields="['name', 'updated_at']"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.home.establishment.edit']"
        :toggle="['enabled' => true, 'route' => 'admin.home.establishment.toggle']"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.establishment.destroy',
            'message' => '¿Está seguro de eliminar este establecimiento? Esta acción no se puede deshacer.',
        ]"
        :sort="['enabled' => true, 'id' => 'sortable-establishment', 'route' => 'admin.home.establishment.sort']"
    />
@endsection