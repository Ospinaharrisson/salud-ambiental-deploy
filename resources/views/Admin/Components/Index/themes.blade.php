@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('title', 'Dashboard - tema ' .$module->name)

@section('content')
    <div class="container">
        <h1>Bienvenido al modulo administrador del módulo <span style="color: {{ $module->theme }}"> {{ $module->name }}</span></h1>
    </div>
@endsection
