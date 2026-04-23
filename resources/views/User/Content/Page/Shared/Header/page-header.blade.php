<div class="page-header">
    @if($image && $image != '')
        <div class="module-banner">
            <img src="{{ $imageIsBase64 ? renderBase64Image($image) : asset($image) }}"
                 alt="Banner"
                 class="img-fluid">
        </div>
    @endif

    @include('User.Content.Page.Shared.Header.page-breadcrumb', [
        'items' => $breadcrumbItems ?? []
    ])
</div>
