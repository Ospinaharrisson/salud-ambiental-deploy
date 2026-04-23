@if($buttons != null && $buttons->count())
    <div class="theme-separator"></div>
    <div class="d-flex flex-column align-items-center mb-2 mt-4">
        <div class="dynamic-buttons">
            @foreach($buttons as $button)
                <div class="button-wrapper">
                    <span>
                        {{ $button->name }}
                    </span>
                    <a href="{{ $button->link }}" class="dynamic-button">
                        @if($button->image)
                            <img src="{{ renderBase64Image($button->image) }}" alt="{{ $button->name }}">
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif
