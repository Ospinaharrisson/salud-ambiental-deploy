function copyPageUrl() {
    const input = document.getElementById('pageUrl');

    if (!input) {
        iziToast.error({
            title: 'Error',
            message: 'No se encontró la URL para copiar.',
            position: 'topRight',
            backgroundColor: '#fd7e14',
            titleColor: '#ffffff',
            messageColor: '#ffffff'
        });
        return;
    }

    navigator.clipboard.writeText(input.value)
        .then(() => {
            iziToast.success({
                title: 'Éxito',
                message: 'URL copiada correctamente.',
                position: 'topRight',
                backgroundColor: '#80aff7',
                titleColor: '#ffffff',
                messageColor: '#ffffff'
            });
        })
        .catch(() => {
            iziToast.error({
                title: 'Error',
                message: 'No fue posible copiar la URL.',
                position: 'topRight',
                backgroundColor: '#fd7e14',
                titleColor: '#ffffff',
                messageColor: '#ffffff'
            });
        });
}