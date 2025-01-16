@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">İş Listesi</h4>
                <div class="page-title-right">
                    @if(!auth()->user()->google_calendar_token)
                        <a href="{{ route('calendar.connect') }}" class="btn btn-info me-2">
                            <i class="fas fa-calendar"></i> Google Calendar'a Bağlan
                        </a>
                    @else
                        <a href="{{ route('calendar.disconnect') }}" class="btn btn-warning me-2">
                            <i class="fas fa-unlink"></i> Google Calendar Bağlantısını Kes
                        </a>
                    @endif
                    <a href="{{ route('customer-works.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Yeni İş Ekle
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->google_calendar_connected_at)
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    Google Calendar bağlantısı aktif
                    @if(auth()->user()->google_calendar_connected_at)
                        ({{ auth()->user()->google_calendar_connected_at->format('d.m.Y H:i') }})
                    @endif
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Müşteri</th>
                                    <th>Teklif No</th>
                                    <th>Başlangıç</th>
                                    <th>Teslim</th>
                                    <th>İlerleme</th>
                                    <th>Durum</th>
                                    <th>Ödeme Durumu</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($works as $work)
                                    <tr>
                                        <td>{{ $work->id }}</td>
                                        <td>
                                            {{ $work->customer->company_name }}
                                            <br>
                                            <small class="text-muted">{{ $work->customer->website1 }}</small>
                                        </td>
                                        <td>
                                            {{ $work->offer->offer_no }}
                                            @if($work->offer->name)
                                                <br>
                                                <small class="text-muted">{{ $work->offer->name }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $work->start_date->format('d.m.Y') }}</td>
                                        <td>{{ $work->delivery_date->format('d.m.Y') }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $work->progress }}%">
                                                    {{ $work->progress }}%
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge text-white p-2 bg-{{ $work->status->color() }}">
                                                {{ $work->status->title() }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="badge text-white p-2 bg-{{ $work->payment_status->color() }} mb-1">
                                                    {{ $work->payment_status->title() }}
                                                </span>
                                                <small class="text-muted">{{ $work->payment_status_text }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('customer-works.show', $work) }}" 
                                               class="btn btn-sm btn-info">
                                                <x-dashboard.icon.eye/>
                                            </a>
                                            <a href="{{ route('customer-works.edit', $work) }}" 
                                               class="btn btn-sm btn-primary">
                                                <x-dashboard.icon.edit/>
                                            </a>
                                            <form action="{{ route('customer-works.destroy', $work) }}" 
                                                  method="POST" 
                                                  class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Emin misiniz?')">
                                                    <x-dashboard.icon.trash/>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Henüz iş kaydı bulunmuyor</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        {{ $works->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 