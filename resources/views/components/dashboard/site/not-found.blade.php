<div class="empty">
    <div class="empty-img"></div>
    <p class="empty-title">Sonuç Bulunamadı</p>
    <p class="empty-subtitle text-secondary">
      Henüz birşey eklenmemiş.
    </p>
    <div class="empty-action">
        <a href="{{ route($route.'.index')}}" class="btn btn-icon">
            <x-dashboard.icon.back/>
        </a>
        <a href="{{ route($route.'.create')}}" class="btn btn-icon btn-primary">
            <x-dashboard.icon.add/>
        </a>
    </div>
</div>