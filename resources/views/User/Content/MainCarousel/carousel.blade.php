@push('styles')
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/user/Content/MainCarousel/carousel.css') }}" />
@endpush

@if ($banners->isNotEmpty())
    <div id="mainBannerCarousel" class="carousel slide my-4" data-bs-ride="carousel">
        
        <div class="carousel-indicators">
            @foreach($banners as $index => $image)
                <button type="button"
                    data-bs-target="#mainBannerCarousel"
                    data-bs-slide-to="{{ $index }}"
                    class="{{ $index === 0 ? 'active' : '' }}"
                    aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                    aria-label="Slide {{ $index + 1 }}">
                </button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach($banners as $index => $image)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    @php
                        $hasLink =
                            !empty($image->link) ||
                            (
                                !empty($image->mime_type) &&
                                !empty($image->content_base64)
                            );
                    @endphp
                    @if ($hasLink)
                        <a href="#" 
                            class="dynamic-link"
                            data-link="{{ $image->link }}"
                            data-model="Banner"
                            data-id="{{ $image->id }}"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                    @endif
                    
                    <img 
                        src="{{ renderBase64Image($image->image) }}"
                        class="d-block w-100"
                        alt="{{ $image->name }}" 
                    />

                    @if ($hasLink)
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
        
        @if($banners->count() > 1)
            <div class="carousel-controls">
                <button class="carousel-control-prev" type="button" data-bs-target="#mainBannerCarousel" data-bs-slide="prev" aria-label="Anterior">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="carousel-arrow">
                        <path d="M15.41 7.41 14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                    </svg>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mainBannerCarousel" data-bs-slide="next" aria-label="Siguiente">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="carousel-arrow">
                        <path d="M8.59 16.59 13.17 12 8.59 7.41 10 6l6 6-6 6z"/>
                    </svg>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        @endif
    </div>
@endif