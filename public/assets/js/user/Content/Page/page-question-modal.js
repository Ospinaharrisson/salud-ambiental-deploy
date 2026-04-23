document.addEventListener("DOMContentLoaded", () => {
    const questionModal = document.getElementById('questionModal');
    const modalTitle = document.getElementById('questionModalLabel');
    const modalBody = document.getElementById('questionModalBody');
    const questionModalHeader = questionModal.querySelector('.modal-header');

    if (!questionModal) return;

    questionModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        if (!button) return;

        modalTitle.textContent = button.getAttribute('data-bs-title');
        modalBody.innerHTML = button.getAttribute('data-bs-description');
        questionModalHeader.style.backgroundColor = button.getAttribute('data-bs-theme') || '#0d6efd';
    });
});
