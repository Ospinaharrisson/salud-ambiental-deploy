document.addEventListener('DOMContentLoaded', () => {
  const colorInput = document.getElementById('color-input');
  const colorSquare = document.getElementById('color-square');
  const pickr = Pickr.create({
    el: '#color-picker-container',
    theme: 'classic',
    components: {
      preview: true,
      hue: true,
      interaction: {
        input: true,
        save: true,
        clear: true
      }
    }
  });

  let picker;

  pickr.on('init', instance => {
    picker = document.querySelector('.pcr-app');
    if (picker) {
      picker.style.display = 'none';
      picker.style.transition = 'opacity 0.2s ease';
      picker.style.opacity = '0';
    }

    const lastColorBtn = document.querySelector('.pcr-last-color');
    
    if (colorSquare && lastColorBtn) {
      const color = window.getComputedStyle(colorSquare).color;
      if (color) {
          lastColorBtn.style.setProperty('--pcr-color', color);
          lastColorBtn.style.display = '';
      } else {
          lastColorBtn.style.display = 'none';
      }
    }
  });

  function positionAndShowPicker() {
    if (!colorInput || !picker) return;

    const rect = colorInput.getBoundingClientRect();
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const scrollLeft = window.scrollX || document.documentElement.scrollLeft;

    picker.style.display = 'block';
    picker.style.opacity = '0';

    picker.style.position = 'absolute';
    picker.style.top = `${rect.bottom + scrollTop}px`;
    picker.style.left = `${rect.left + scrollLeft}px`;
    picker.style.zIndex = 9999;
    picker.style.transform = 'none';
    picker.offsetHeight;
    picker.style.opacity = '1';
  }

  function showAndPositionPicker() {
    if (pickr.isOpen && pickr.isOpen()) {
      positionAndShowPicker();
      return;
    }

    if (picker) {
      picker.style.display = 'none';
      picker.style.opacity = '0';
    }

    pickr.show();

    setTimeout(() => {
      positionAndShowPicker();
    }, 10);
  }

  document.getElementById('color-indicator').addEventListener('click', showAndPositionPicker);
  colorInput.addEventListener('click', showAndPositionPicker);

  pickr.on('save', (color) => {
    const selectedColor = color.toHEXA().toString();
    colorInput.value = selectedColor;
    colorSquare.style.color = selectedColor;
    pickr.hide();
  });

  window.addEventListener('scroll', () => {
    pickr.hide();
    if (picker) {
      picker.style.opacity = '0';
      picker.style.display = 'none';
      picker.style.top = '-9999px';
      picker.style.left = '-9999px';
      picker.style.transition = 'none';
    }
  });

  colorInput.addEventListener('mousedown', (e) => {
    e.preventDefault();
  });

  colorInput.addEventListener('selectstart', (e) => {
    e.preventDefault();
  });
});
