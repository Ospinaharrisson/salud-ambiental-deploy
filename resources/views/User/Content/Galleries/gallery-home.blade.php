@extends('User.Components.Layout.layout')
@section('title','galerías')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user/Content/Gallery/gallery.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center my-4">
        <h3 class="section-title mb-0 text-center flex-grow-1">
            Historial de Galerías
        </h3>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary ms-3">
            Volver
        </a>
    </div>

    @livewire('user.galleries.gallery-list')
@endsection