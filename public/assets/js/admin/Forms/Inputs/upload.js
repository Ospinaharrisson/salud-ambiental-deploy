(function () {
  const inputs = document.querySelectorAll('.file-upload-wrapper input[type="file"]');
  if (!inputs.length) return;

  inputs.forEach(fileInput => {
    const wrapper = fileInput.closest('.file-upload-wrapper');
    const formSection = fileInput.closest('.form-section');
    const fileListUl = formSection?.querySelector('.file-list ul');
    if (!wrapper || !fileListUl) return;

    const type = fileInput.dataset.type || 'image';
    const maxFiles = parseInt(fileInput.dataset.maxFiles || '8');
    const maxSizeBytes = 5 * 1024 * 1024;

    const mimeTypes = {
      image: ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'],
      pdf: ['application/pdf']
    };
    const validMimeTypes = mimeTypes[type] || mimeTypes.image;

    let currentFiles = [];

    const updateInputFiles = () => {
      const dataTransfer = new DataTransfer();
      currentFiles.forEach(file => dataTransfer.items.add(file));
      fileInput.files = dataTransfer.files;
    };

    const addFileItem = (file, isValid, errorMessage = '', prepend = false) => {
      const li = document.createElement('li');
      li.classList.toggle('invalid', !isValid);

      const leftDiv = document.createElement('div');
      leftDiv.className = 'd-flex align-items-center justify-content-between w-100';

      const content = document.createElement('div');
      content.className = 'content';

      const label = document.createElement('label');
      label.textContent = file.name.replace(/\.[^/.]+$/, "");

      const small = document.createElement('small');
      small.textContent = isValid ? `${(file.size / 1024).toFixed(1)} KB` : errorMessage;
      if (!isValid) {
        small.style.color = '#a71d2a';
        small.style.fontWeight = '600';
      }

      content.appendChild(label);
      content.appendChild(small);

      const badge = document.createElement('span');
      badge.className = 'badge bg-secondary ms-3';
      badge.textContent = '.' + file.name.split('.').pop().toLowerCase();

      const deleteBtn = document.createElement('button');
      deleteBtn.className = 'button-delete';
      deleteBtn.type = 'button';
      deleteBtn.textContent = '✕';

      leftDiv.appendChild(deleteBtn);
      leftDiv.appendChild(content);
      leftDiv.appendChild(badge);
      li.appendChild(leftDiv);

      prepend ? fileListUl.prepend(li) : fileListUl.appendChild(li);

      deleteBtn.addEventListener('click', () => {
        const index = Array.from(fileListUl.children).indexOf(li);
        if (index !== -1) {
          currentFiles.splice(index, 1);
          updateInputFiles();
        }
        li.remove();
      });
    };

    const handleFiles = (files) => {
      const availableSlots = maxFiles - currentFiles.length;
      if (availableSlots <= 0) return;

      let toAdd = [];

      Array.from(files).forEach(file => {
        if (toAdd.length >= availableSlots) return;

        if (!validMimeTypes.includes(file.type)) {
          addFileItem(file, false, 'Tipo de archivo no permitido', true);
          return;
        }

        if (file.size > maxSizeBytes) {
          addFileItem(file, false, 'Archivo demasiado grande (máx 5MB)', true);
          return;
        }

        toAdd.push(file);
      });

      toAdd.forEach(file => {
        currentFiles.push(file);
        addFileItem(file, true, '', true);
      });

      updateInputFiles();
      fileInput.value = '';
    };

    wrapper.addEventListener('click', () => {
      if (currentFiles.length < maxFiles) {
        fileInput.click();
      }
    });

    fileInput.addEventListener('change', () => {
      handleFiles(fileInput.files);
    });

    wrapper.addEventListener('dragover', (e) => {
      e.preventDefault();
      wrapper.classList.add('dragover');
    });

    wrapper.addEventListener('dragleave', (e) => {
      e.preventDefault();
      wrapper.classList.remove('dragover');
    });

    wrapper.addEventListener('drop', (e) => {
      e.preventDefault();
      wrapper.classList.remove('dragover');
      handleFiles(e.dataTransfer.files);
    });

    const parentForm = fileInput.closest('form');
    if (parentForm) {
      parentForm.addEventListener('submit', () => {
        updateInputFiles();
      });
    }
  });
})();
