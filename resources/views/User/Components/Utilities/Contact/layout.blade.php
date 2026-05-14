<div class="contact-widget">
    <div class="contact-form">
        <div class="contact-header">
            <p class="contact-title">
                Contáctenos
            </p>
        </div>

        <div class="contact-body">

            <p class="contact-message">
                Diligencia todos los campos para tomar tu mensaje
            </p>

            <form
                class="contact-form-content"
                method="POST"
                action="{{ route('home.contact.create') }}"
            >
                @csrf

                <input type="text" name="name" placeholder="Nombre:" required>

                <input type="email" name="email" placeholder="Email:" required>

                <input type="tel" name="phone" placeholder="Teléfono:" required>

                <input type="text" name="location" placeholder="Localidad:" required>

                <input type="text" name="topic" placeholder="Tema de interés:" required>

                <textarea
                    name="comments"
                    placeholder="Comentarios:"
                    required
                ></textarea>

                <button type="submit">
                    Enviar
                </button>
            </form>
        </div>
    </div>
</div>

@once
    @push('modals')
        @include('User.Components.Utilities.Contact.Fragments.contact-modal')
    @endpush
@endonce