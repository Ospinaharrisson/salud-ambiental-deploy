@extends('User.Components.Layout.layout')

@section('title', 'Noticias')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user/Shared/content-template.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('articles.index') }}" class="btn app-btn-secondary my-3">
            Volver
        </a>
    </div>
    <div class="content-template-container">
        <h3 class="content-template-title">
            {{ $article->name }}
        </h3>
        <div class="ql-editor content-body">
            <img
                src="{{ renderBase64Image($article->image) }}"
                alt="{{ $article->name }}"
                class="content-template-image"
            >
            {!! $article->description !!}
        </div>

        <div class="content-template-footer mt-2">
            <a href="#"
                class="btn app-btn-primary"
                data-link="{{ $article->link }}"
                data-model="Article"
                data-id="{{ $article->id }}"
                target="_blank"
                rel="noopener noreferrer"
            >
                Conoce más aquí
            </a>
        </div>
    </div>
@endsection