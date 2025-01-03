@extends('backend.layout.app')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Route Listesi</h3>
            <div class="card-actions">
                <form action="{{ route('route.list') }}" method="GET" class="d-flex gap-2" data-action="search">
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Route adı, URI veya Controller ara..."
                           value="{{ $search }}">
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="10" cy="10" r="7" />
                            <line x1="21" y1="21" x2="15" y2="15" />
                        </svg>
                        Ara
                    </button>
                    @if($search)
                        <a href="{{ route('route.list') }}" class="btn btn-outline-secondary">
                            Temizle
                        </a>
                    @endif
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if(count($routes) > 0)
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Method</th>
                                <th>URI</th>
                                <th>Name</th>
                                <th>Action</th>
                                <th>Middleware</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($routes as $route)
                            <tr>
                                <td class="text-nowrap">
                                    @foreach(explode('|', $route['method']) as $method)
                                        @switch($method)
                                            @case('GET')
                                                <span class="badge text-white bg-green">GET</span>
                                                @break
                                            @case('POST')
                                                <span class="badge text-white bg-blue">POST</span>
                                                @break
                                            @case('PUT')
                                                <span class="badge text-white bg-yellow">PUT</span>
                                                @break
                                            @case('PATCH')
                                                <span class="badge text-white bg-orange">PATCH</span>
                                                @break
                                            @case('DELETE')
                                                <span class="badge text-white bg-red">DELETE</span>
                                                @break
                                            @default
                                                <span class="badge text-white bg-secondary">{{ $method }}</span>
                                        @endswitch
                                    @endforeach
                                </td>
                                <td>{{ $route['uri'] }}</td>
                                <td>
                                    @if($route['name'] && $route['name'] != '-')
                                        <span class="text-primary">{{ $route['name'] }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">{{ $route['action'] }}</small>
                                </td>
                                <td>
                                    @foreach(explode(', ', $route['middleware']) as $middleware)
                                        <span class="badge text-white bg-azure">{{ $middleware }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty">
                        <div class="empty-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <circle cx="10" cy="10" r="7" />
                                <line x1="21" y1="21" x2="15" y2="15" />
                            </svg>
                        </div>
                        <p class="empty-title">Sonuç bulunamadı</p>
                        <p class="empty-subtitle text-muted">
                            Arama kriterlerinize uygun route bulunamadı.
                        </p>
                        <div class="empty-action">
                            <a href="{{ route('route.list') }}" class="btn btn-primary">
                                Tüm Route'ları Göster
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table td {
        white-space: nowrap;
        vertical-align: middle;
    }
    .badge text-white {
        font-size: 0.75rem;
    }
</style>
@endpush 