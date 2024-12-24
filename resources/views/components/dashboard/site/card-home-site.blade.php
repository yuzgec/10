@props(['model', 'count', 'icon', 'name','color' => 'primary','size' => 4])
@php $componentName = "dashboard.icon.$icon" @endphp
<div class="col-sm-{{ $size}} col-12 mt-2">
    <div class="card card-link card-link-pop bg-{{ $color}}-lt">
        <div class="card-stamp">
            <div class="card-stamp-icon bg-primary">
                <x-dynamic-component :component="$componentName" width="42" height="42" />
            </div>
        </div>
        <div class="card-status-bottom bg-{{ $color}}"></div>
        <div class="card-body p-2 text-center ">
            <div class="mt-2 text-{{ $color}}">
                @if ($count > 0) [{{$count}}] @endif 
                {{$name}}
            </div>                         
        </div>
        <div class="card-footer text-center">
            <a href="{{ route($model.'.index')}}" class="btn btn-icon" title="{{$name}} Listele">
                <x-dashboard.icon.menu-list width="16" height="16"/>
            </a>
            <a href="{{ route($model.'.create')}}" class="btn btn-icon btn-{{ $color}}" title="{{$name}} Ekle">
                <x-dashboard.icon.add width="16" height="16"/>
            </a>
        </div>
    </div>
</div>