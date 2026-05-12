@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/user/Shared/content-list.css') }}">
    @endpush
@endonce

<div>
    <div class="row">
        @foreach($articles as $article)
            <a
                class="col-12 mb-3 content-list-link"
                href="{{ route('articles.show', ['id' => $article->id]) }}"
            >
                <div class="card content-list-card interactive-card">
                    <div class="content-list-image-wrapper">
                        <img
                            src="{{ renderBase64Image($article->image) }}"
                            class="content-list-image"
                            alt="{{ $article->name }}"
                        >
                    </div>
                    <div class="card-body content-list-body">
                        <h5 class="content-list-title">
                            {{ $article->name }}
                        </h5>
                        <p class="content-list-description">
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
</div>