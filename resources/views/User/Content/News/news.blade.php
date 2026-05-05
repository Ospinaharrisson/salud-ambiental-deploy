
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/News/news.css') }}">
@endpush

@if(isset($articles) && $articles->count())
    <div class="content-card card">
        <div class="card-header">
            <h2 class="news-title">Noticias</h2>
        </div>

        <div class="card-body">
            <div class="blocks">
                @foreach($articles as $index => $article)
                    <div class="block" role="button" tabindex="0" data-id="{{ $article->id }}" data-type="article">
                        <div class="text-sm-left text-justify news-label">
                            {{ Str::limit($article->name, 40, '...') }}
                        </div>
                        <img src="{{ renderBase64Image($article->image) }}"
                             class="d-block w-100"
                             alt="{{ $article->name }}"
                             height="100%" />
                    </div>
                    @include('User.Content.News.Includes.news-modal', ['article' => $article])
                @endforeach
            </div>
        </div>

        <div class="card-footer d-flex justify-content-start p-3">
            <a href="{{ route('articles.index') }}" class="btn content-button">Ver más información</a>
        </div>
    </div>
@endif

@push('scripts')
    <script src="{{asset('assets/js/user/Content/News/modal-news.js')}}"></script>
@endpush
