const toggle = document.getElementById("toggle-contrast");

if (toggle) {
  toggle.addEventListener("click", () => {
    const root = document.documentElement;

    root.classList.toggle("app-contrast");

    if (root.classList.contains("app-contrast")) {
      localStorage.setItem("theme", "dark");
    } else {
      localStorage.setItem("theme", "light");
    }
  });
}