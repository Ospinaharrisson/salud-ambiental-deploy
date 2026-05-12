<div class="container d-flex justify-content-center">
    @if(isset($galleries) && $galleries->count())
        <div class="mobile-content-list">

            @foreach($galleries as $gallery)
                <button
                    type="button"
                    class="btn mobile-content-card text-start"
                    data-gallery-id="{{ $gallery->id }}" >

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