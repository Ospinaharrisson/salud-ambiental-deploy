<div
    id="contact-message-modal"
    class="contact-modal {{ session('contact_message') || session('contact_message_error') ? 'is-visible' : '' }}"
>
    <div class="contact-modal-content">

        <h4 class="contact-modal-title">
            {{ session('contact_message') ? 'Éxito' : 'Error' }}
        </h4>

        <p class="contact-modal-text">
            {{ session('contact_message') ?? session('contact_message_error') }}
        </p>

        <button
            class="contact-modal-close"
            type="button"
        >
            Cerrar
        </button>

    </div>
</div>