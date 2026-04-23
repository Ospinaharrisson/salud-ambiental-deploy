@extends('User.Components.Layout.layout')
@section('title','Noticias')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/News/news-section.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary my-3">Volver</a>
    </div>

    <div class="bg-white p-4 shadow-sm rounded">
        <h3 class="article-title">{{ $article->name }}</h3>
        <img src="{{ renderBase64Image($article->image) }}" alt="{{ $article->name }}" class="article-img">
        
        <div class="ql-editor article-body">
            {!! $article->description !!}
        </div>

        @php
            $href = $article->link ?? null;
            if (!$href && !empty($article->mime_type) && !empty($article->content_base64)) {
                $href = generateBlankLink($article->content_base64, $article->mime_type);
            }
        @endphp

        @if($href)
            <a href="{{ $href }}" target="_blank" class="btn btn-outline-primary">Conoce más aquí</a>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="{{asset('assets/js/user/Content/News/float-news.js')}}"></script>
@endpush
