document.addEventListener('DOMContentLoaded', () => {
  initMobileNavbar();
});

function initMobileNavbar() {
  const navbar = document.querySelector('#mobile-navbar');
  if (!navbar) return;

  const toggle = navbar.querySelector('#mobile-navbar-toggle');
  const content = navbar.querySelector('#mobile-navbar-content');

  initToggle(toggle, content);
  initModules(navbar);
  initCollections(navbar);
}

function initToggle(toggle, content) {
  if (!toggle || !content) return;

  toggle.addEventListener('click', () => {
    toggle.classList.toggle('active');
    content.classList.toggle('open');
  });
}

function initModules(navbar) {
  const buttons = navbar.querySelectorAll('.mobile-navbar-button');

  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.mobile-navbar-item');
      if (!item) return;

      closeOtherModules(navbar, item);
      item.classList.toggle('open');
    });
  });
}

function closeOtherModules(navbar, current) {
  navbar.querySelectorAll('.mobile-navbar-item.open').forEach(item => {
    if (item !== current) item.classList.remove('open');
  });
}

function initCollections(navbar) {
  const buttons = navbar.querySelectorAll('.mobile-dropdown-button');

  buttons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();

      const collection = btn.closest('.mobile-dropdown-collection');
      if (!collection) return;

      closeOtherCollections(navbar, collection);
      collection.classList.toggle('open');
    });
  });
}

function closeOtherCollections(navbar, current) {
  navbar
    .querySelectorAll('.mobile-dropdown-collection.open')
    .forEach(col => {
      if (col !== current) col.classList.remove('open');
    });
}