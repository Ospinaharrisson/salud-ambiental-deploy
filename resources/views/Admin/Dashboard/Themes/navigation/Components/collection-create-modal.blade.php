<style>
    .modal-body .my-5 {
        margin: 0 !important;
    }
</style>

<div class="modal" tabindex="-1" id="collectionCreateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva sección de navegación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('Admin.Components.Sections.Form.dashboard-form', [
                    'form' => [
                        'action' => 'create',
                        'route' => 'admin.themes.navigation.store',
                        'params' => [
                            'module' => $module
                        ],
                        'modal' => true
                    ],
                    'fields' => [
                        [
                            'label' => 'Nombre de la sección',
                            'name' => 'name',
                            'required' => true
                        ],
                        [
                            'name' => 'module_id',
                            'value' => $module->id,
                            'hidden' => true
                        ]
                    ]
                ])
            </div>                
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const trigger = document.getElementById('openCollectionCreateModal');
        const modalEl = document.getElementById('collectionCreateModal');

        if (trigger && modalEl) {
            const modal = new bootstrap.Modal(modalEl);

            trigger.addEventListener('click', () => {
                modal.show();
            });
        }
    });
</script>
