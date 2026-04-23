@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Lineas de interes')

@section('content')
    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Content\LineOfInterest"
        :header="[
            'enabled' => true,
            'title' => 'Listado de líneas de interés',
            'action' => [
                'enabled' => true,
                'name' => 'Agregar Línea de Interés',
                'icon' => 'bi bi-plus-circle',
                'route' => 'admin.home.line.create'
            ],
        ]"
        :columns="[
            [
                'label' => 'Nombre de la línea',
                'width' => '50%'
            ],
            [
                'label' => 'Ultima modificación',
                'width' => '20%'
            ],
        ]"
        :fields="['name', 'updated_at']"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.home.line.edit']"
        :toggle="['enabled' => true, 'route' => 'admin.home.line.toggle']"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.line.destroy',
            'message' => '¿Está seguro de eliminar esta línea? Esta acción no se puede deshacer.',
        ]"
        :sort="['enabled' => true, 'id' => 'sortable-line', 'route' => 'admin.home.line.sort']"
    />
@endsection
