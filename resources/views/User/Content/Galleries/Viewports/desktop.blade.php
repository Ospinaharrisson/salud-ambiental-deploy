<div class="gallery-blocks">
    @foreach($galleries as $index => $gallery)
        <div class="gallery-block {{ $index === 0 ? 'active' : '' }} rounded-2 overflow-hidden" data-gallery-id="{{ $gallery->id }}" 
            style="background-image: url('{{ renderBase64Image($gallery->firstImage?->image) }}');">
            <div class="gallery-shadow"></div>
            <div class="gallery-label">
                <div class="gallery-icon">
                    <i class="bi bi-images"></i>
                </div>
                <div class="gallery-info">
                    <div class="gallery-name">{{ $gallery->name }}</div>
                    <div class="gallery-description"> {{ Str::limit($gallery->description, 20) }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>