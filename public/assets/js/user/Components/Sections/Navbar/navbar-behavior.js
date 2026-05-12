const navbarState = {
  currentMode: null,
  breakpoint: 769,
  resizeTimeout: null,
  lastWidth: window.innerWidth,
  isTouchDevice: (('ontouchstart' in window) || (navigator.maxTouchPoints && navigator.maxTouchPoints > 0) || (window.matchMedia && window.matchMedia('(pointer: coarse)').matches)),
};


function shouldUseMobileNavbar() {
  return window.innerWidth < navbarState.breakpoint;
}

function getCurrentMode() {
  return shouldUseMobileNavbar() ? 'mobile' : 'desktop';
}

function renderNavbar() {
  const container = document.getElementById('main-navbar-container');
  if (!container) return;

  const newMode = getCurrentMode();

  if (navbarState.currentMode === newMode) {
    return;
  }

  navbarState.currentMode = newMode;
  container.innerHTML = '';

  if (newMode === 'mobile') {
    const mobileClone = document.getElementById('navbar-mobile-source')?.cloneNode(true).firstElementChild;
    if (mobileClone) {
      mobileClone.style.display = 'block';
      container.appendChild(mobileClone);
      initMobileNavbar(container);
    }
  } else {
    const desktopClone = document.getElementById('navbar-desktop-source')?.cloneNode(true).firstElementChild;
    if (desktopClone) {
      desktopClone.style.display = 'block';
      container.appendChild(desktopClone);
      initDesktopNavbar(container);
    }
  }
}

window.addEventListener('resize', () => {
  const currentWidth = window.innerWidth;

  if (Math.abs(currentWidth - navbarState.lastWidth) > 50) {
    clearTimeout(navbarState.resizeTimeout);
    navbarState.resizeTimeout = setTimeout(() => {
      renderNavbar();
      navbarState.lastWidth = currentWidth;
    }, 200);
  }
});

window.addEventListener('orientationchange', () => {
  clearTimeout(navbarState.resizeTimeout);
  navbarState.resizeTimeout = setTimeout(() => {
    // Re-evaluar el modo (desktop/mobile) al rotar la pantalla.
    renderNavbar();
  }, 300);
});

document.addEventListener('DOMContentLoaded', () => {
  navbarState.lastWidth = window.innerWidth;
  renderNavbar();
});

function initDesktopNavbar(container) {
  const wrapper = container.querySelector('#main-navbar-wrapper');
  if (!wrapper) return;

  const scrollHandler = () => {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    wrapper.classList.toggle('fixed-top', scrollTop > 250);
  };
  window.addEventListener('scroll', scrollHandler);

  container.querySelectorAll('.dropdown-submenu > .dropdown-toggle').forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      const submenu = this.nextElementSibling;
      if (!submenu) return;

      container.querySelectorAll('.dropdown-menu.show').forEach(openMenu => {
        if (openMenu !== submenu && !openMenu.contains(submenu) && !submenu.contains(openMenu)) {
          openMenu.classList.remove('show');
        }
      });

      submenu.classList.toggle('show');
    });
  });

  container.querySelectorAll('.navbar-nav > li.dropdown').forEach(item => {
    item.addEventListener('click', function (e) {
      e.stopPropagation();
      const menu = item.querySelector('.dropdown-menu');
      if (!menu) return;

      container.querySelectorAll('.dropdown-menu.show').forEach(openMenu => {
        if (openMenu !== menu && !openMenu.contains(menu) && !menu.contains(openMenu)) {
          openMenu.classList.remove('show');
        }
      });

      container.querySelectorAll('.navbar-nav > li.dropdown.active').forEach(activeItem => {
        if (activeItem !== item) activeItem.classList.remove('active');
      });

      menu.classList.toggle('show');
      item.classList.toggle('active');
    });
  });

  const clickOutsideHandler = function (e) {
    if (!e.target.closest('.dropdown')) {
      container.querySelectorAll('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
      container.querySelectorAll('.navbar-nav > li.dropdown.active').forEach(b => b.classList.remove('active'));
    }
  };
  document.addEventListener('click', clickOutsideHandler);
}

function initMobileNavbar(container) {
  const mobileToggler = container.querySelector('#mobile-navbar-toggle');
  const mobileContent = container.querySelector('#mobile-navbar-content');
  const mobileButtons = container.querySelectorAll('.mobile-nav-btn');
  const mobileCollectionBtns = container.querySelectorAll('.mobile-collection-btn');

  if (!mobileToggler || !mobileContent) return;

  mobileToggler.addEventListener('click', () => {
    mobileToggler.classList.toggle('active');

    mobileContent.classList.remove('animate');
    void mobileContent.offsetWidth;
    mobileContent.classList.add('animate');

    if (mobileContent.classList.contains('open')) {
      mobileContent.style.maxHeight = mobileContent.scrollHeight + 'px';
      mobileContent.style.opacity = '1';
      mobileContent.classList.remove('fade-down');
      mobileContent.classList.add('fade-up');

      requestAnimationFrame(() => {
        mobileContent.style.maxHeight = '0px';
        mobileContent.style.opacity = '0';
      });

      const onTransitionEnd = (e) => {
        if (e.propertyName === 'max-height') {
          mobileContent.classList.remove('open', 'fade-up');
          mobileContent.style.display = 'none';
          mobileContent.removeEventListener('transitionend', onTransitionEnd);
        }
      };
      mobileContent.addEventListener('transitionend', onTransitionEnd);

    } else {
      // Abriendo
      mobileContent.style.display = 'block';
      mobileContent.style.maxHeight = '0px';
      mobileContent.style.opacity = '0';
      mobileContent.classList.add('open', 'fade-down');

      requestAnimationFrame(() => {
        mobileContent.style.maxHeight = mobileContent.scrollHeight + 'px';
        mobileContent.style.opacity = '1';
      });

      const onTransitionEndOpen = (e) => {
        if (e.propertyName === 'max-height') {
          mobileContent.classList.remove('fade-down');
          mobileContent.style.maxHeight = 'none';
          mobileContent.removeEventListener('transitionend', onTransitionEndOpen);
        }
      };
      mobileContent.addEventListener('transitionend', onTransitionEndOpen);
    }
  });

  mobileButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const parent = btn.closest('.mobile-nav-item');
      const dropdown = parent.querySelector('.mobile-dropdown');

      container.querySelectorAll('.mobile-nav-item').forEach(item => {
        if (item !== parent) item.classList.remove('open');
      });

      parent.classList.toggle('open');

      if (dropdown) {
        dropdown.classList.remove('fade-down', 'fade-up');
        dropdown.classList.add(parent.classList.contains('open') ? 'fade-down' : 'fade-up');
      }
    });
  });

  mobileCollectionBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const parent = btn.closest('.mobile-collection');
      const list = parent.querySelector('.mobile-collection-list');

      parent.parentElement.querySelectorAll('.mobile-collection').forEach(item => {
        if (item !== parent) item.classList.remove('open');
      });

      parent.classList.toggle('open');

      if (list) {
        list.classList.remove('fade-down', 'fade-up');
        list.classList.add(parent.classList.contains('open') ? 'fade-down' : 'fade-up');
      }
    });
  });
}
