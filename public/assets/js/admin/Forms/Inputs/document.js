document.addEventListener('DOMContentLoaded', function () {
    const fileInputs = document.querySelectorAll('input[type="file"]');
    const MAX_SIZE_MB = 10;
    const MAX_SIZE_BYTES = MAX_SIZE_MB * 1024 * 1024;

    fileInputs.forEach(input => {
        const fileNameId = input.dataset.fileName;
        const previewDocLinkId = input.dataset.previewDocLink;
        const previewDocContainerId = input.dataset.previewDocContainer;

        const fileName = fileNameId ? document.getElementById(fileNameId) : null;
        const previewDocLink = previewDocLinkId ? document.getElementById(previewDocLinkId) : null;
        const previewDocContainer = previewDocContainerId ? document.getElementById(previewDocContainerId) : null;

        input.addEventListener('change', function () {
            const file = input.files[0];

            if (!file) return;

            if (file.type !== "application/pdf") {
                iziToast.error({
                    title: 'Error',
                    message: 'Solo se permiten archivos PDF.',
                    position: 'topRight'
                });
                input.value = '';
                if (fileName) fileName.textContent = 'Ningún archivo seleccionado';
                if (previewDocContainer) previewDocContainer.style.display = 'none';
                return;
            }

            if (file.size > MAX_SIZE_BYTES) {
                iziToast.error({
                    title: 'Error',
                    message: `El archivo supera el tamaño máximo permitido de ${MAX_SIZE_MB} MB.`,
                    position: 'topRight'
                });
                input.value = '';
                if (fileName) fileName.textContent = 'Ningún archivo seleccionado';
                if (previewDocContainer) previewDocContainer.style.display = 'none';
                return;
            }

            if (fileName) {
                fileName.textContent = file.name;
            }

            if (file.type === "application/pdf") {
                const blobURL = URL.createObjectURL(file);
                if (previewDocLink) previewDocLink.href = blobURL;
                if (previewDocContainer) previewDocContainer.style.display = 'block';
            }
        });
    });
});
