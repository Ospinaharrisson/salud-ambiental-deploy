<style>
    #item-edit-form .my-5 {
        margin-top: 0 !important;
    }
</style>

@include('Admin.Components.Sections.Form.dashboard-form', [
    'title' => $item->name,
    'form' => [
        'header' => false,
        'action' => 'edit',
        'route' => 'admin.themes.record.item.update',
        'object' => $item,
        'params' => [
            'module' => $module,
            'page_id' => $page_id,
            'item_id' => $item->id
        ]
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
            'required' => false
        ],
        [
            'label' => 'Cantidad Mensualmente utilizada (Kg)',
            'name' => 'monthly_used',
            'type' => 'number',
            'required' => false
        ],
        [
            'label' => 'Puntaje',
            'name' => 'score',
            'type' => 'number',
            'required' => false
        ]
    ],
])