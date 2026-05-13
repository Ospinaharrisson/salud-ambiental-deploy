<div
    class="modal fade"
    id="gallery-modal"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="app-modal-content modal-content">

            <div class="app-modal-header modal-header d-flex justify-content-around align-items-center">
                <h5
                    class="calendar-event-title"
                    id="gallery-modal-title">
                </h5>

                <button
                    type="button"
                    class="app-modal-close btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Cerrar">
                </button>
            </div>

            <div class="app-modal-body modal-body">

                <small
                    id="gallery-modal-date"
                    class="text-muted gallery-date d-none mb-2">
                </small>

                <div
                    id="gallery-modal-description"
                    class="ql-editor gallery-modal-content mb-3">
                </div>

                <div
                    id="gallery-modal-carousel"
                    class="gallery-carousel carousel slide"
                    data-bs-ride="carousel"
                >
                    <div
                        id="gallery-modal-carousel-inner"
                        class="carousel-inner">
                    </div>
                    <button
                        id="gallery-modal-prev"
                        class="carousel-control-prev d-none"
                        type="button"
                        data-bs-target="#gallery-modal-carousel"
                        data-bs-slide="prev">

                        <span
                            class="carousel-control-prev-icon"
                            aria-hidden="true">
                        </span>

                        <span class="visually-hidden">
                            Anterior
                        </span>
                    </button>

                    <button
                        id="gallery-modal-next"
                        class="carousel-control-next d-none"
                        type="button"
                        data-bs-target="#gallery-modal-carousel"
                        data-bs-slide="next">
                        <span
                            class="carousel-control-next-icon"
                            aria-hidden="true">
                        </span>
                        <span class="visually-hidden">
                            Siguiente
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>