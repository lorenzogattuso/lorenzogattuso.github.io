const themeSwitch = document.getElementById('themeSwitch');
const darkElements = document.querySelectorAll('.about-me, .what-im-doing, .works');

themeSwitch.addEventListener('change', () => {
    // Cambio del tema globale
    document.body.classList.toggle('dark-theme');
    
    // Cambio del wallpaper
    if (document.body.classList.contains('dark-theme')) {
        document.body.style.backgroundImage = "url('dark_wallpaper.webp')";
    } else {
        document.body.style.backgroundImage = "url('light_wallpaper.webp')";
    }
});
