@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Registros')

@push('styles')    
    <link rel="stylesheet" href="{{ asset('assets/css/admin/modules/chemical-asset.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3 mb-5">
        <h5 class="text-title mb-0">
            Editar elemento: {{ $item->name }}
        </h5>
        <a href="{{ route('admin.themes.record.item', ['module' => $module, 'page_id' => $page_id]) }}" class="btn btn-outline-success">
            Regresar
        </a>
    </div>

    <ul class="nav tabs" id="editTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link tab bg active" id="general-tab" 
                    data-bs-toggle="tab" data-bs-target="#general"
                    type="button" role="tab" aria-controls="general"
                    aria-selected="true">
                Información principal
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tab tab-inactive" id="detalles-tab" 
                    data-bs-toggle="tab" data-bs-target="#detalles"
                    type="button" role="tab" aria-controls="detalles"
                    aria-selected="false">
                sellos
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tab tab-inactive" id="adicional1-tab"
                    data-bs-toggle="tab" data-bs-target="#adicional1"
                    type="button" role="tab" aria-controls="adicional1"
                    aria-selected="false">
                Actividades economicas
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tab tab-inactive" id="adicional2-tab"
                    data-bs-toggle="tab" data-bs-target="#adicional2"
                    type="button" role="tab" aria-controls="adicional2"
                    aria-selected="false">
                Peligros asociados
            </button>
        </li>
    </ul>
    <div class="tab-content" id="editTabContent">
        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
            <div id="item-edit-form">
                @include('Admin.Dashboard.Themes.records.table.includes.update.edit-form')
            </div>
        </div>
        <div class="tab-pane fade" id="detalles" role="tabpanel" aria-labelledby="detalles-tab">
            <div>
                @include('Admin.Dashboard.Themes.records.table.includes.image-form', [
                    'config' => [
                        'route' => 'admin.themes.record.item.update.stamp',
                        'parmas' => ['module'=>$module,'page_id'=>$page_id, 'item_id'=>$item->id],
                        'method' => 'PATCH'
                    ],
                    'images' => $images,
                    'selected' => $item->stamps->pluck('id')->toArray() ?? []
                ])
            </div>
        </div>
        <div class="tab-pane fade" id="adicional1" role="tabpanel" aria-labelledby="adicional1-tab">
            <div>
                @include('Admin.Dashboard.Themes.records.table.includes.description-form', [
                    'config' => [
                        'id' => 'economy',
                        'title' => 'Actividades economicas asociadas',
                        'route' => 'admin.themes.record.item.update.detail',
                        'params' => ['module'=>$module,'page_id'=>$page_id, 'item_id' => $item->id],
                        'method' => 'PATCH',
                        'type' => 'economy'
                    ],
                    'descriptions' => $economyDetails
                ])
            </div>
        </div>
        <div class="tab-pane fade" id="adicional2" role="tabpanel" aria-labelledby="adicional2-tab">
            <div>
                @include('Admin.Dashboard.Themes.records.table.includes.description-form', [
                    'config' => [
                        'id' => 'danger',
                        'title' => 'Categorías de peligros Asociados',
                        'route' => 'admin.themes.record.item.update.detail',
                        'params' => ['module'=>$module,'page_id'=>$page_id, 'item_id' => $item->id],
                        'method' => 'PATCH',
                        'type' => 'danger'
                    ],
                    'descriptions' => $dangerDetails
                ])
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/admin/modules/Themes/Records/description-form.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tabButtons = document.querySelectorAll('#editTab .tab');
            tabButtons.forEach(function(btn) {
                btn.addEventListener('show.bs.tab', function (e) {
                    tabButtons.forEach(function(b) {
                        b.classList.add('tab-inactive');
                        b.classList.remove('active', 'bg');
                    });
                    e.target.classList.remove('tab-inactive');
                    e.target.classList.add('active', 'bg');
                });
            });
        });
    </script>
@endpush
