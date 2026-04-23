@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3">
        <div>
            <h1 class="text-title">Imagen Destacada</h1>
        </div>
    </div>

    @php
        if($count >= 1) {
            $create = false;
        }
    @endphp

    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Content\FeaturedImage"
        :pageSize="['enabled' => false]"
        :header="[
            'enabled' => true,
            'title' => 'Imagen destacada',
            'action' => [
                'enabled' => $create ?? true,
                'name' => 'Agregar Imagen',
                'icon' => 'bi bi-patch-plus',
                'route' => 'admin.home.featured.create'
            ],
        ]"
        :columns="['Nombre']"
        :fields="['name']"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.home.featured.edit']"
        :toggle="['enabled' => true, 'route' => 'admin.home.featured.toggle']"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.featured.destroy',
            'message' => '¿Está seguro de eliminar esta imagen? Esta acción no se puede deshacer.',
        ]"
    /> 
@endsection
