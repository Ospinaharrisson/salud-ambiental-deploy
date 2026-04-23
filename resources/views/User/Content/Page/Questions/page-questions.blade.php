@extends('User.Components.Layout.layout')
@section('title', 'preguntas frecuentes')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Page/page-header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Page/page-accordion.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Page/page-question.css') }}">
@endpush

@section('content')
    <div style="--theme: #0072bb">
        @include('User.Content.Page.Shared.Header.page-header', [
            'image' => 'assets/images/user/Content/Page/Questions/question-banner.png',
            'imageIsBase64' => false,
            'breadcrumbItems' => [
                ['label' => 'Preguntas frecuentes', 'active' => true]
            ]
        ])
    </div>
    @if($modules->count())
        <div class="my-5">
            @foreach($modules as $module)
                @if($module->questions->count())
                    <div class="module-container" style="--theme: {{ $module->theme }}">
                        <div class="module-accordion-banner">
                            @if(isset($module->banner->image))
                                <img src="{{ renderBase64Image($module->banner->image) }}">
                            @else 
                                <img src="{{ asset('assets/images/user/Content/Page/Questions/question-banner.png') }}">
                            @endif
                        </div>
                        <div class="accordion" id="accordion-modules">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-{{ $module->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $module->id }}" aria-expanded="false"
                                        aria-controls="collapse-{{ $module->id }}"
                                        style="background-color: {{ clarifyColor($module->theme, 0.6) }}">
                                        {{ $module->name }}
                                    </button>
                                </h2>
                                <div id="collapse-{{ $module->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading-{{ $module->id }}" data-bs-parent="#accordion-modules">
                                    <div class="accordion-body">
                                        <ul class="accordion-list">
                                            @foreach($module->questions as $question)
                                                <li class="question-item" id="module-question-{{ $question->id }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#questionModal"
                                                    data-bs-title="{{ $question->name }}"
                                                    data-bs-description="{{ $question->description }}"
                                                    data-bs-theme="{{ $module->theme }}">
                                                        {{ $question->name }}
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
        @include('User.Content.Page.Questions.Includes.question-modal')
    @else
        <div class="box-shadow border rounded p-5 mt-5">
            <em>Sin preguntas frecuentes</em>
        </div>
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/user/Content/Page/page-question.js') }}"></script>
    <script src="{{ asset('assets/js/user/Content/Page/page-question-modal.js') }}"></script>
@endpush
