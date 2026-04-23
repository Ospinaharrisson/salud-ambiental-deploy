@extends('User.Components.Layout.layout')
@section('title', $page->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Page/page-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Page/page-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Page/page-item.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Page/page-header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/Table/table-asset.css') }}">
@endpush

@section('content')
    <div style="--theme: {{ $theme }}">
        @include('User.Content.Page.Shared.Header.page-header', [
            'image' => $banner->image ?? null,
            'imageIsBase64' => true,
            'breadcrumbItems' => [
                ['label' => $page->module->name ?? 'Sección'],
                ['label' => $page->name, 'active' => true]
            ]
        ])

        <div>
            @if($page->image)
                <div class="card shadow-sm rounded mt-5">
                    <img src="{{ renderBase64Image($page->image) }}"
                        alt="{{ $page->name }}"
                        class="img-fluid w-100 page-banner">
                </div>
            @endif

            <div class="ql-editor my-2 py-4">
                {!! $page->description !!}
            </div>

            @livewire('shared.table.chemical-table', ['pageRecordId' => $page->id, 'theme' => $theme, 'showAllElements' => false])
            @include('User.Content.Page.Module.Shared.Buttons.page-buttons')
        </div>
    </div>
@endsection