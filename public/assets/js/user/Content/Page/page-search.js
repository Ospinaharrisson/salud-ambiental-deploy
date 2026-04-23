document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('searchModal');
    const openBtn = document.getElementById('openSearch');
    const closeBtn = document.getElementById('closeSearch');

    if (!modal || !openBtn || !closeBtn) return;

    openBtn.addEventListener('click', () => {
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    });

    closeBtn.addEventListener('click', () => {
        modal.classList.remove('show');
        document.body.style.overflow = '';
        Livewire.emit('resetSearchFilters');
    });
});

window.addEventListener('keepSearchOpen', () => {
    const modal = document.getElementById('searchModal');
    if (modal && !modal.classList.contains('show')) {
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
});
