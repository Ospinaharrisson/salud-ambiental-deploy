@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <livewire:admin.components.dashboard-table 
        model="\App\Models\Shared\Content\AppButton"
        :header="[
            'enabled' => true,
            'title' => 'Listado de Botones de Aplicación',
            'action' => [
                'enabled' => true,
                'name' => 'Agregar Botón',
                'icon' => 'bi bi-patch-plus',
                'route' => 'admin.home.app.create'
            ],
        ]"
        :columns="['Nombre']"
        :fields="['name']"
        :sort="['enabled' => true, 'id' => 'sortable-app', 'route' => 'admin.home.app.sort']"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.home.app.edit']"
        :toggle="['enabled' => true, 'route' => 'admin.home.app.toggle']"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.app.destroy',
            'message' => '¿Está seguro de eliminar este botón? Esta acción no se puede deshacer.',
        ]"
    />
@endsection
