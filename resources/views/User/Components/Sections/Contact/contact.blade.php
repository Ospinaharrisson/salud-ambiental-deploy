<div class="container">
    <div class="row">
        <div class="contact-form">
            <p class="title">Contáctenos</p>
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

@if (session('mensaje') || session('mensajeError'))
  <div id="contact-message-modal" class="contact-modal">
      <div class="contact-modal-content">
          <h4 class="contact-modal-title">
              {{ session('mensaje') ? 'Éxito' : 'Error' }}
          </h4>
          <p class="contact-modal-text">
              {{ session('mensaje') ?? session('mensajeError') }}
          </p>
          <button class="contact-modal-close" onclick="closeContactModal()">Cerrar</button>
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
