@extends('User.Components.Layout.layout')
@section('title', 'Página no encontrada')

@section('content')
    <div class="mt-5">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('assets/images/errors/404.gif') }}" alt="not found" style="height: 200px">
        </div>
        <div class="text-center my-4">
            <h3 class="fw-bold my-2">404 - Página no encontrada</h3>
            <p class="lead">Lo sentimos, la página que buscas no existe o ha sido movida.</p>
            <a href="{{ route('home') }}" class="btn btn-home">volver al inicio</a>
        </div>
    </div>
@endsection
