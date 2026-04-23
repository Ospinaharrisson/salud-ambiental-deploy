@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Hospitales')

@section('content')
        <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Content\HealthNetwork"
        :header="[
            'enabled' => true,
            'title' => 'subredes de hospitales',
            'action' => [
                'enabled' => true,
                'name' => 'Agregar botón',
                'icon' => 'bi bi-plus-circle',
                'route' => 'admin.home.network.create'
            ],
        ]"
        :columns="[
            [
                'label' => 'Nombre de la subred',
                'width' => '30%'
            ],
            [
                'label' => 'Ultima modificación',
                'width' => '20%'
            ],
        ]"
        :fields="['name', 'updated_at']"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.home.network.edit']"
        :toggle="['enabled' => true, 'route' => 'admin.home.network.toggle']"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.network.destroy',
            'message' => '¿Está seguro de eliminar esta subred? Esta acción no se puede deshacer.',
        ]"
        :sort="['enabled' => true, 'id' => 'sortable-networks', 'route' => 'admin.home.network.sort']"
    />
@endsection
