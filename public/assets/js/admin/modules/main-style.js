function initCarrusel() {
  const track = document.getElementById('carouselTrack');
  if (!track) return;

  const cards = Array.from(track.children);
  const buttons = track.querySelectorAll('.card-button');
  const indicators = document.querySelectorAll('.indicator-btn');
  let activeIndex = window.startModuleIndex || 0;

  function getCardFullWidth(card) {
    const style = window.getComputedStyle(card);
    const marginLeft = parseFloat(style.marginLeft);
    const marginRight = parseFloat(style.marginRight);
    return card.offsetWidth + marginLeft + marginRight;
  }

  function resetCardStyles() {
    cards.forEach(card => {
      card.style.transform = '';
      card.style.boxShadow = '';
    });
  }

  function applyActiveStyle(card) {
    card.style.transform = 'scale(1.19)';
    card.style.boxShadow = '0 8px 20px rgba(0,0,0,0.25)';
  }

  function updateCarousel(skipTransition = false) {
    cards.forEach(card => card.classList.remove('active'));
    cards[activeIndex].classList.add('active');

    const containerWidth = document.querySelector('.carousel-container').offsetWidth;
    const cardWidth = getCardFullWidth(cards[activeIndex]);
    const offset = (containerWidth / 2) - (cardWidth / 2);
    const translateX = offset - cards
      .slice(0, activeIndex)
      .reduce((acc, c) => acc + getCardFullWidth(c), 0);

    if (skipTransition) {
      track.style.transition = 'none';
    }

    track.style.transform = `translateX(${translateX}px)`;

    if (skipTransition) {
      void track.offsetWidth;
      track.style.transition = 'transform 0.5s ease';
      track.classList.add('ready');
    }

    resetCardStyles();
    applyActiveStyle(cards[activeIndex]);

    indicators.forEach(b => b.classList.remove('active'));
    if (indicators[activeIndex]) {
      indicators[activeIndex].classList.add('active');
    }
  }

  cards.forEach(card => {
    card.addEventListener('click', () => {
      const index = parseInt(card.dataset.index);
      activeIndex = index;
      updateCarousel();
    });
  });

  buttons.forEach(button => {
    button.addEventListener('mouseenter', () => {
      const card = button.closest('.module-card');
      if (card && card.classList.contains('active')) {
        card.style.transform = 'scale(1.3)';
        card.style.boxShadow = '0 10px 20px rgba(0,0,0,0.35)';
      }
    });
    button.addEventListener('mouseleave', () => {
      const card = button.closest('.module-card');
      if (card && card.classList.contains('active')) {
        applyActiveStyle(card);
      }
    });
  });

  indicators.forEach(btn => {
    btn.addEventListener('click', () => {
      const index = parseInt(btn.dataset.index);
      activeIndex = index;
      updateCarousel();
    });
  });

  updateCarousel(true);

  window.focusCarouselIndex = function(index = activeIndex) {
    activeIndex = index;
    cards.forEach(card => card.classList.remove('active'));
    cards[activeIndex].classList.add('active');

    const containerWidth = document.querySelector('.carousel-container').offsetWidth;
    const cardWidth = getCardFullWidth(cards[activeIndex]);
    const offset = (containerWidth / 2) - (cardWidth / 2);
    const translateX = offset - cards
      .slice(0, activeIndex)
      .reduce((acc, c) => acc + getCardFullWidth(c), 0);

    track.style.transition = 'transform 0.5s ease';
    track.style.transform = `translateX(${translateX}px)`;

    resetCardStyles();
    applyActiveStyle(cards[activeIndex]);

    indicators.forEach(b => b.classList.remove('active'));
    if (indicators[activeIndex]) {
      indicators[activeIndex].classList.add('active');
    }
  }
}

window.addEventListener('load', initCarrusel);

document.addEventListener('livewire:load', () => {
  Livewire.hook('message.processed', (message, component) => {
    if (component.fingerprint.name === 'admin.index.carrusel-modules') {
      setTimeout(initCarrusel, 10);
    }
  });
});

window.addEventListener('resize', () => {
  if (document.getElementById('carouselTrack')) {
    window.focusCarouselIndex && window.focusCarouselIndex();
  }
});
