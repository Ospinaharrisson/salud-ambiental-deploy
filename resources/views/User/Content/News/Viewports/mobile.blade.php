<div class="container d-flex justify-content-center">
    @if(isset($articles) && $articles->count())
        <div class="mobile-content-list">
            @foreach($articles as $article)
                <button
                    type="button"
                    class="btn mobile-content-card text-start"
                    data-news-trigger
                    data-news-title="{{ $article->name }}"
                    data-news-image="{{ renderBase64Image($article->image) }}"
                    data-news-description='@json($article->description)'
                    data-news-link="{{ $article->link ?? '' }}"
                    data-news-model="Article"
                    data-news-id="{{ $article->id }}"
                    >
                    <img
                        src="{{ renderBase64Image($article->image) }}"
                        alt="{{ $article->name }}"
                        class="mobile-content-image"
                    >
                    <div class="mobile-content-overlay"></div>
                    <div class="mobile-content-title-wrapper">
                        <span class="mobile-content-title">
                            {{ Str::limit($article->name, 55, '...') }}
                        </span>
                    </div>
                </button>
            @endforeach
        </div>
    @endif
</div>