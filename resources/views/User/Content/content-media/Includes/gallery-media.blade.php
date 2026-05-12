@if ($media->isNotEmpty())
    <div class="col-lg-3 col-md-6 col-12 h-100">
        <div class="media-carousel-container">
            <div id="mediaCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($media as $index => $image)
                        @php
                            $hasLink =
                                !empty($image->link) ||
                                (
                                    !empty($image->mime_type) &&
                                    !empty($image->content_base64)
                                );
                        @endphp

                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
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
                            <img src="{{ renderBase64Image($image->image) }}"
                                class="d-block w-100"
                                style="object-position: center"
                                title="{{ $image->name }}"
                                alt="{{ $image->name }}"
                            >
                            @if ($hasLink)
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>

                @if($media->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#mediaCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#mediaCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                @endif
            </div>
        </div>
    </div>
@endif
