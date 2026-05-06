<div class="media-buttons-container col-lg-3 col-md-6 col-12 d-flex flex-column h-100" style="gap: 10px; overflow: hidden">
    <div class="d-flex flex-column justify-content-center flex-grow-0" style="flex-basis: 30%; gap: 8px;">
        <div class="media-content-container media-btn-question">
            <a class="media-content-button" href="{{ route('page.questions.show') }}">
                <img class="media-question-icon" src="{{ asset('assets/images/user/Icons/content-media/question-icon.png') }}" alt="icon">
                <span class="media-content-text">Preguntas frecuentes</span>
            </a>    
        </div>

        @if(isset($page))
            <div class="media-content-container media-btn-info">
                <a href="{{ route('page.home.show', ['id' => $page->id]) }}" class="media-content-button">
                    <div class="media-info-icon-container">
                        <img class="media-info-icon" src="{{ asset('assets/images/user/Icons/content-media/info-icon.png') }}" alt="icon">
                    </div>
                    <span class="media-content-text">{{ $page->name }}</span>
                </a>
            </div>
        @endif
    </div>
    @if($points->isNotEmpty())
        <div class="card overflow-hidden flex-grow-0" style="flex-basis: 70%;">
            <div class="card-header text-center" style="background-color: var(--primary-color);">
                <h2 class="media-card-title">
                    Ubica los puntos de recolección
                </h2>
            </div>
            <div class="card-body d-flex flex-column justify-content-between" style="padding: 0; background-color: var(--body-bg-contrast)">
                <div class="card-body" style="overflow: hidden;">
                    <div class="points-grid">
                        @foreach($points->values() as $index => $point)
                            @php
                                $position = $index + 1;
                        
                                $href = $point->link ?? null;
                                if (!$href && !empty($point->mime_type) && !empty($point->content_base64)) {
                                    $href = generateBlankLink($point->content_base64, $point->mime_type);
                                }
                            @endphp
                        
                            <div class="point-box point-{{ $position }}">
                                @if($href)
                                    <a href="{{ $href }}" target="_blank">
                                @endif
                                
                                <img src="{{ renderBase64Image($point->image) }}" alt="{{ $point->name }}">
                        
                                @if($href)
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>