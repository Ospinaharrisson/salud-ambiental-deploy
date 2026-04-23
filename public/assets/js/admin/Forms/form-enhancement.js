document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('input[type="file"][data-label-target]').forEach(input => {
    const labelSelector = input.getAttribute('data-label-target');
    const label = document.querySelector(labelSelector);
    const checkboxId = input.getAttribute('data-uncheck-on-change');
    const checkbox = checkboxId ? document.getElementById(checkboxId) : null;

    input.addEventListener('change', () => {
      if (input.files.length > 0) {
        label.textContent = input.files[0].name;
        label.classList.remove('fst-italic', 'text-muted');
        label.classList.add('fw-bold', 'text-dark');
        if (checkbox && checkbox.checked) checkbox.checked = false;
      } else {
        label.textContent = 'Ningún archivo seleccionado';
        label.classList.add('fst-italic', 'text-muted');
        label.classList.remove('fw-bold', 'text-dark');
      }
    });
  });
});
