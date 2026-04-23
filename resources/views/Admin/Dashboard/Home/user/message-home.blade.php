@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <livewire:admin.components.dashboard-table
        model="App\Models\Shared\Home\UserMessage"
        :header="[
            'enabled' => true,
            'title' => 'Mensajes de Contacto'
        ]"
        :columns="['Nombre', 'Correo', 'Tema', 'Fecha']"
        :fields="['name', 'email', 'topic', 'created_at']"
        :actions="[
            'enabled' => true,
            'buttons' => [
                [
                    'icon' => 'bi bi-chat-dots',
                    'route' => 'admin.home.message.show',
                    'params' => [
                        'id' => 'item-id'
                    ],
                    'class' => 'btn-dashboard-primary'
                ]
            ]
        ]"
        :delete="[
            'enabled' => true,
            'route' => 'admin.home.message.destroy',
            'message' => '¿Está seguro de eliminar este mensaje? Esta acción no se puede deshacer.'
        ]"
    />
@endsection
