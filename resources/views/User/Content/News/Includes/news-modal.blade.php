<div class="modal fade" id="article-modal-{{ $article->id }}" tabindex="-1" aria-labelledby="modalLabel{{$article->id}}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header d-flex justify-content-between align-items-center w-100">
                <h5 class="modal-news-title mb-0" id="modalLabel{{$article->id}}">
                    {{ $article->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <div class="row align-items-start">
                    <div class="col-md-4 col-sm-12 p-2">
                        <img src="{{ renderBase64Image($article->image) }}"
                             class="img-fluid modal-img-side-flex"
                             alt="{{ $article->name }}">
                    </div>
                    <div class="col-md-8 col-sm-12 ql-editor news-modal-content p-2">
                        <div class="mb-3">{!! $article->description !!}</div>
                    </div>
                </div>
            </div>            

            <div class="modal-footer justify-content-start">
                @php
                    $href = $article->link ?? null;
                    if (!$href && !empty($article->mime_type) && !empty($article->content_base64)) {
                        $href = generateBlankLink($article->content_base64, $article->mime_type);
                    }
                @endphp

                @if($href)
                    <a href="{{ $href }}" target="_blank" class="btn btn-outline-primary">Ver más información</a>
                @endif

                <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
