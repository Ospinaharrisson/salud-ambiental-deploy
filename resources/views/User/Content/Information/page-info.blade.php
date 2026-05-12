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
                <div class="col d-flex justify-content-center">
                    <a href="#"
                        class="establishment-button dynamic-link" 
                        data-link="{{ $establishment->link }}"
                        data-model="EstablishmentButton"
                        data-id="{{ $establishment->id }}"
                        target="_blank" 
                        rel="noopener noreferrer">
                        <img 
                            class="establishment-image zoom-hover" 
                            src="{{ renderBase64Image($establishment->image) }}" 
                            alt="{{ $establishment->name }}" 
                            loading="lazy"
                        >
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif

@if(isset($featuredImage))
    @php
        $position = $index + 1;
        $hasLink =
            !empty($image->link) ||
            (
                !empty($image->mime_type) &&
                !empty($image->content_base64)
            );
    @endphp

    <div class="container-fluid featured-image">
        @if ($hasLink)
            <a href="#" 
                class="dynamic-link"
                data-link="{{ $featuredImage->link }}"
                data-model="FeaturedImage"
                data-id="{{ $featuredImage->id }}"
                target="_blank" 
                rel="noopener noreferrer"
            >
        @endif
        
        <img class="h-100 w-100" src="{{ renderBase64Image($featuredImage->image) }}" alt="{{ $featuredImage->name }}">

        @if ($hasLink)
            </a>
        @endif
    </div>
@endif

