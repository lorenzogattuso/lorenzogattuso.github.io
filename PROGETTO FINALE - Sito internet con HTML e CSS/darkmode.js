document.addEventListener("DOMContentLoaded", function() {
    const themeToggle = document.getElementById('themeToggle');
    const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");

    // Verifica se è già stato memorizzato uno stato di tema personalizzato
    const currentTheme = localStorage.getItem("theme");
    if (currentTheme) {
        document.body.classList.toggle('dark-mode', currentTheme === "dark");
        themeToggle.checked = currentTheme === "dark";
    } else {
        // Altrimenti, utilizza il tema preferito dal sistema
        document.body.classList.toggle('dark-mode', prefersDarkScheme.matches);
        themeToggle.checked = prefersDarkScheme.matches;
    }

    // Aggiungi un listener per il cambio di stato del toggle
    themeToggle.addEventListener('change', function() {
        if (this.checked) {
            document.body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark'); // Memorizza lo stato del tema
        } else {
            document.body.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light'); // Memorizza lo stato del tema
        }
    });
});
