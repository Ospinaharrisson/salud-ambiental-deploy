<div class="news-blocks">
    @foreach($articles as $index => $article)
        <div class="block" role="button" tabindex="0" 
            data-news-trigger
            data-news-title="{{ $article->name }}"
            data-news-image="{{ renderBase64Image($article->image) }}"
            data-news-description='@json($article->description)'
            data-news-link="{{ $article->link ?? '' }}"
        >
            <div class="text-sm-left text-justify news-label">
                {{ Str::limit($article->name, 40, '...') }}
            </div>
            <img src="{{ renderBase64Image($article->image) }}"
                class="news-blocks-image"
                alt="{{ $article->name }}"
                height="100%" />
        </div>
    @endforeach
</div>