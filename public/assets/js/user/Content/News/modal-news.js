document.addEventListener('DOMContentLoaded', () => {
  function floatModalImage(modalEl) {
    const editor = modalEl.querySelector('.modal-body .ql-editor');
    if (!editor) return;

    const leftCol = modalEl.querySelector('.modal-body .row > div:first-child');
    let img = leftCol ? leftCol.querySelector('img') : null;

    if (!img) {
        const imgs = Array.from(modalEl.querySelectorAll('.modal-body img'));
        img = imgs.find(i => !editor.contains(i));
    }

    if (!img) return;
    if (editor.contains(img)) return;

    const firstParagraph = editor.querySelector('p') || editor.firstElementChild || editor;
    firstParagraph.insertBefore(img, firstParagraph.firstChild);

    img.style.cssFloat = 'left';
    img.style.marginRight = '15px';
    img.style.marginBottom = '10px';

    if (leftCol) leftCol.style.display = 'none';
    const textCol = editor.closest('[class*="col-"]');
    if (textCol) {
        textCol.classList.remove('col-md-8');
        textCol.classList.add('col-12');
    }
  }

  document.querySelectorAll('.block[role="button"][data-type="article"]').forEach(block => {
    const articleId = block.dataset.id;
    const modalEl = document.getElementById(`article-modal-${articleId}`);
    if (!modalEl) return;

    if (!modalEl.bootstrapModal) {
      modalEl.bootstrapModal = new bootstrap.Modal(modalEl);
    }

    block.addEventListener('click', () => {
        floatModalImage(modalEl);
        modalEl.bootstrapModal.show();
    });
  });

  document.querySelectorAll('[id^="article-modal-"]').forEach(modalEl => {
    modalEl.addEventListener('hidden.bs.modal', () => {
      document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
    });

    modalEl.addEventListener('shown.bs.modal', () => floatModalImage(modalEl));
  });
});
