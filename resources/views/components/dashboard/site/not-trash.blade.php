<div class="empty">
    <div class="empty-img"></div>
    <span><x-dashboard.icon.delete/></span>
    <p class="empty-title">Sonuç Bulunamadı</p>
    <p class="empty-subtitle text-secondary">
      Silinmiş sayfa bulunmamaktadır
    </p>
    <div class="empty-action">
        <a href="{{ route($route.'.index')}}" class="btn btn-primary">
            <x-dashboard.icon.back/>
            Listeye Geri Dön
        </a>
    </div>
</div>