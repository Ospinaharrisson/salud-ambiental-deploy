document.addEventListener('DOMContentLoaded', () => {
  initDesktopNavbar();
});

function initDesktopNavbar() {
  const wrapper = document.querySelector('#desktop-navbar-wrapper');
  if (!wrapper) return;

  initDesktopScrollBehavior(wrapper);
  initDesktopDropdowns();
  initDesktopSubmenus();
  initDesktopOutsideClick();
}

function initDesktopScrollBehavior(wrapper) {
  const handleScroll = () => {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;

    wrapper.classList.toggle(
      'fixed-top',
      scrollTop > 250
    );
  };

  window.addEventListener('scroll', handleScroll);
}

function initDesktopDropdowns() {
  const items = document.querySelectorAll(
    '.desktop-navbar-item'
  );

  items.forEach(item => {
    item.addEventListener('click', (event) => {

      if (event.target.closest('.dynamic-link')) {
        return;
      }

      event.stopPropagation();

      const dropdown = item.querySelector(
        '.desktop-navbar-dropdown'
      );

      if (!dropdown) return;

      closeDesktopDropdowns(item);

      dropdown.classList.toggle('show');
      item.classList.toggle('active');
    });
  });
}

function closeDesktopDropdowns(currentItem = null) {

  document.querySelectorAll('.desktop-navbar-dropdown.show')
  .forEach(dropdown => {
    const parentItem = dropdown.closest('.desktop-navbar-item');
    if (parentItem !== currentItem) {
      dropdown.classList.remove('show');
      parentItem?.classList.remove('active');
    }
  });
}

function initDesktopSubmenus() {

  const buttons = document.querySelectorAll(
    '.desktop-dropdown-button'
  );

  buttons.forEach(button => {
    button.addEventListener('click', (event) => {
      event.preventDefault();
      event.stopPropagation();

      const submenu = button.nextElementSibling;

      if (
        !submenu ||
        !submenu.classList.contains(
          'desktop-dropdown-submenu-list'
        )
      ) {
        return;
      }
      closeDesktopSubmenus(submenu);
      submenu.classList.toggle('show');
    });
  });
}

function closeDesktopSubmenus(currentSubmenu = null) {
  document.querySelectorAll('.desktop-dropdown-submenu-list.show')
  .forEach(submenu => {
    if (submenu !== currentSubmenu) {
      submenu.classList.remove('show');
    }
  });
}

function initDesktopOutsideClick() {
  document.addEventListener('click', (event) => {
    const insideNavbar = event.target.closest(
      '.desktop-navbar'
    );

    if (insideNavbar) return;

    closeDesktopDropdowns();
    closeDesktopSubmenus();
  });
}