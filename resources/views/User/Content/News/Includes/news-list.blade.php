<div class="row">
    @foreach($articles as $article)
        <a class="col-12 mb-3" href="{{ route('articles.show', ['id' => $article->id]) }}" style="text-decoration: none;">
            <div class="card h-100 d-flex flex-row align-items-stretch article-card p-4">

                <div>
                    <img src="{{ renderBase64Image($article->image) }}" 
                         class="img-left" 
                         alt="{{ $article->name }}">
                </div>

                <div class="card-body d-flex flex-column" style="height: 100%;">
                    <h5 class="card-title fw-bold mb-2 flex-grow-0" style="flex-basis:20%; overflow:hidden;">
                        {{ $article->name }}
                    </h5>
                    <p class="card-text text-muted mb-2 flex-grow-1" style="flex-basis:80%; overflow:hidden;">
                        {{ \Illuminate\Support\Str::limit(strip_tags($article->description), 450, '...') }}
                    </p>
                </div>
            </div>
        </a>
    @endforeach
</div>

<div class="d-flex justify-content-center">
    {{ $articles->links('pagination::bootstrap-5') }}
</div>
