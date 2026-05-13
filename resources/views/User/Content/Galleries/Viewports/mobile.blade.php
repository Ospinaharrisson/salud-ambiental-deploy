<div class="container d-flex justify-content-center">
    @if(isset($galleries) && $galleries->count())
        <div class="mobile-content-list">

            @foreach($galleries as $gallery)
                <button
                    type="button"
                    class="btn mobile-content-card text-start"
                    data-gallery-trigger
                    data-gallery-title="{{ $gallery->name }}"
                    data-gallery-date="{{ $gallery->date ?? '' }}"
                    data-gallery-description='@json($gallery->description)'
                    data-gallery-images='@json(
                        $gallery->images->map(fn($image) => renderBase64Image($image->image))
                    )'
                >

                    <img
                        src="{{ renderBase64Image($gallery->firstImage?->image) }}"
                        alt="{{ $gallery->name }}"
                        class="mobile-content-image"
                    >
                    <div class="mobile-content-overlay"></div>
                    <div class="mobile-content-title-wrapper">
                        <span class="mobile-content-title">
                            {{ Str::limit($gallery->name, 55, '...') }}
                        </span>
                    </div>
                </button>
            @endforeach
        </div>
    @endif
</div>