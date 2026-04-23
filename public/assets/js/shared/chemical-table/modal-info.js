document.addEventListener('DOMContentLoaded', () => {
    const recordModal = document.getElementById('recordModal');
    
    recordModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const name   = button.getAttribute('data-name');
        const cas    = button.getAttribute('data-cas');
        const onu    = button.getAttribute('data-onu');
        const stored = button.getAttribute('data-stored');
        const used   = button.getAttribute('data-used');
        const score  = button.getAttribute('data-score');

        const stamps  = JSON.parse(button.getAttribute('data-stamps') || '[]');
        const details = JSON.parse(button.getAttribute('data-details') || '{}');
        
        recordModal.querySelector('#modal-cas').textContent     = cas;
        recordModal.querySelector('#modal-name').textContent    = name;
        recordModal.querySelector('#modal-onu').textContent     = onu;
        recordModal.querySelector('#modal-stored').textContent  = stored + " Kg";
        recordModal.querySelector('#modal-used').textContent    = used + " Kg";
        recordModal.querySelector('#modal-score').textContent   = score;
        
        const stampContainer = recordModal.querySelector('#modal-stamps');
        stampContainer.innerHTML = '';
        stamps.forEach(stamp => {
            const img = document.createElement('img');
            img.src = stamp.image;
            img.alt = stamp.code;
            img.title = stamp.code;
            img.style.height = '90px';
            img.style.width = '90px';
            img.style.objectFit = 'cover';
            stampContainer.appendChild(img);
        });

        const economyContainer = recordModal.querySelector('#modal-economy');
        const dangerContainer  = recordModal.querySelector('#modal-danger');
        economyContainer.innerHTML = '';
        dangerContainer.innerHTML  = '';

        if (details.economy) {
            details.economy.forEach(val => {
                const span = document.createElement('span');
                span.className = 'badge bg-secondary';
                span.textContent = val;
                economyContainer.appendChild(span);
            });
        }

        if (details.danger) {
            details.danger.forEach(val => {
                const span = document.createElement('span');
                span.className = 'badge bg-secondary';
                span.textContent = val;
                dangerContainer.appendChild(span);
            });
        }
    });
});