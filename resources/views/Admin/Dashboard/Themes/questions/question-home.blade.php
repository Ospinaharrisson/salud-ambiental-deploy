@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Preguntas del módulo')

@section('content')
    <livewire:admin.components.dashboard-table 
        model="App\Models\Shared\Themes\ModuleQuestion"
        :customQuery="[
            ['method' => 'where', 'field' => 'module_id', 'value' => $module->id]
        ]"
        :module="$module"
        :header="[
            'enabled' => true,
            'title' => 'Listado de preguntas del módulo '.$module->name,
            'action' => [
                'enabled' => true,
                'name' => 'Agregar pregunta',
                'icon' => 'bi bi-patch-plus',
                'route' => 'admin.themes.questions.create',
            ],
        ]"
        :columns="[
            ['label' => 'Nombre', 'width' => '20%'],
            ['label' => 'Fecha de creación','width' => '20%'],
            ['label' => 'Ultima actualización', 'width' => '20%']
        ]"
        :fields="['name', 'created_at', 'updated_at']"
        :sort="['enabled' => true, 'id' => 'sortable-questions', 'route' => 'admin.themes.questions.sort']"
        :status="['enabled' => true]"
        :edit="['enabled' => true, 'route' => 'admin.themes.questions.edit', 'params' => ['question_id' => 'item-id']]"
        :toggle="['enabled' => true, 'route' => 'admin.themes.questions.toggle', 'params' => ['question_id' => 'item-id']]"

        :delete="[
            'enabled' => true,
            'route' => 'admin.themes.questions.destroy',
            'params' => ['question_id' => 'item-id'],
            'message' => '¿Está seguro de eliminar esta pregunta? Esta acción no se puede deshacer.',
        ]"
    />
@endsection
