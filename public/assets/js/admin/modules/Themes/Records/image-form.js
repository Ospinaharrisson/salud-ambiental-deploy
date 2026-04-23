document.addEventListener('DOMContentLoaded', () => {
    const available = document.getElementById('available-images');
    const selected = document.getElementById('selected-images');
    const inputsContainer = document.getElementById('selected-inputs');
    const submitBtn = document.getElementById('submit-selected');

    function updateInputs() {

        inputsContainer.innerHTML = '';
        const ids = [...selected.querySelectorAll('.image-item')].map(i => i.dataset.id);

        ids.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selected_images[]';
            input.value = id;
            inputsContainer.appendChild(input);
        });

        submitBtn.disabled = ids.length === 0;
    }

    function toggleImage(e) {
        const item = e.target.closest('.image-item');
        if (!item) return;
        if (item.parentElement.id === 'available-images') {
            selected.appendChild(item);
        } else {
            available.appendChild(item);
        }
        updateInputs();
    }

    available.addEventListener('click', toggleImage);
    selected.addEventListener('click', toggleImage);

    updateInputs();
});