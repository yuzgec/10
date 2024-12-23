@props(['model'])
<div class="card-footer text-center">
    <a href="{{ route($model.'.index')}}" class="btn btn-icon" title="Listele">
        <x-dashboard.icon.menu-list width="16" height="16" />
    </a>
    <a href="{{ route($model.'.create')}}" class="btn btn-icon btn-primary" title="Ekle">
        <x-dashboard.icon.add width="16" height="16"/>
    </a>
</div>