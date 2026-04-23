document.addEventListener("DOMContentLoaded", function () {
    const galleryBlocks = document.querySelectorAll(".gallery-block");

    galleryBlocks.forEach(block => {
        block.addEventListener("click", function () {
            galleryBlocks.forEach(b => b.classList.remove("active"));
            this.classList.add("active");
        });
    });
});