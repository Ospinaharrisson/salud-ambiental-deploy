@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/information/page-info.css') }}">
@endpush

@if($establishments->isNotEmpty())
    <div class="content-section establishment-content">
        <h2>Establecimientos</h2>

        <div class="establishments-container row row-cols-5">
            @if($hasAccredited)
                <div class="col d-flex justify-content-center">
                    <a class="establishment-button" 
                       href="{{ route('page.accredited.show') }}" 
                       >
                        <img class="establishment-image zoom-hover" 
                             src="{{ asset('assets/images/user/Content/Establishment/accredited-button.png') }}" 
                             alt="Establecimientos Acreditados" 
                             loading="lazy">
                    </a>
                </div>
            @endif

            @if($hasFavorable)
                <div class="col d-flex justify-content-center">
                    <a class="establishment-button" 
                       href="{{ route('page.favorable.show') }}" 
                       >
                        <img class="establishment-image zoom-hover" 
                             src="{{ asset('assets/images/user/Content/Establishment/favorable-button.png') }}" 
                             alt="Establecimientos Favorables" 
                             loading="lazy">
                    </a>
                </div>
            @endif
            @foreach($establishments as $establishment)
                @php
                    $href = $establishment->link ?? null;
                    if (!$href && !empty($establishment->mime_type) && !empty($establishment->content_base64)) {
                        $href = generateBlankLink($establishment->content_base64, $establishment->mime_type);
                    }
                @endphp
                
                @if ($href)
                    <div class="col d-flex justify-content-center">
                        <a class="establishment-button" href="{{ $href }}" target="_blank" rel="noopener noreferrer">
                            <img class="establishment-image zoom-hover" 
                                src="{{ renderBase64Image($establishment->image) }}" 
                                alt="{{ $establishment->name }}" 
                                loading="lazy">
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endif

@if(isset($featuredImage))
    @php
        $href = $featuredImage->link ?? null;
        if (!$href && !empty($featuredImage->mime_type) && !empty($featuredImage->content_base64)) {
            $href = generateBlankLink($featuredImage->content_base64, $featuredImage->mime_type);
        }
    @endphp

    <div class="container-fluid featured-image">
        @if ($href)
            <a href="{{ $href }}" target="_blank" rel="noopener noreferrer">
        @endif
        
        <img class="h-100 w-100" src="{{ renderBase64Image($featuredImage->image) }}" alt="{{ $featuredImage->name }}">

        @if ($href)
            </a>
        @endif
    </div>
@endif

