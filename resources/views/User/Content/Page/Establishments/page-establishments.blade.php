@extends('User.Components.Layout.layout')
@section('title', $config['title'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Page/page-header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Page/page-accordion.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Page/page-item.css') }}">
@endpush

@section('content')
    <div style="--theme: {{ $config['theme'] }}">
        @include('User.Content.Page.Shared.Header.page-header', [
            'image' => $config['banner'],
            'imageIsBase64' => false,
            'breadcrumbItems' => [
                ['label' => $config['title'], 'active' => true]
            ]
        ])
    </div>

    @if($modules->isNotEmpty())
        <div class="my-5">
            @foreach($modules as $module)
                @php
                    $relationName = $config['category'] . 'Establishments';
                    $establishments = $module->$relationName;
                @endphp

                @if($establishments->isNotEmpty())
                    <div class="module-container" style="--theme: {{ $module->theme }}">
                        <div class="module-accordion-banner">
                            @if(isset($module->banner->image))
                                <img src="{{ renderBase64Image($module->banner->image) }}">
                            @else
                                <img src="{{ asset($config['banner']) }}">
                            @endif
                        </div>

                        <div class="accordion" id="accordion-modules">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-{{ $module->id }}">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $module->id }}"
                                        aria-expanded="false"
                                        aria-controls="collapse-{{ $module->id }}"
                                        style="background-color: {{ clarifyColor($module->theme, 0.6) }}">
                                        {{ $module->name }}
                                    </button>
                                </h2>

                                <div 
                                    class="accordion-collapse collapse"
                                    id="collapse-{{ $module->id }}"
                                    aria-labelledby="heading-{{ $module->id }}"
                                    data-bs-parent="#accordion-modules"
                                >

                                    <div class="accordion-body">
                                        <ul class="accordion-list">
                                            @foreach($establishments as $establishment)
                                                <li>
                                                    @if($establishment->description)
                                                        <blockquote>
                                                            <div class="ql-editor">
                                                                {!! $establishment->description !!}
                                                            </div>
                                                    @endif
                                                    <li class="asset-item"
                                                        style="background-color: {{ clarifyColor($module->theme, 0.1) }};">
                                                        <div class="d-flex align-items-center" style="flex: 0 0 90%">
                                                            <img src="{{ assetIcon($establishment->type) }}" alt="icon">
                                                            <p>{{ $establishment->name }}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-end" style="flex: 0 0 10%">
                                                            <a href="#" 
                                                                class="btn btn-sm dynamic-link"
                                                                data-link="{{ $establishment->link }}"
                                                                data-model="EstablishmentAsset"
                                                                data-id="{{ $establishment->id }}"
                                                                style="background-color: {{ $module->theme }}"
                                                                target="_blank"
                                                                rel="noopener noreferrer"
                                                            >
                                                               Ver
                                                            </a>
                                                        </div>
                                                    </li>
                                                    @if($establishment->description)
                                                        </blockquote>
                                                    @endif                                                
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="box-shadow border rounded p-5 mt-5">
            <em>{{ $config['emptyText'] }}</em>
        </div>
    @endif
@endsection
