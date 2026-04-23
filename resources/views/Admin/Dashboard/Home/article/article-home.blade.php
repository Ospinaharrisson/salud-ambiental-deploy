@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Noticias')

@section('content')
    <livewire:admin.components.dashboard-table
        model="\App\Models\Shared\Content\Article"
        :header="[
            'enabled' => true,
            'title' => 'Listado de noticias',
            'action' => [
                'enabled' => true,
                'name' => 'Agregar Noticia',
                'route' => 'admin.home.article.create'
            ]
        ]"
        :columns="[
            ['label' => 'Título', 'width' => '20%'],
            ['label' => 'Fecha Creación', 'width' => '20%'],
            ['label' => 'Ultima Modificación', 'width' => '20%'],
        ]"
        :fields="['name', 'created_at', 'updated_at']"
        :sort="['enabled' => true, 'id' => 'sortable-articles', 'route' => 'admin.home.article.sort']"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.home.article.edit']"
        :toggle="['enabled' => true, 'route' => 'admin.home.article.toggle']"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.article.destroy',
            'message' => '¿Está seguro de eliminar este artículo? Esta acción no se puede deshacer.',
        ]"
    />
    
@endsection