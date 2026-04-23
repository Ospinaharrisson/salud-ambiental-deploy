
@if ($lines->isNotEmpty())
    <div class="lines-container row">
        @foreach($lines as $line)
            @php
                $href = $line->link ?? null;
                if (!$href && !empty($line->mime_type) && !empty($line->content_base64)) {
                    $href = generateBlankLink($line->content_base64, $line->mime_type);
                }
            @endphp
            @if ($href)
                <div class="col-6 col-sm-4 col-md-2 d-flex justify-content-center align-items-center">
                    <a class="line-button" href="{{ $href }}" target="_blank" rel="noopener noreferrer">
                        <img class="line-image zoom-hover" 
                            src="{{ renderBase64Image($line->image) }}" 
                            alt="{{ $line->name }}" 
                            loading="lazy">
                    </a>
                </div>
            @endif
        @endforeach
    </div>
@endif
