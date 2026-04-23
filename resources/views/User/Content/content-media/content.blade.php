@push('styles')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/Content/content-media/media.css')}}" />
@endpush

<div class="container-fluid main-container mb-4">
    <div class="row">
        @include('User.Content.content-media.Includes.video')
        @include('User.Content.content-media.Includes.gallery-media')
        @include('User.Content.content-media.Includes.info-buttons')
    </div>
</div>