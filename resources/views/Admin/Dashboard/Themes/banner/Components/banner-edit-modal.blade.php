<style>
    .modal-body .my-5 {
        margin: 0 !important;
    }
</style>

<div class="modal" tabindex="-1" id="bannerEditModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('Admin.Components.Sections.Form.dashboard-form', [
                    'form' => [
                        'action' => 'create',
                        'route' => 'admin.themes.banner.store',
                        'params' => [
                            'module' => $module
                        ],
                        'modal' => true
                    ],
                    'fields' => [
                        [
                            'name' => 'module_id',
                            'value' => $module->id,
                            'hidden' => true
                        ]
                    ],
                    'widgets' => [
                        'image' => [
                            'enabled' => true,
                            'label' => 'Imagen',
                            'name' => 'image',
                            'required' => true
                        ]
                    ]
                ])
            </div>                
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const trigger = document.getElementById('openBannerCreateModal');
        const modalEl = document.getElementById('bannerEditModal');

        if (trigger && modalEl) {
            const modal = new bootstrap.Modal(modalEl);

            trigger.addEventListener('click', () => {
                modal.show();
            });
        }
    });
</script>
