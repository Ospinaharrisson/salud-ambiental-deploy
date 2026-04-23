@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - Registros')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/shared/Table/table-asset.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center box-rounded bg p-3 mt-3">
        <div>
            <h1 class="text-title">{{ $page->name }}</h1>
        </div>
        <a href="{{ route('admin.themes.record.item.create', ['module' => $module, 'page_id' => $page->id]) }}" class="btn btn-outline-success">
            añadir elemento
        </a>
    </div>
    @livewire('shared.table.chemical-table', ['module' => $module, 'pageRecordId' => $page->id, 'theme' => $module->theme, 'actionsEnabled' => true])
@endsection
