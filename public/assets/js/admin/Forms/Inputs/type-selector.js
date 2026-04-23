document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.tipo-selector').forEach(selector => {
        const id = selector.id;
        const form = selector.closest('form');

        const sections = {
            link: form.querySelector('.tipo-link'),
            image: form.querySelector('.tipo-image'),
            document: form.querySelector('.tipo-document')
        };

        function toggleTipoInputs(valor) {
            for (const tipo in sections) {
                const div = sections[tipo];
                if (div) {
                    div.style.display = (tipo === valor) ? 'block' : 'none';
                    div.querySelectorAll('input, select, textarea').forEach(input => {
                        input.disabled = tipo !== valor;
                        input.required = tipo === valor && selector.required;
                    });
                }
            }
        }

        toggleTipoInputs(selector.value);
        
        selector.addEventListener('change', () => toggleTipoInputs(selector.value)); 

        function handleFileInput(input, isImage = false) {
            const fileName = document.getElementById(`file-name-${isImage ? 'img' : 'doc'}-${id}`);
            const previewImage = document.getElementById(`preview-img-${id}`);
            const previewContainer = document.getElementById(`preview-img-container-${id}`);
            const previewDocLink = document.getElementById(`preview-doc-link-${id}`);
            const previewDocContainer = document.getElementById(`preview-doc-container-${id}`);
            const hiddenInput = document.getElementById(`hidden-input-${isImage ? 'img' : 'doc'}-${id}`);
            const MAX_SIZE_IMAGE_MB = 5;
            const MAX_SIZE_DOC_MB = 10;
            const MAX_SIZE_IMAGE_BYTES = MAX_SIZE_IMAGE_MB * 1024 * 1024;
            const MAX_SIZE_DOC_BYTES = MAX_SIZE_DOC_MB * 1024 * 1024;
            const ALLOWED_IMAGE_TYPES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            const ALLOWED_DOC_TYPES = ['application/pdf'];

            input.addEventListener('change', function () {
                const file = input.files[0];

                if (!file) return;

                const allowedTypes = isImage ? ALLOWED_IMAGE_TYPES : ALLOWED_DOC_TYPES;
                const maxSizeBytes = isImage ? MAX_SIZE_IMAGE_BYTES : MAX_SIZE_DOC_BYTES;

                if (!allowedTypes.includes(file.type)) {
                    iziToast.error({
                        title: 'Error',
                        message: isImage ? 'Solo se permiten imágenes en formato JPG, PNG, GIF o WEBP.' : 'Solo se permiten archivos PDF.',
                        position: 'topRight'
                    });
                    input.value = '';
                    if (fileName) fileName.textContent = 'Ningún archivo seleccionado';
                    if (previewContainer) previewContainer.style.display = 'none';
                    return;
                }

                if (file.size > maxSizeBytes) {
                    iziToast.error({
                        title: 'Error',
                        message: `El archivo supera el tamaño máximo permitido de ${isImage ? MAX_SIZE_IMAGE_MB : MAX_SIZE_DOC_MB} MB.`,
                        position: 'topRight'
                    });
                    input.value = '';
                    if (fileName) fileName.textContent = 'Ningún archivo seleccionado';
                    if (previewContainer) previewContainer.style.display = 'none';
                    return;
                }

                if (fileName) fileName.textContent = file.name;

                if (isImage) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        if (previewImage) previewImage.src = e.target.result;
                        if (previewContainer) previewContainer.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else { 
                    const blobURL = URL.createObjectURL(file);
                    if (previewDocLink) previewDocLink.href = blobURL;
                    if (previewDocContainer) previewDocContainer.style.display = 'block';
                }

                if (hiddenInput) {
                    hiddenInput.value = file.name;
                }
            });
        }

        const inputImg = document.getElementById(`input-img-${id}`);
        if (inputImg) {
            handleFileInput(inputImg, true);
        }

        const inputDoc = document.getElementById(`input-doc-${id}`);
        if (inputDoc) {
            handleFileInput(inputDoc, false);
        }
    });
});
