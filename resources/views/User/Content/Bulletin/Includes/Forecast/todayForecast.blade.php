@push('styles')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/Content/Bulletin/todayForecast.css')}}" />
@endpush

<div id="todayForecast" class="bg-forecast">

    <div class="forecast-main">
        <div class="forecast-container">
            <div class="forecast-info">
                <img id="daytime-icon" alt="icono del dia">
                <p id="daytime-message"></p>
                <h1 class="BogotaToday">Bogotá hoy</h1>
                <p id="daytime-hour"></p>
                <p id="daytime-calendar"></p>
                <p id="weather-description">Clima</p>
                <img id="weather-icon" alt="icono clima">
                <p id="temp-now">Temp. now</p>
                <div class="temp-indicators">
                    <span id="temp-min">Temp. min</span>
                    <span id="temp-max">Temp. max</span>
                </div>
            </div>

            <div class="weather-container">
                <div class="weather-info d-flex align-items-center">
                    <i class="bi bi-thermometer-half"></i>
                    <div class="container d-flex flex-column justify-content-center">
                        <span class="mb-0">sensación</span>
                        <span id="weather-feelslike">grados</span>
                    </div>
                </div>
                <div class="weather-info d-flex align-items-center">
                    <i class="bi bi-droplet-fill"></i>
                    <div class="container d-flex flex-column justify-content-center">
                        <span class="mb-0">Humedad</span>
                        <span id="weather-humidity">any%</span>
                    </div>
                </div>
                <div class="weather-info d-flex align-items-center">
                    <i class="bi bi-wind"></i>
                    <div class="container d-flex flex-column justify-content-center">
                        <span class="mb-0">Viento</span>
                        <span id="weather-wind">- m/s</span>
                    </div>
                </div>
                <div class="weather-info d-flex align-items-center">
                    <i class="bi bi-speedometer2"></i>
                    <div class="container d-flex flex-column justify-content-center">
                        <span class="mb-0">Presión</span>
                        <span id="weather-pressure">- hPa</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="weather-buttons-container">
            @foreach($weatherInsights as $insight)
                @php
                    $href = $insight->link ?? null;
                    if (!$href && !empty($insight->mime_type) && !empty($insight->content_base64)) {
                        $href = generateBlankLink($insight->content_base64, $insight->mime_type);
                    }
                @endphp
                                    
                @if ($href)
                    <a class="weather-button my-2" href="{{ $href }}" target="_blank">
                        <img class="zoom-hover" src="{{ renderBase64Image($insight->image) }}">
                    </a>
                @endif
            @endforeach
        </div>
    </div>

    <footer class="forecast-footer">
        <span>Datos del clima:</span>
        <a href="https://openweathermap.org/" target="_blank" rel="noopener noreferrer">
            <img class="forecast-credit-logo" src="{{ asset('assets/images/user/Content/Bulletin/OpenWeather-logo.png') }}" alt="OpenWeatherMap">
        </a>
    </footer>
</div>

@push('scripts')
    <script src="{{asset('assets/js/user/Content/Bulletin/todayForecast.js')}}"></script>
@endpush