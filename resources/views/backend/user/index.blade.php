@extends('backend.layout.app') @section('content')

<div class="page-header d-print-none">
    <div class="col-12 d-flex justify-content-between mb-3">
        <x-dashboard.site.title title='Kullanıcı Listesi'/>
    </div>
</div>

<div class="row">
    @foreach ($all as $item)
    <div class="col-md-3 mb-2">
        <div class="card">
            <div class="card-body p-4 text-center">
                <span
                    class="avatar avatar-xl mb-3 rounded"
                    style="background-image: url(./static/avatars/000m.jpg)">OY</span>
                <h3 class="m-0 mb-1">
                    <a href="{{ route('user.edit', $item->id)}}">{{ $item->name}}</a>
                </h3>
                <div class="text-secondary">{{ $item->email}}</div>
                <div class="mt-3">
                    @if($item->roles->isNotEmpty())
                        <span class="badge bg-primary text-white">
                            @foreach($item->roles as $role)
                               {{ $role->name }}
                            @endforeach
                        </span>
                    @else
                    <span class="badge bg-red text-white">
                        Rol Yok
                    </span>
                    @endif
                </div>
            </div>
            <div class="d-flex">
                <a href="mailto:{{ $item->email}}" class="card-btn">
                    <x-dashboard.icon.envelope/>
                    Email</a>
                <a href="tel:{{ $item->phone}}" class="card-btn">
                    <x-dashboard.icon.phone/>
                    Ara</a>
            </div>
        </div>
    </div>

    @endforeach
</div>

@endsection
