(function () {
    function hideAsset(container) {
        if (!container) return;

        const scope =
            container.closest(".group-block") ||
            container.closest(".carousel-wrapper") ||
            document;

        const itemsInScope =
            scope === document
                ? document.querySelectorAll(".resource-item")
                : scope.querySelectorAll(".resource-item");

        itemsInScope.forEach((el) => el.classList.remove("hide"));

        container.classList.remove("is-visible");
        container.classList.add("is-closing");

        const startHeight = container.scrollHeight;
        container.style.maxHeight = startHeight + "px";
        void container.offsetHeight;

        requestAnimationFrame(() => {
            container.style.maxHeight = "0px";
            container.style.opacity = "0";
        });

        const onEnd = () => {
            container.style.display = "none";
            container.style.maxHeight = "";
            container.style.opacity = "";
            container.classList.remove("is-closing");
            container.removeEventListener("transitionend", onEnd);
        };

        container.removeEventListener("transitionend", onEnd);
        container.addEventListener("transitionend", onEnd);

        setTimeout(onEnd, 500);
    }

    function showAsset(container, resourceId, scope) {
        if (!container) return;

        if (container.classList.contains("is-closing")) {
            container.classList.remove("is-closing");
            container.style.maxHeight = "";
            container.style.opacity = "";
            container.style.display = "block";
        }

        document
            .querySelectorAll(".asset-container.is-visible")
            .forEach((other) => {
                if (other !== container) hideAsset(other);
            });

        const itemsScope =
            scope ||
            container.closest(".group-block") ||
            container.closest(".carousel-wrapper") ||
            document;

        const itemsInScope =
            itemsScope === document
                ? Array.from(document.querySelectorAll(".resource-item"))
                : Array.from(itemsScope.querySelectorAll(".resource-item"));

        itemsInScope.forEach((el) => el.classList.remove("hide"));

        if (resourceId !== null && resourceId !== undefined) {
            itemsInScope.forEach((el) => {
                if (el.getAttribute("data-resource-id") == resourceId) {
                    el.classList.add("hide");
                }
            });
        }

        container.style.display = "block";
        container.classList.remove("animate-bounce", "animate-slide-down");
        void container.offsetWidth;
        container.classList.add("is-visible", "animate-slide-down");

        const onAnim = function (e) {
            if (e.animationName === "slideDown") {
                container.classList.remove("animate-slide-down");
                container.removeEventListener("animationend", onAnim);
            }
        };

        container.removeEventListener("animationend", onAnim);
        container.addEventListener("animationend", onAnim);

        requestAnimationFrame(() => {
            const header = container.querySelector(".asset-header");
            if (header) {
                header.scrollIntoView({
                    behavior: "smooth",
                    block: "center",
                });
            } else {
                container.scrollIntoView({
                    behavior: "smooth",
                    block: "center",
                });
            }
        });
    }

    document.addEventListener("click", function (e) {
        const closeBtn = e.target.closest(".asset-close");
        if (closeBtn) {
            const container = closeBtn.closest(".asset-container");
            if (!container) return;
            hideAsset(container);
            return;
        }

        const itemEl = e.target.closest(".resource-item");
        if (!itemEl) return;

        let scope = itemEl.closest(".group-block");
        if (!scope) scope = itemEl.closest(".carousel-wrapper");

        let assetContainer =
            scope?.querySelector(".asset-container") ||
            document.getElementById("asset-container-ungrouped");

        if (!assetContainer) return;

        const resourceId = itemEl.getAttribute("data-resource-id") || null;

        let itemData = null;
        try {
            itemData = JSON.parse(itemEl.getAttribute("data-item"));
        } catch {
            itemData = null;
        }

        if (itemData) {
            const titleEl = assetContainer.querySelector(".asset-title");
            const descEl = assetContainer.querySelector(".asset-description");

            if (titleEl)
                titleEl.textContent = itemData.name || itemData.nombre || "";

            if (descEl) {
                const desc = itemData.description || itemData.desc || "";
                if (desc && String(desc).trim() !== "") {
                    descEl.innerHTML = desc;
                    descEl.style.display = "";
                } else {
                    descEl.innerHTML = "";
                    descEl.style.display = "none";
                }
            }
        }

        showAsset(assetContainer, resourceId, scope);

        if (window.Livewire && assetContainer) {
            const componentEl = assetContainer.querySelector("[wire\\:id]");
            if (componentEl) {
                const componentId = componentEl.getAttribute("wire:id");
                window.Livewire.find(componentId).call(
                    "setCategoryId",
                    resourceId,
                );
            }
        }
    });

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" || e.key === "Esc") {
            document.querySelectorAll(".asset-container").forEach(hideAsset);
            document
                .querySelectorAll(".resource-item")
                .forEach((el) => (el.style.visibility = ""));
        }
    });
})();
