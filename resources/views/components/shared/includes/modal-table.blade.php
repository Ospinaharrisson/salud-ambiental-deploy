<div class="modal fade" id="recordModal" tabindex="-1"aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold" id="modal-name">Detalles del registro</h5>
                    <span>Numero de registro CAS: <strong id="modal-cas"></strong></span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex flex-wrap justify-content-center gap-2 my-4" id="modal-stamps"></div>
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <tbody>
                            <tr>
                                <th scope="row"># ONU asociado(s)</th>
                                <td id="modal-onu"></td>
                            </tr>
                            <tr>
                                <th scope="row">Cantidad mensualmente almacenada</th>
                                <td id="modal-stored"></td>
                            </tr>
                            <tr>
                                <th scope="row">Cantidad mensualmente utilizada</th>
                                <td id="modal-used"></td>
                            </tr>
                            <tr>
                                <th scope="row">Puntaje</th>
                                <td id="modal-score"></td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    Categorías de peligros asociados de acuerdo con el sistema globalmente armonizado (ONU,2015)
                                </th>
                                <td>
                                    <div class="d-flex flex-wrap gap-2" id="modal-danger"></div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="w-25">
                                    Actividades económicas asociadas
                                </th>
                                <td>
                                    <div class="d-flex flex-wrap gap-2" id="modal-economy"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>