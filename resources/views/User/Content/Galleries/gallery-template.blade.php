@extends('User.Components.Layout.layout')

@section('title', 'Galerías')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user/Shared/content-template.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('galleries.index') }}" class="btn app-btn-secondary my-3">
            Volver
        </a>
    </div>
    <div class="content-template-container">
        <h3 class="content-template-title">
            {{ $gallery->name }}
        </h3>
        @if($gallery->date)
            <small class="content-template-date">
                Fecha del evento: {{ $gallery->date }}
            </small>
        @endif
        @if($gallery->description)
            <div class="ql-editor content-template-body">
                {!! $gallery->description !!}
            </div>
        @endif
        <div class="d-flex justify-content-center">
            <div
                id="gallery-carousel-{{ $gallery->id }}"
                class="carousel slide content-gallery-carousel"
                data-bs-ride="carousel"
            >
                <div class="carousel-inner">
                    @foreach($gallery->images as $index => $image)
                        <div class="carousel-item @if($index === 0) active @endif">
                            <img
                                src="{{ renderBase64Image($image->image) }}"
                                class="content-gallery-image"
                                alt="Imagen {{ $index + 1 }}"
                            >
                        </div>
                    @endforeach
                </div>
                @if($gallery->images->count() > 1)
                    <button
                        class="carousel-control-prev"
                        type="button"
                        data-bs-target="#gallery-carousel-{{ $gallery->id }}"
                        data-bs-slide="prev"
                    >
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
    
                    <button
                        class="carousel-control-next"
                        type="button"
                        data-bs-target="#gallery-carousel-{{ $gallery->id }}"
                        data-bs-slide="next"
                    >
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                @endif
            </div>
        </div>
    </div>
@endsection