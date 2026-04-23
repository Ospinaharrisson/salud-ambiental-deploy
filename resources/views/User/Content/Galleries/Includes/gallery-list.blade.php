<div class="row">
    @foreach($galleries as $gallery)
        <a class="col-12 mb-3" href="{{ route('galleries.show', ['id' => $gallery->id]) }}" style="text-decoration: none;">
            <div class="card h-100 d-flex flex-row align-items-stretch gallery-card p-4">

                <div>
                    <img src="{{ renderBase64Image($gallery->firstImage?->image) }}" 
                         class="img-left" 
                         alt="{{ $gallery->name }}">
                </div>

                <div class="card-body d-flex flex-column" style="height: 100%;">
                    <h5 class="card-title fw-bold mb-2 flex-grow-0" style="flex-basis:20%; overflow:hidden;">
                        {{ $gallery->name }}
                    </h5>
                    <p class="card-text text-muted mb-2 flex-grow-1" style="flex-basis:80%; overflow:hidden;">
                        {{ $gallery->description 
                            ? \Illuminate\Support\Str::limit(strip_tags($gallery->description), 450, '...') 
                            : 'Da clic aquí para conocer más de este evento.' }}
                    </p>
                </div>
            </div>
        </a>
    @endforeach
</div>

<div class="d-flex justify-content-center">
    {{ $galleries->links('pagination::bootstrap-5') }}
</div>
