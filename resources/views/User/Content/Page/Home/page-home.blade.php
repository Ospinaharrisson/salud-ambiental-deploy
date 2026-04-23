@extends('User.Components.Layout.layout')
@section('title', $page->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Page/page-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Page/page-header.css') }}">
@endpush

@section('content')
    <div style="--theme: #0072bb">
        @include('User.Content.Page.Shared.Header.page-header', [
            'image' => $page->image,
            'imageIsBase64' => true,
            'breadcrumbItems' => [
                ['label' => $page->name, 'active' => true]
            ]
        ])

        @if($page->description)
            <div class="ql-editor">
                {!! $page->description !!}
            </div>
        @endif
    </div>
@endsection
