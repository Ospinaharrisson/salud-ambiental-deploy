@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Indicadores')

@section('content')
    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Content\WeatherInsight"
        :header="[
            'enabled' => true,
            'title' => 'Listado de indicadores del clima',
            'action' => [
                'enabled' => true,
                'name' => 'Agregar Indicador',
                'icon' => 'bi bi-patch-plus',
                'route' => 'admin.home.insight.create'
            ],
        ]"
        :columns="[
                [
                    'label' => 'nombre del botón',
                    'width' => '50%'    
                ],
                [  
                    'label' => 'Última modificación',
                    'width' => '20%'
                ],
            ]"
        :fields="['name', 'updated_at']"
        :sort="['enabled' => true, 'id' => 'sortable-insights', 'route' => 'admin.home.insight.sort']"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.home.insight.edit']"
        :toggle="['enabled' => true, 'route' => 'admin.home.insight.toggle']"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.insight.destroy',
            'message' => '¿Está seguro de eliminar este indicador? Esta acción no se puede deshacer.',
        ]"
    />
@endsection
