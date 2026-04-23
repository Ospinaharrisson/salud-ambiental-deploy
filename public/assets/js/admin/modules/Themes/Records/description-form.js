document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.description-form');

    forms.forEach(form => {
        const id = form.dataset.id;
        const maxDescriptions = 10;

        const addBtn = document.getElementById(`${id}-add-description`);
        const container = document.getElementById(`${id}-container`);
        const template = document.getElementById(`${id}-template`);

        if (!addBtn || !container || !template) return;

        function toggleAddButton() {
            const items = container.querySelectorAll('.description-template').length;
            if (items >= maxDescriptions) {
                addBtn.disabled = true;
                addBtn.classList.remove('btn-outline-primary');
                addBtn.classList.add('btn-secondary');
            } else {
                addBtn.disabled = false;
                addBtn.classList.add('btn-outline-primary');
                addBtn.classList.remove('btn-secondary');
            }
        }

        addBtn.addEventListener('click', function () {
            const items = container.querySelectorAll('.description-template').length;
            if (items >= maxDescriptions) return;

            const clone = template.cloneNode(true);
            clone.id = "";
            clone.classList.remove('d-none');

            const inputGroup = clone.querySelector('.input-group');
            inputGroup.classList.add('description-template');

            const input = clone.querySelector('input');
            input.name = "descriptions[]";
            input.required = true;

            container.appendChild(clone);
            toggleAddButton();
        });

        container.addEventListener('click', function (e) {
            if (e.target.closest('.remove-description')) {
                e.target.closest('.mb-4').remove();
                toggleAddButton();
            }
        });

        toggleAddButton();
    });
});
