@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Pagina')

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3">
        <div>
            <h1 class="text-title">Pagina Principal</h1>
        </div>
    </div>

    @php
        if($count >= 1) {
            $create = false;
        }
    @endphp
    
    <livewire:admin.components.dashboard-table
        model="App\Models\Shared\Home\HomePage"
        :header="[
            'enabled' => true,
            'title' => 'Pagina disponible',
            'action' => [
                'enabled' => $create ?? true,
                'name' => 'Agregar Pagina',
                'route' => 'admin.home.page.create'
            ]
        ]"
        :columns="[
            ['label' => 'Título', 'width' => '20%'],
            ['label' => 'Fecha Creación', 'width' => '20%'],
            ['label' => 'Ultima Modificación', 'width' => '20%'],
        ]"
        :pageSize="['enabled' => false]"
        :fields="['name', 'created_at', 'updated_at']"
        :sort="['enabled' => false]"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.home.page.edit']"
        :toggle="['enabled' => true, 'route' => 'admin.home.page.toggle']"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.page.destroy',
            'message' => '¿Está seguro de eliminar esta pagina? Esta acción no se puede deshacer.',
        ]"
    />
@endsection
