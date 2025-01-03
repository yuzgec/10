@props(['model', 'route', 'name', 'action'])
<div class="col-12 mb-3">
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">{{$name}} Düzenle [{{ $model->name }}]</h3>
            <div class="card-actions d-flex">
                
                <div class="p-1">
                    <a href="{{ route($route.'.index')}}" class="btn btn-outline-dark" title="Geri Dön">
                        <x-dashboard.icon.back/>
                        Geri
                    </a>
                </div>
                
                {{ $slot }}
               
                <div class="p-1">
                    <button type="submit" title="Formu Kaydet" class="btn btn-primary">
                        <x-dashboard.icon.save/>
                        Kaydet
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>