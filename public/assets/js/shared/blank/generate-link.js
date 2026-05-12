document.addEventListener('click', async (e) => {
    const linkEl = e.target.closest('.dynamic-link');

    if (!linkEl) return;

    e.preventDefault();

    const directLink = linkEl.dataset.link;
    const model = linkEl.dataset.model;
    const id = linkEl.dataset.id;

    if (directLink && directLink.trim() !== '') {
        window.open(directLink, '_blank');
        return;
    }

    if (!model || !id) {
        return;
    }

    try {
        const response = await fetch('/blank/generate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    ?.getAttribute('content')
            },
            body: JSON.stringify({
                model,
                id
            })
        });

        if (!response.ok) {
            return;
        }

        const data = await response.json();

        if (!data?.url) {
            return;
        }

        window.open(data.url, '_blank');

    } catch (_) {
        return;
    }
});