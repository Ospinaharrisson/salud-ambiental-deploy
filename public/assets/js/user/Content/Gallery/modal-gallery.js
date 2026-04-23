document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", (e) => {
        const block = e.target.closest(".gallery-block");
        if (!block) return;

        const galleryId = block.dataset.galleryId;
        if (!galleryId) return;

        const modalEl = document.getElementById(`gallery-modal-${galleryId}`);
        if (!modalEl) return;

        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();
    });
});
