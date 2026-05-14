@if ($networks->isNotEmpty())
    <div class="network-container row">
        @foreach($networks as $network)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center align-items-center">
                <a href="#"
                    class="dynamic-link"
                    data-link="{{ $network->link }}"
                    data-model="HealthNetwork"
                    data-id="{{ $network->id }}"
                    target="_blank" 
                    rel="noopener noreferrer"
                >
                    <img class="zoom-hover network-image" src="{{ renderBase64Image($network->image) }}" alt="{{ $network->name }}" loading="lazy">
                </a>
            </div>
        @endforeach
    </div>
@endif