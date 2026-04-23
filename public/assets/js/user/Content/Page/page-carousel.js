document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".carousel-wrapper").forEach((wrapper) => {
        const track = wrapper.querySelector(".carousel-track");
        const prev = wrapper.querySelector(".carousel-prev");
        const next = wrapper.querySelector(".carousel-next");

        if (!track || !prev || !next) return;

        let currentIndex = 0;
        const step = 4;
        const items = Array.from(track.children);
        const totalItems = items.length;

        function getItemWidth(index) {
            return items[index]?.getBoundingClientRect().width + 12 || 0;
        }

        function updateCarousel() {
            let offset = 0;

            for (let i = 0; i < currentIndex; i++) {
                offset += getItemWidth(i);
            }

            track.style.transform = `translateX(-${offset}px)`;

            prev.disabled = currentIndex === 0;
            next.disabled = currentIndex + step >= totalItems;
        }

        next.addEventListener("click", () => {
            if (currentIndex + step < totalItems) {
                currentIndex += step;
            } else {
                currentIndex = totalItems - 1;
            }

            updateCarousel();
        });

        prev.addEventListener("click", () => {
            currentIndex = Math.max(0, currentIndex - step);
            updateCarousel();
        });

        updateCarousel();
    });

    document.querySelectorAll(".toggle-group-view").forEach((button) => {
        button.addEventListener("click", function () {
            const wrapper = button.closest(".group-view-wrapper");
            const carouselRow = wrapper.querySelector(".carousel-row");
            const expanded = wrapper.querySelector(".group-expanded-view");
            const icon = button.querySelector("i");

            const isOpen = expanded.classList.contains("open");

            if (!isOpen) {
                carouselRow.classList.add("hidden");
                expanded.classList.add("open");

                setTimeout(() => {
                    expanded.classList.add("scrollable");
                }, 450);

                icon.classList.add("rotated");
            } else {
                expanded.classList.remove("scrollable");
                expanded.classList.remove("open");
                carouselRow.classList.remove("hidden");

                icon.classList.remove("rotated");
            }
        });
    });
});
