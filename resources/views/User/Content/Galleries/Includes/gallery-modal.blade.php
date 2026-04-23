<div class="modal fade" id="gallery-modal-{{ $gallery->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            
            <div class="modal-header d-flex justify-content-around align-items-center">
                <h5 class="calendar-event-title" id="galleryTitle">{{ $gallery->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                
                @if($gallery->date)
                    <small class="text-muted gallery-date d-block mb-2">Fecha del evento: {{ $gallery->date }}</small>
                @endif

                @if($gallery->description)
                    <div class="ql-editor gallery-modal-content mb-3">{!! $gallery->description !!}</div>
                @endif

                <div id="gallery-carousel-{{ $gallery->id }}" class="carousel slide mx-auto h-100" data-bs-ride="carousel" style="border-radius: 15px !important">
                    <div class="carousel-inner">
                        @foreach($gallery->images as $index => $image)
                            <div class="carousel-item @if($index === 0) active @endif">
                                <img src="{{ renderBase64Image($image->image) }}" 
                                    class="d-block w-100"
                                    style="border-radius: 15px !important"
                                    alt="Imagen {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                    @if($gallery->images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#gallery-carousel-{{ $gallery->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#gallery-carousel-{{ $gallery->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>