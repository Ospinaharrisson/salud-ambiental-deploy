
document.addEventListener('DOMContentLoaded', function () {
    const fileInputs = document.querySelectorAll('input[type="file"][data-preview-image]');

    const MAX_SIZE_MB = 5;
    const MAX_SIZE_BYTES = MAX_SIZE_MB * 1024 * 1024;
    const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    fileInputs.forEach(input => {
        const fileName = document.getElementById(input.dataset.fileName);
        const previewLabel = document.getElementById(input.dataset.previewLabel);
        const previewImage = document.getElementById(input.dataset.previewImage);
        const previewContainer = document.getElementById(input.dataset.previewContainer);
        const modalImage = document.getElementById(input.dataset.modalImage);
        const previewBtn = document.getElementById(input.dataset.previewBtn);

        input.addEventListener('change', function () {
            const file = input.files[0];

            if (!file) return;

            if (!ALLOWED_TYPES.includes(file.type)) {
                iziToast.error({
                    title: 'Error',
                    message: 'Solo se permiten imágenes en formato JPG, PNG, GIF o WEBP.',
                    position: 'topRight'
                });
                input.value = '';
                return;
            }

            if (file.size > MAX_SIZE_BYTES) {
                iziToast.error({
                    title: 'Error',
                    message: `El archivo supera el tamaño máximo permitido de ${MAX_SIZE_MB} MB.`,
                    position: 'topRight'
                });
                input.value = '';
                return;
            }

            if (fileName) fileName.textContent = file.name;

            const reader = new FileReader();
            reader.onload = function (e) {
                if (previewImage) previewImage.src = e.target.result;
                if (modalImage) modalImage.src = e.target.result;
                if (previewLabel) previewLabel.style.display = 'block';
                if (previewContainer) previewContainer.style.display = 'block';
                if (previewBtn) previewBtn.classList.remove('d-none');
            };

            reader.readAsDataURL(file);
        });
    });
});