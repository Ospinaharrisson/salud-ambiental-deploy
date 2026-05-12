
<div>
    <nav class="app-buttons-container">
        @foreach($appButtons as $button)
            <div class="app-button" style="--button-color: {{ $button->theme }}">
                <a href="#" 
                    class="app-icon dynamic-link" 
                    data-link="{{ $button->link }}" 
                    data-model="AppButton"
                    data-id="{{ $button->id }}" 
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <img src="{{ renderBase64Image($button->image) }}"
                        alt="{{ $button->name }}">
                </a>

                <div class="app-button-info">
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
    
    <nav class="accessibility-buttons-container">
        {{-- 
            <div class="accessibility-button">
            <a href="https://saludambiental.saludcapital.gov.co/Podcast"
               class="accessibility-icon"
               target="_blank">
                <i class="bi bi-book" style="transform: rotate(180deg); margin-right: 5px"></i>
            </a>
                    
            <div class="accessibility-button-info">
                <a href="https://saludambiental.saludcapital.gov.co/Podcast"
                    target="_blank"
                    class="accessibility-button-label">
                    Encuesta
                </a>
            </div>
        </div>
        --}}
        <div id="accessibility-buttons">
            <button id="increase-font">A+</button>
            <button id="decrease-font">A-</button>
            <button id="toggle-contrast">                
                <i class="bi bi-circle-half"></i>
            </button>
        </div>
    </nav>
</div>
