@extends('backend.layout.app')

@section('content')
<div class="col-12 mb-3">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><x-dashboard.icon.log/> Sistem Logları</h3>
            <div class="card-actions">
                <form 
                    action="{{ route('logs.clear') }}"
                    method="POST"
                    class="d-inline"
                    data-action="delete" 
                    onsubmit="return confirm('Logları temizlemek istediğinize emin misiniz?')">
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Logları temizlemek istediğinize emin misiniz?')">
                        <x-dashboard.icon.delete/>
                        Logları Temizle
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th width="200">Tarih</th>
                            <th width="100">Seviye</th>
                            <th>Detay</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td>{{ $log['date']->format('d.m.Y H:i:s') }}</td>
                                <td>
                                    <span class="badge bg-{{ $log['level'] }} text-white">
                                        {{ strtoupper($log['level']) }}
                                    </span>
                                </td>
                                <td>
                                    <details>
                                        <summary>{{ Str::limit(strip_tags($log['content']), 200) }}</summary>
                                        <pre class="mt-2" style="white-space: pre-wrap;">{{ $log['content'] }}</pre>
                                    </details>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Log kaydı bulunamadı</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 