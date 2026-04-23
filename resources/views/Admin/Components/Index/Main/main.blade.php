@extends('Admin.Components.Layout.layout')
@php($hideBreadcrumb = true)

@section('content')
    <div class="h-100 w-100">
        <div 
            x-data="{
                showCarousel: JSON.parse(localStorage.getItem('showCarousel') || 'true')
            }"
            x-init="
                $watch('showCarousel', val => {
                    localStorage.setItem('showCarousel', val);
                    if (val && window.focusCarouselIndex) {
                        setTimeout(() => {
                            window.focusCarouselIndex(window.startModuleIndex ?? 0);
                        }, 50);
                    }
                });
                if (showCarousel && window.focusCarouselIndex) {
                    setTimeout(() => {
                        window.focusCarouselIndex(window.startModuleIndex ?? 0);
                    }, 50);
                }
            "
            class=" h-100 w-100 px-3 mb-4"
        >
            <div class="d-flex flex-column align-items-center justify-content-center h-100">
                <label class="switch">
                    <input type="checkbox" id="viewToggle" x-model="showCarousel">
                    <span class="slider"></span>
                </label>

                <div x-show="showCarousel" x-cloak style="min-height: 500px; width: 100%;">
                    @livewire('admin.index.carrusel-modules')
                </div>

                <div x-show="!showCarousel" x-cloak style="min-height: 500px; width: 100%;">
                    @livewire('admin.index.card-modules')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//unpkg.com/alpinejs" defer></script>
@endpush
