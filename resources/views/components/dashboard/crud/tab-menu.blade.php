@props(['language', 'image' => true])
<ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist" id="tab-menu">
    @foreach($language as $lang)
    <li class="nav-item" role="presentation">
        <a href="#{{ $lang->lang }}" class="nav-link @if ($loop->first) active @endif" data-bs-toggle="tab">
            <img src="/flags/{{ $lang->lang }}.svg" width="20px"><span  style="margin-left:10px">{{ $lang->native }}</span>
        </a>
    </li>
    @endforeach
    @if($image)
    <li class="nav-item" role="presentation">
        <a href="#image" class="nav-link" data-bs-toggle="tab">
            <span  style="margin-left:10px"><x-dashboard.icon.image/> Medya</span>
        </a>
    </li>
    @endif
    {{ $slot }}
</ul>
