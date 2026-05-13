document.addEventListener('DOMContentLoaded', () => {

    const modalEl = document.getElementById('gallery-modal');

    if (!modalEl) return;

    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);

    const titleEl = document.getElementById('gallery-modal-title');
    const dateEl = document.getElementById('gallery-modal-date');
    const descriptionEl = document.getElementById('gallery-modal-description');

    const carouselInnerEl = document.getElementById('gallery-modal-carousel-inner');

    const prevBtn = document.getElementById('gallery-modal-prev');
    const nextBtn = document.getElementById('gallery-modal-next');

    document.addEventListener('click', (e) => {

        const trigger = e.target.closest('[data-gallery-trigger]');

        if (!trigger) return;

        const title = trigger.dataset.galleryTitle || '';

        const date = trigger.dataset.galleryDate || '';

        const description = JSON.parse(
            trigger.dataset.galleryDescription || '""'
        );

        const images = JSON.parse(
            trigger.dataset.galleryImages || '[]'
        );

        titleEl.textContent = title;

        if (date) {
            dateEl.textContent = `Fecha del evento: ${date}`;
            dateEl.classList.remove('d-none');
        } else {
            dateEl.classList.add('d-none');
        }

        descriptionEl.innerHTML = description || '';

        carouselInnerEl.innerHTML = '';

        images.forEach((image, index) => {

            carouselInnerEl.innerHTML += `
                <div class="carousel-item ${index === 0 ? 'active' : ''}">
                    <img
                        src="${image}"
                        alt="Imagen ${index + 1}"
                    >
                </div>
            `;
        });

        if (images.length > 1) {

            prevBtn.classList.remove('d-none');
            nextBtn.classList.remove('d-none');

        } else {

            prevBtn.classList.add('d-none');
            nextBtn.classList.add('d-none');
        }

        modal.show();
    });
});