@props(['all', 'category', 'route','name'])

<div class="card-header">
    <h3 class="card-title">{{$name}} [{{ $all->total()}}]</h3>
    <div class="card-actions d-flex">
        <div class="d-none d-sm-inline-block p-1">
            <form>
                <div class="input-icon mb-3">
                    <input type="text" class="form-control" name="q" placeholder="Arama" value="{{ request('q')}}">
                    <span class="input-icon-addon">
                        <x-dashboard.icon.search/>
                    </span>
                </div>
            </form>
        </div>
        
        <x-dashboard.filter.category-filter :slug="$category"/>

        @if(request('q'))
        <div class="p-1">
            <a href="{{ route($route.'.index')}}" class="btn btn-icon" title="Sayfayı Yenile">
                <x-dashboard.icon.refresh/>
            </a>
        </div>
        @endif
        <div class="p-1">
            <a href="{{ route($route.'.index')}}" class="btn btn-icon">
                <x-dashboard.icon.back/>
            </a>
        </div>
        <div class="p-1">
            <a href="{{ route($route.'.create')}}" title="Sayfa Oluştur" class="btn btn-icon" >
                <x-dashboard.icon.add/>
            </a>
        </div>

    </div>
</div>