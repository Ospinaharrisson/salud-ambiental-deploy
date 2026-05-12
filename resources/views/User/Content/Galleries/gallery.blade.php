@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Gallery/gallery.css') }}">
@endpush

@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Mobile/mobile-content.css') }}">
    @endpush

    @push('modals')
        @include('User.Content.Galleries.Includes.gallery-modal')
    @endpush
@endonce

@if(isset($galleries) && $galleries->count())
    <div class="content-card card my-4">
        <div class="content-section-header card-header">
            <h3 class="content-section-title">Galería</h3>
        </div>

        <div class="card-body">
            <div class="content-desktop-view">
                @include('User.Content.Galleries.Viewports.desktop')
            </div>

            <div class="content-mobile-view">
                @include('User.Content.Galleries.Viewports.mobile')
            </div>
        </div>

        <div class="card-footer d-flex justify-content-start p-3">
            <a href="{{ route('galleries.index') }}" class="btn content-button">Ver todas las galerías</a>
        </div>
    </div>
@endif

@push('scripts')
    <script src="{{asset('assets/js/user/Content/Gallery/gallery-hover.js')}}"></script>
    <script src="{{asset('assets/js/user/Content/Gallery/modal-gallery.js')}}"></script>
@endpush