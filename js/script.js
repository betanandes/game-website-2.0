document.addEventListener('DOMContentLoaded', function () {
    const themeToggle = document.getElementById('theme-toggle');
    let isDarkMode = false;

    themeToggle.addEventListener('click', function () {
        isDarkMode = !isDarkMode;
        document.body.classList.toggle('dark-mode', isDarkMode);

        if (isDarkMode) {
            themeToggle.src = 'midia/dark-mode.gif'; 
            
            themeToggle.alt = 'Switch to light mode';
        } else {
            themeToggle.src = 'midia/light-mode-icon.gif'; 
           
            themeToggle.alt = 'Switch to dark mode';
        }
    });
});
