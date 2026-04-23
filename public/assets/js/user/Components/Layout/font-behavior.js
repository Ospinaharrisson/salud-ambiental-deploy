document.addEventListener("DOMContentLoaded", () => {
    const root = document.documentElement;
    let scale = 1;
    const step = 0.1;
    const minScale = 0.8;
    const maxScale = 1.2;

    const increaseBtn = document.getElementById("increase-font");
    const decreaseBtn = document.getElementById("decrease-font");

    const updateDisabledState = () => {
        if (scale <= minScale) {
            decreaseBtn.classList.add("disabled");
        } else {
            decreaseBtn.classList.remove("disabled");
        }

        if (scale >= maxScale) {
            increaseBtn.classList.add("disabled");
        } else {
            increaseBtn.classList.remove("disabled");
        }
    };

    increaseBtn?.addEventListener("click", () => {
        if (scale < maxScale) {
            scale += step;
            root.style.setProperty("--font-scale", scale.toFixed(2));
            updateDisabledState();
        }
    });

    decreaseBtn?.addEventListener("click", () => {
        if (scale > minScale) {
            scale -= step;
            root.style.setProperty("--font-scale", scale.toFixed(2));
            updateDisabledState();
        }
    });

    updateDisabledState();
});
