document.addEventListener('DOMContentLoaded', () => {
  initFormValidation();
});

function initFormValidation() {
  const forms = document.querySelectorAll('form[id^="dashboardForm"]');
  if (!forms.length) return;

  forms.forEach(form => {
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
      form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

      const invalidInputs = [...form.querySelectorAll(':invalid')];

      if (invalidInputs.length > 0) {
        const firstInvalid = invalidInputs[0];
        const firstCollapseDiv = firstInvalid.closest('.collapse');

        if (firstCollapseDiv && !firstCollapseDiv.classList.contains('show')) {
          bootstrap.Collapse.getOrCreateInstance(firstCollapseDiv).show();
        }

        invalidInputs.forEach(input => {
          if (input.type === 'file' && input.classList.contains('d-none')) {
            const label = form.querySelector(`label[for="${input.id}"]`);
            if (label) {
              label.classList.add('is-invalid');
              if (!label.nextElementSibling?.classList.contains('invalid-feedback')) {
                const feedback = document.createElement('div');
                feedback.className = 'invalid-feedback';
                feedback.textContent = 'Debe seleccionar un archivo';
                label.parentNode.appendChild(feedback);
              }
            }
          } else {
            input.classList.add('is-invalid');
            if (!input.nextElementSibling?.classList.contains('invalid-feedback')) {
              const feedback = document.createElement('div');
              feedback.className = 'invalid-feedback';
              feedback.textContent = 'Este campo es obligatorio';
              input.insertAdjacentElement('afterend', feedback);
            }
          }
        });

        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
        firstInvalid.focus();
      } else {
        form.submit();
      }
    });

    form.querySelectorAll('input[type="file"]').forEach(inputFile => {
      inputFile.addEventListener('change', () => {
        if (inputFile.files.length > 0) {
          const label = form.querySelector(`label[for="${inputFile.id}"]`);
          if (label && label.classList.contains('is-invalid')) {
            label.classList.remove('is-invalid');
            const next = label.nextElementSibling;
            if (next && next.classList.contains('invalid-feedback')) {
              next.remove();
            }
          }
        }
      });
    });
  });
}