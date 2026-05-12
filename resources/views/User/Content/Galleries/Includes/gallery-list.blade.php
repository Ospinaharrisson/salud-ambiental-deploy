@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/user/Shared/content-list.css') }}">
    @endpush
@endonce

<div>
    <div class="row">
        @foreach($galleries as $gallery)
         <a
                class="col-12 mb-3 content-list-link"
                href="{{ route('galleries.show', ['id' => $gallery->id]) }}"
            >
                <div class="card content-list-card interactive-card">
                    <div class="content-list-image-wrapper">
                        <img
                            src="{{ renderBase64Image($gallery->firstImage?->image) }}"
                            class="content-list-image"
                            alt="{{ $gallery->name }}"
                        >
                    </div>
                    <div class="card-body content-list-body">
                        <h5 class="content-list-title">
                            {{ $gallery->name }}
                        </h5>
                        <p class="content-list-description">
                            {{ $gallery->description 
                                ? \Illuminate\Support\Str::limit(strip_tags($gallery->description), 450, '...') 
                                : 'Da clic aquí para conocer más de este evento.' }}
                        </p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $galleries->links('pagination::bootstrap-5') }}
    </div>
</div>