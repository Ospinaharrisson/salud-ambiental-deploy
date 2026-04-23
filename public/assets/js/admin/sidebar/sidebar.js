document.addEventListener('DOMContentLoaded', () => {
  const toggles = document.querySelectorAll('[data-bs-toggle="collapse"]');

  function closeAllExcept(targetId) {
    document.querySelectorAll('.collapse.show').forEach(coll => {
      if (coll.id !== targetId) {
        bootstrap.Collapse.getOrCreateInstance(coll).hide();
      }
    });

    document.querySelectorAll('.toggle-icon').forEach(icon => {
      icon.style.transform = 'rotate(0deg)';
    });
  }

  toggles.forEach(toggle => {
    const icon = toggle.querySelector('.toggle-icon');
    const targetId = toggle.getAttribute('data-bs-target');
    const target = document.querySelector(targetId);

    if (target.classList.contains('show')) {
      toggle.setAttribute('aria-expanded', 'true');
      icon.style.transform = 'rotate(180deg)';
    }

    target.addEventListener('show.bs.collapse', () => {
      closeAllExcept(targetId);
      toggle.setAttribute('aria-expanded', 'true');
      icon.style.transform = 'rotate(180deg)';
    });

    target.addEventListener('hide.bs.collapse', () => {
      toggle.setAttribute('aria-expanded', 'false');
      icon.style.transform = 'rotate(0deg)';
    });
  });

  const activeItem = document.querySelector('#sidebar .active');
  if (activeItem) {
    const collapseParent = activeItem.closest('.collapse');
    if (collapseParent) {
      collapseParent.classList.add('show');

      const toggleBtn = document.querySelector(`[data-bs-target="#${collapseParent.id}"]`);
      if (toggleBtn) {
        const icon = toggleBtn.querySelector('.toggle-icon');
        toggleBtn.setAttribute('aria-expanded', 'true');
        if (icon) icon.style.transform = 'rotate(180deg)';
      }
    }
  }
});
