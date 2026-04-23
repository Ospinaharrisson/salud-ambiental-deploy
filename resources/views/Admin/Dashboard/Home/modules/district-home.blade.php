@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')    
    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Home\Module"
        :customQuery="[
            ['method' => 'where', 'field' => 'type', 'value' => 'district']
        ]"
        :header="[
            'enabled' => true,
            'title' => 'Listado de Distritos',
            'action' => [
                'enabled' => true,
                'name' => 'Agregar Distrito',
                'icon' => 'bi bi-patch-plus',
                'route' => 'admin.home.district.create'
            ],
        ]"
        :columns="['Nombre']"
        :fields="['name']"
        :sort="['enabled' => true, 'id' => 'sortable-districts', 'route' => 'admin.home.district.sort']"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.home.district.edit']"
        :toggle="['enabled' => true, 'route' => 'admin.home.district.toggle']"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.district.destroy',
            'message' => '¿Está seguro de eliminar este distrito? Esta acción no se puede deshacer.',
        ]"
    />
@endsection
