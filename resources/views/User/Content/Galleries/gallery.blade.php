@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Gallery/gallery.css') }}">
@endpush

@if(isset($galleries) && $galleries->count())
    <div class="card my-4">
        <div class="card-header" style="background-color: var(--primary-color);">
            <h2 class="gallery-title">Galería</h2>
        </div>

        <div class="card-body d-flex justify-content-center">
            <div class="gallery-blocks">
                @foreach($galleries as $index => $gallery)
                    <div class="gallery-block {{ $index === 0 ? 'active' : '' }} rounded-2 overflow-hidden" data-gallery-id="{{ $gallery->id }}" 
                        style="background-image: url('{{ renderBase64Image($gallery->firstImage?->image) }}'); background-size: cover;  background-position: center center; background-repeat: no-repeat;">
                        <div class="gallery-shadow"></div>
                        <div class="gallery-label">
                            <div class="gallery-icon">
                                <i class="bi bi-images"></i>
                            </div>
                            <div class="gallery-info">
                                <div class="gallery-name">{{ $gallery->name }}</div>
                                <div class="gallery-description"> {{ Str::limit($gallery->description, 20) }}</div>
                            </div>
                        </div>
                    </div>
                    @include('User.Content.Galleries.Includes.gallery-modal', ['gallery' => $gallery])
                @endforeach
            </div>
        </div>

        <div class="card-footer d-flex justify-content-start mt-2 p-3">
            <a href="{{ route('galleries.index') }}" class="btn btn-outline-primary">Ver todas las galerías</a>
        </div>
    </div>
@endif

@push('scripts')
    <script src="{{asset('assets/js/user/Content/Gallery/gallery-hover.js')}}"></script>
    <script src="{{asset('assets/js/user/Content/Gallery/modal-gallery.js')}}"></script>
@endpush