@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3">
        <div>
            <h1 class="text-title">Banner del Menú</h1>
        </div>
        @if(!isset($banner))
            <button id="openBannerCreateModal" class="btn btn-outline-success">
                Añadir banner
            </button>
        @endif
    </div>
    <div class="box-shadow mb-5">
        @if(isset($banner))
            <div class="p-4">
                <img src="{{ renderBase64Image($banner->image) }}" alt="Banner del módulo"
                    style="height: 200px; width: 100%; object-fit: contain">
            </div>
        @endif
    </div>

    @if(isset($banner))
        @include('Admin.Components.Sections.Form.dashboard-form', [
            'form' => [
                'action' => 'edit',
                'route' => 'admin.themes.banner.update',
                'object' => $banner,
                'params' => [
                    'module' => $module,
                    'banner_id' => $banner->id
                ],
                'modal' => true
            ],
            'widgets' => [
                'image' => [
                    'enabled' => true,
                    'label' => 'Actualizar banner',
                    'name' => 'image',
                    'currentPreview' => false
                ]
            ]
        ])
    @else
        <div class="box-rounded p-4 text-center text-muted border border-dashed">
            <em>No hay un banner asignado a este módulo.</em>
        </div>
    @endif
@endsection

@push('modals')
    @if(!isset($banner))
        @include('Admin.Dashboard.Themes.banner.Components.banner-edit-modal')
    @endif
@endpush