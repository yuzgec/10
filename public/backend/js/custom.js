//Tabbart Aktif 

document.addEventListener('DOMContentLoaded', function () {
    // Aktif tab'ı localStorage'dan al
    const activeTab = localStorage.getItem('activeTab');
    const currentPath = window.location.pathname;
    const storedPath = localStorage.getItem('currentPath');

    // Eğer aynı sayfadaysak (sayfa yenilenmişse) tab'ı uygula
    if (activeTab && currentPath === storedPath) {
        // Mevcut aktif tab'ı kaldır
        document.querySelectorAll('#tab-menu .nav-link').forEach(link => {
            link.classList.remove('active');
        });
        document.querySelectorAll('.tab-pane').forEach(pane => {
            pane.classList.remove('active', 'show');
        });

        // Kaydedilen tab'ı aktif yap
        const tabLink = document.querySelector(`a[href="${activeTab}"]`);
        const tabContent = document.querySelector(activeTab);
        
        if (tabLink && tabContent) {
            tabLink.classList.add('active');
            tabContent.classList.add('active', 'show');
        }
    } else {
        // Farklı bir sayfaya geçilmişse localStorage'ı temizle
        localStorage.removeItem('activeTab');
    }

    // Mevcut sayfa yolunu kaydet
    localStorage.setItem('currentPath', currentPath);

    // Tab değişikliklerini dinle ve kaydet
    document.querySelectorAll('#tab-menu .nav-link').forEach(link => {
        link.addEventListener('click', function () {
            localStorage.setItem('activeTab', this.getAttribute('href'));
        });
    });
});