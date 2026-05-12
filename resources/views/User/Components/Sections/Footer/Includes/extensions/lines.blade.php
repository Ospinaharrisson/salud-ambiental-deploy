@if ($lines->isNotEmpty())
    <div class="lines-container row">
        @foreach($lines as $line)
            <div class="col-6 col-sm-4 col-md-2 d-flex justify-content-center align-items-center">
                <a href="#" 
                    class="line-button dynamic-link"
                    data-link="{{ $line->link }}"
                    data-model="LineOfInterest"
                    data-id="{{ $line->id }}"
                    target="_blank" 
                    rel="noopener noreferrer"
                >
                    <img class="line-image zoom-hover" 
                        src="{{ renderBase64Image($line->image) }}" 
                        alt="{{ $line->name }}" 
                        loading="lazy">
                </a>
            </div>
        @endforeach
    </div>
@endif
