
<div class="modal" tabindex="-1" id="calendarCreateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('Admin.Components.Sections.Form.dashboard-form', [
                    'form' => [
                        'action' => 'create',
                        'route' => 'admin.home.calendar.store',
                        'header' => false,
                        'modal' => true
                    ],
                    'fields' => [
                        [
                            'label' => 'Nombre del Evento',
                            'name' => 'name',
                            'required' => true
                        ],
                        [
                            'name' => 'date',
                            'hidden' => true
                        ]
                    ],
                    'widgets' => [
                        'image' => [
                            'enabled' => true,
                            'label' => 'Imagen',
                            'name' => 'image',
                            'required' => true
                        ],
                        'select' => [
                            'enabled' => true,
                            'label' => 'Tipo de Redirección',
                            'required' => false
                        ]
                    ]
                ])
            </div>                
        </div>
    </div>
</div>
