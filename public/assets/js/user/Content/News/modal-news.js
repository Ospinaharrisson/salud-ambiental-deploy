document.addEventListener('DOMContentLoaded', () => {

  const modalEl = document.getElementById('article-modal');

  if (!modalEl) return;

  const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
  const titleEl = document.getElementById('article-modal-title');
  const imageEl = document.getElementById('article-modal-image');
  const descriptionEl = document.getElementById('article-modal-description');
  const linkEl = document.getElementById('article-modal-link');

  document.addEventListener('click', (e) => {
    const trigger = e.target.closest('[data-news-trigger]');
    if (!trigger) return;
    const title = trigger.dataset.newsTitle || '';
    const image = trigger.dataset.newsImage || '';
    const description = JSON.parse(trigger.dataset.newsDescription || '""');
    const link = trigger.dataset.newsLink || '';
    const model = trigger.dataset.newsModel || '';
    const id = trigger.dataset.newsId || '';
    
    titleEl.textContent = title;
    imageEl.src = image;
    imageEl.alt = title;
    descriptionEl.innerHTML = `
      <img
        src="${image}"
        class="news-modal-image news-modal-image-floating"
        alt="${title}"
      >
        ${description}
    `;

    if (link || (model && id)) {
      linkEl.classList.remove('d-none');
      linkEl.dataset.link = link;
      linkEl.dataset.model = model;
      linkEl.dataset.id = id;
    } else {
      linkEl.classList.add('d-none');
      delete linkEl.dataset.link;
      delete linkEl.dataset.model;
      delete linkEl.dataset.id;
    }
    modal.show();
  });
});