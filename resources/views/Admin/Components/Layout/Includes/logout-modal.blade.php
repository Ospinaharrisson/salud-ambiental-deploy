{{-- Modal para confirmar cierre de sesión --}}
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cerrar sesión</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          ¿Estás seguro de que deseas cerrar la sesión?
        </div>
        <div class="modal-footer">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-dashboard-primary">Cerrar sesión</button>
          </form>
          <button type="button" class="btn btn-dashboard-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>