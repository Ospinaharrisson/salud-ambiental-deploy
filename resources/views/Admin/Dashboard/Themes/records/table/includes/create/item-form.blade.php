<div id="step-1" class="step">
    @php
        $formObject = session('item', null);
    @endphp
    
    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => 'Datos del producto',
        'form' => [
            'action' => 'create',
            'route' => 'admin.themes.record.item.store.info',
            'params' => [
                'module' => $module,
                'page_id' => $page_id,
            ],
            'object' => $formObject
        ],
        'fields' => [
            [
                'label' => 'Nombre del elemento',
                'name' => 'name',
                'required' => true
            ],
            [
                'label' => 'Número de registro CAS',
                'name' => 'cas_number',
                'placeHolder' => 'Desconocido',
                'required' => false
            ],
            [
                'label' => 'Número ONU asociado',
                'name' => 'onu_number',
                'placeHolder' => 'Desconocido',
                'required' => false
            ],
            [
                'label' => 'Cantidad Mensualmente almacenada (Kg)',
                'name' => 'monthly_stored',
                'type' => 'number',
                'required' => true
            ],
            [
                'label' => 'Cantidad Mensualmente utilizada (Kg)',
                'name' => 'monthly_used',
                'type' => 'number',
                'required' => true
            ],
            [
                'label' => 'Puntaje',
                'name' => 'score',
                'type' => 'number',
                'required' => true
            ],
            [
                'name' => 'page_id',
                'value' => $page_id,
                'hidden' => true
            ]
        ]
    ])
    <button type="button" class="btn btn-primary next-step"
        @unless(session('step-1')) disabled @endunless>
        Siguiente
    </button>
</div>