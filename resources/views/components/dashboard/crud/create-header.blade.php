@props(['name', 'route'])
<div class="col-12 mb-3">
    <div class="card">
        <div class="card-status-top bg-blue"></div>
        <div class="card-header">
            <h3 class="card-title"><x-dashboard.icon.add/> {{$name}} Oluştur</h3>
            <div class="card-actions d-flex">
                <div class="p-1">
                    <a href="{{ route($route.'.index')}}" class="btn btn-outline-dark" title="Geri">
                        <x-dashboard.icon.back/>
                        Geri
                    </a>
                </div>
                <div class="p-1">
                    <button type="submit" title="Sayfa Oluştur" class="btn btn-primary">
                        <x-dashboard.icon.save/>
                        Kaydet
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>