@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="mt-3 mb-5">
        <div class="d-flex justify-content-between align-items-center box-rounded bg p-3">
            <h5 class="text-title mb-0">
                Editar pagina: {{ $page->name }}
            </h5>
            <a href="{{ route('admin.themes.page', ['module' => $module]) }}" class="btn btn-outline-success">
                Regresar
            </a>
        </div>

        <div class="box-rounded box-shadow p-3 mt-4">
            <label class="form-label fw-bold">Enlace público de la página</label>

            <div class="input-group">
                <input 
                    type="text"
                    class="form-control"
                    id="pageUrl"
                    value="{{ route('page.show', ['id' => $page->id, 'slug' => $page->slug]) }}"
                    readonly
                >

                <button 
                    type="button"
                    class="btn btn-outline-primary"
                    onclick="copyPageUrl()"
                >
                    Copiar
                </button>
            </div>

            @if (!$page->is_active)
                <small class="text-warning d-block mt-2">
                    La página está inactiva.
                </small>
            @endif
        </div>
    </div>

    @include('Admin.Components.Sections.Form.dashboard-form', [
        'title' => $page->name,
        'form' => [
            'action' => 'edit',
            'route' => 'admin.themes.page.update',
            'object' => $page,
            'params' => [
                'module' => $module,
                'page_id' => $page->id
            ],
        ],
        'fields' => [
            [
                'label' => 'Nombre de la página',
                'name' => 'name',
                'required' => true
            ],
        ],
        'widgets' => [
            'checkbox' => [
                'enabled' => true,
                'label' => 'Mostrar en menú de navegación',
                'name' => 'show_in_navbar',
                'checked' => $page->show_in_navbar
            ],
            'image' => [
                'enabled' => true,
                'label' => 'imagen',
                'name' => 'image'
            ],
            'textarea' => [
                'enabled' => true,
                'label' => 'Descripción de la página',
                'name' => 'description'
            ]
        ]
    ])

    @push('scripts')
        <script src="{{ asset('assets/js/admin/modules/Themes/Page/page-url.js') }}"></script>
    @endpush
@endsection