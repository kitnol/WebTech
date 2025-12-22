document.addEventListener("DOMContentLoaded", () => {
    const themes = ["purple", "blue", "green", "red"];
    const root = document.documentElement;
    const toggleLink = document.getElementById("theme-toggle");

    let currentTheme = localStorage.getItem("theme") || "purple";
    root.setAttribute("data-theme", currentTheme);

    toggleLink.addEventListener("click", (e) => {
        e.preventDefault(); // stop # navigation

        let index = themes.indexOf(currentTheme);
        currentTheme = themes[(index + 1) % themes.length];

        root.setAttribute("data-theme", currentTheme);
        localStorage.setItem("theme", currentTheme);
    });
});
