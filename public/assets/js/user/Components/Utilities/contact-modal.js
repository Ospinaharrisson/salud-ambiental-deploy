document.addEventListener('DOMContentLoaded', () => {
    const contactModal = document.getElementById('contact-message-modal');

    if (!contactModal) {
        return;
    }

    const closeButton = contactModal.querySelector('.contact-modal-close');
    if (!closeButton) {
        return;
    }

    closeButton.addEventListener('click', () => {
        contactModal.classList.remove('is-visible');
        contactModal.classList.add('contact-fade-out');

        setTimeout(() => {
            contactModal.remove();
        }, 300);
    });
});