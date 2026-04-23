@if(count($networks) > 0)
    <div class="network-container row">
        @foreach($networks as $network)
            @php
                $href = $network->link ?? null;
                if (!$href && !empty($network->mime_type) && !empty($network->content_base64)) {
                    $href = generateBlankLink($network->content_base64, $network->mime_type);
                }
            @endphp
            
            @if ($href)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center align-items-center">
                    <a href="{{ $href }}" target="_blank" rel="noopener noreferrer">
                        <img class="zoom-hover network-image" src="{{ renderBase64Image($network->image) }}" alt="{{ $network->name }}" loading="lazy">
                    </a>
                </div>
            @endif
        @endforeach
    </div>
@endif
