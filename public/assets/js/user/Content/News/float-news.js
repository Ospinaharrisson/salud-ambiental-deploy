document.addEventListener("DOMContentLoaded", function() {
    const img = document.querySelector(".article-img");
    const body = document.querySelector(".article-body");

    if (img && body) {
        const firstParagraph = body.querySelector("p");
        if (firstParagraph) {
            firstParagraph.insertBefore(img, firstParagraph.firstChild);

            img.style.float = "left";
            img.style.marginRight = "25px";
        }
    }
});