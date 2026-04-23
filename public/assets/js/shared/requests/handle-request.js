document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.view-blank-link');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    if (!buttons.length || !csrfToken) return;

    buttons.forEach(button => {
        button.addEventListener('click', async () => {
            const id = button.dataset.id;
            const model = button.dataset.model;

            try {
                const response = await fetch('/blank/generate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ id, model })
                });

                const data = await response.json();
                if (response.ok && data.url) {
                    window.open(data.url, '_blank');
                } else {
                    console.error('Error al generar el enlace:', data?.error || data);
                }
            } catch (err) {
                console.error('Error en la petición:', err);
            }
        });
    });
});
