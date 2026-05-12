@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/News/news.css') }}">
@endpush

@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Mobile/mobile-content.css') }}">
    @endpush

    @push('modals')
        @include('User.Content.News.Includes.news-modal')
    @endpush
@endonce

@if(isset($articles) && $articles->count())
    <div class="content-card card">
        <div class="content-section-header card-header">
            <h3 class="content-section-title">Noticias</h3>
        </div>

        <div class="card-body">
            <div class="content-desktop-view">
                @include('User.Content.News.Viewports.desktop')
            </div>

            <div class="content-mobile-view">
                @include('User.Content.News.Viewports.mobile')
            </div>
        </div>

        <div class="card-footer d-flex justify-content-start p-3">
            <a href="{{ route('articles.index') }}" class="btn content-button">Ver más información</a>
        </div>
    </div>
@endif

@push('scripts')
    <script src="{{asset('assets/js/user/Content/News/modal-news.js')}}"></script>
@endpush