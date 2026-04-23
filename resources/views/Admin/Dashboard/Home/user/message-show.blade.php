@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    <div class="box-rounded box-shadow">
        <div class="bg p-4 border-bottom">
            <h5 class="text-title mb-0">Mensaje de: {{ $message->name }}</h5>
        </div>

        <div class="p-4">

            <div class="mb-3">
                <label class="form-label fw-semibold">Correo electrónico</label>
                <div class="form-control bg-light border px-3 py-2">
                    {{ $message->email }}
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Teléfono</label>
                <div class="form-control bg-light border px-3 py-2">
                    {{ $message->phone }}
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Localidad</label>
                <div class="form-control bg-light border px-3 py-2">
                    {{ $message->location }}
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Tema de Interés</label>
                <div class="form-control bg-light border px-3 py-2">
                    {{ $message->topic }}
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Comentarios</label>
                <div class="form-control bg-light border rounded p-3" style="min-height: fit-content">
                    {{ $message->comments }}
                </div>
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('admin.home.message') }}" class="btn btn-outline-success">
                    Regresar
                </a>
            </div>
        </div>
    </div>
@endsection
