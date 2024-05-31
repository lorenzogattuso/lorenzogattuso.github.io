document.getElementById('theme-toggle').addEventListener('change', function() {
    document.body.classList.toggle('dark-mode');
});
const toggle = document.getElementById('themeToggle');
toggle.addEventListener('change', () => {
    document.body.classList.toggle('dark-mode');
});
document.addEventListener("DOMContentLoaded", function() {
    const path = window.location.pathname;
    const currentPage = path.split("/").pop().split(".")[0];
    const buttons = document.querySelectorAll(".categories button");
    
    buttons.forEach(button => {
        button.addEventListener("click", () => {
            buttons.forEach(btn => btn.classList.remove("active"));
            button.classList.add("active");
        });
    });

    const setActiveButton = () => {
        buttons.forEach(btn => btn.classList.remove("active"));
        const currentButton = document.getElementById(currentPage);
        if (currentButton) {
            currentButton.classList.add("active");
        }
    };

    setActiveButton();
});