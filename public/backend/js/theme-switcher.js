class ThemeSwitcher {
    constructor() {
        this.theme = localStorage.getItem('tablerTheme') || 'light';
        this.darkButton = document.querySelector('.hide-theme-dark');
        this.lightButton = document.querySelector('.hide-theme-light');
        
        this.init();
    }

    init() {
        this.applyTheme(this.theme);

        this.darkButton.addEventListener('click', (e) => {
            e.preventDefault();
            this.toggleTheme('dark');
        });

        this.lightButton.addEventListener('click', (e) => {
            e.preventDefault();
            this.toggleTheme('light');
        });
    }

    toggleTheme(newTheme) {
        this.theme = newTheme;
        this.applyTheme(newTheme);
        localStorage.setItem('tablerTheme', newTheme);
    }

    applyTheme(theme) {
        if (theme === 'dark') {
            document.body.setAttribute('data-bs-theme', 'dark');
            this.darkButton.style.cssText = 'display: none !important';
            this.lightButton.style.cssText = 'display: flex !important';
            this.lightButton.classList.add('show');
        } else {
            document.body.removeAttribute('data-bs-theme');
            this.darkButton.style.cssText = 'display: flex !important';
            this.lightButton.style.cssText = 'display: none !important';
            this.lightButton.classList.remove('show');
        }
    }
}

// Sayfa yüklendiğinde başlat
document.addEventListener('DOMContentLoaded', () => {
    new ThemeSwitcher();
}); 
