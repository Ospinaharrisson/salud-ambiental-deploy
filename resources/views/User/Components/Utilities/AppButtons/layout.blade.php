<nav class="app-buttons-container">
    @foreach($appButtons as $button)
        <div class="app-button" style="--button-color: {{ $button->theme }}">
            <a href="#"
               class="app-button-icon dynamic-link"
               data-link="{{ $button->link }}"
               data-model="AppButton"
               data-id="{{ $button->id }}"
               target="_blank"
               rel="noopener noreferrer"
            >
                <img
                    src="{{ renderBase64Image($button->image) }}"
                    alt="{{ $button->name }}"
                >
            </a>

            <div class="app-button-tooltip">
                <a href="#"
                   class="app-button-label dynamic-link"
                   data-link="{{ $button->link }}"
                   data-model="AppButton"
                   data-id="{{ $button->id }}"
                   target="_blank"
                >
                    {{ \Illuminate\Support\Str::limit($button->name, 10, '') }}
                </a>
            </div>
        </div>
    @endforeach
</nav>