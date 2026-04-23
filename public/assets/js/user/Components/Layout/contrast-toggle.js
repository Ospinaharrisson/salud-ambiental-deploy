document.getElementById("toggle-contrast").addEventListener("click", () => {
  document.body.classList.toggle("app-contrast");
        
  if (document.body.classList.contains("app-contrast")) {
    localStorage.setItem("theme", "dark");
  } else {
    localStorage.setItem("theme", "light");
  }
});

window.addEventListener("DOMContentLoaded", () => {
  if (localStorage.getItem("theme") === "dark") {
    document.body.classList.add("app-contrast");
  }
});