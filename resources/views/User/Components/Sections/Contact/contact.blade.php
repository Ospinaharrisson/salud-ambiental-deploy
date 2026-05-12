<div class="container">
    <div class="row">
        <div class="contact-form">

            <div class="contact-header">
                <p class="title">Contáctenos</p>
            </div>

            <div class="contact-body">
                <p class="message">Diligencia todos los campos para tomar tu mensaje</p>

                <form method="POST" action="{{ route('home.contact.create') }}">
                    @csrf

                    <input type="text" name="name" placeholder="Nombre:" required>
                    <input type="email" name="email" placeholder="Email:" required>
                    <input type="tel" name="phone" placeholder="Teléfono:" required>
                    <input type="text" name="location" placeholder="Localidad:" required>
                    <input type="text" name="topic" placeholder="Tema de Interés:" required>

                    <textarea name="comments" placeholder="Comentarios:" required></textarea>

                    <input type="submit" value="Enviar">
                </form>
            </div>

        </div>
    </div>
</div>

@if (session('contact_message') || session('contact_message_error'))
    <div id="contact-message-modal" class="contact-modal">
        <div class="contact-modal-content">
            <h4 class="contact-modal-title">
                {{ session('contact_message') ? 'Éxito' : 'Error' }}
            </h4>

            <p class="contact-modal-text">
                {{ session('contact_message') ?? session('contact_message_error') }}
            </p>

            <button class="contact-modal-close" onclick="closeContactModal()">
                Cerrar
            </button>
        </div>
    </div>

    <script>
    function closeContactModal() {
        const modal = document.getElementById('contact-message-modal');
        modal.classList.add('contact-fade-out');
        setTimeout(() => modal.remove(), 300);
    }
    </script>
@endif