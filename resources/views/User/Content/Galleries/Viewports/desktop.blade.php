<div class="gallery-blocks">
    @foreach($galleries as $index => $gallery)
        <div 
            class="gallery-block {{ $index === 0 ? 'active' : '' }} rounded-2 overflow-hidden" 
            style="background-image: url('{{ renderBase64Image($gallery->firstImage?->image) }}');"
            data-gallery-trigger
            data-gallery-title="{{ $gallery->name }}"
            data-gallery-date="{{ $gallery->date ?? '' }}"
            data-gallery-description='@json($gallery->description)'
            data-gallery-images='@json(
                $gallery->images->map(fn($image) => renderBase64Image($image->image))
            )'
        >
            <div class="gallery-shadow"></div>
            <div class="gallery-label">
                <div class="gallery-icon">
                    <i class="bi bi-images"></i>
                </div>
                <div class="gallery-info">
                    <div class="gallery-name">{{ $gallery->name }}</div>
                    <div class="gallery-description">{{ Str::limit(strip_tags($gallery->description), 20) }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>