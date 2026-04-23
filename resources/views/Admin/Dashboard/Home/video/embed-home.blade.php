@extends('Admin.Components.Layout.layout', [ 'sidebar' => true])

@section('title', 'Dashboard - Video')

@section('content')
    @if(isset($video))
        <div class="box-rounded box-shadow my-5">
            <div class="box-header">
                <span class="text-main">Video institucional</span>
            </div>
            <div class="box-body">
                <iframe src="{{ $video->link }}" width="100%" height="400" frameborder="0" allowfullscreen></iframe>

                {{-- Actualizar Enlace --}}
                <div class="my-2">
                    <form method="POST" class="mb-4" action="{{ route('admin.home.video.update', $video->id) }}" id="dashboardForm" novalidate>
                        @csrf
                        @method('PATCH')
                        <label class="block mb-1 font-medium">Enlace</label>
                        <input type="url" name="link" value="{{ old('url', $video->link) }}" class="w-full border rounded p-2 form-control" id="forLink" required />
                        <button type="submit" class="btn btn-dashboard-primary my-3">Actualizar Enlace</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <h1 class="text-center"> Video No disponible</h1>
        <div class="box-shadow box-rounded px-4 pt-2 my-2">
            <form method="POST" class="mb-4" action="{{ route('admin.home.video.store') }}" id="dashboardForm" novalidate>
                @csrf
                @method('POST')
                <label class="block mb-1 font-medium">Enlace</label>
                <input type="url" name="link" class="w-full border rounded p-2 form-control" id="forLink" required />
                <button type="submit" class="btn btn-dashboard-primary mt-3">Insertar video</button>
            </form>
        </div>
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/admin/Forms/form-validation.js') }}"></script>
@endpush