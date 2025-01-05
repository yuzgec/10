@extends('backend.layout.app')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    <x-dashboard.icon.history/> Sistem Aktiviteleri
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <form action="{{ route('dashboard.activities.clear') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-danger mb-1" 
                            onclick="return confirm('Tüm aktivite kayıtları silinecek. Emin misiniz?')">
                        <x-dashboard.icon.delete/>
                        Temizle
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                    <thead>
                        <tr>
                            <th>İşlem</th>
                            <th>Model</th>
                            <th>Detaylar</th>
                            <th>Kullanıcı</th>
                            <th>IP</th>
                            <th>Tarih</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activities as $activity)
                            <tr id="activity-{{ $activity->id }}">
                                <td>
                                    <span class="badge bg-{{ $activity->description == 'created' ? 'green' : ($activity->description == 'updated' ? 'blue' : 'red') }}-lt">
                                        {{ $activity->description }}
                                    </span>
                                </td>
                                <td>
                                    <div class="text-secondary">
                                        {{ class_basename($activity->subject_type) ?? 'Silinmiş' }}
                                        @if($activity->subject)
                                            #{{ $activity->subject_id }}
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if(isset($activity->properties['attributes']))
                                        <details>
                                            <summary>Değişiklikleri Göster</summary>
                                            <div class="mt-2">
                                                @foreach($activity->properties['attributes'] as $key => $value)
                                                    @if(isset($activity->properties['old'][$key]) && $activity->properties['old'][$key] !== $value)
                                                        <div class="mb-1">
                                                            <strong>{{ $key }}:</strong>
                                                            <span class="text-danger">{{ $activity->properties['old'][$key] ?: 'Boş' }}</span>
                                                            →
                                                            <span class="text-success">{{ $value ?: 'Boş' }}</span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </details>
                                    @endif
                                </td>
                                <td>
                                    @if($activity->causer)
                                        <div class="d-flex align-items-center">
                                            <span class="avatar avatar-xs me-2" style="background-image: url({{ $activity->causer->profile_photo_url }})"></span>
                                            {{ $activity->causer->name }}
                                        </div>
                                    @else
                                        Sistem
                                    @endif
                                </td>
                                <td>{{ $activity->properties['ip'] ?? '-' }}</td>
                                <td>
                                    <div class="text-secondary" title="{{ $activity->created_at }}">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td>
                                   
                                        <button type="button" 
                                                class="btn btn-danger btn-sm"
                                                onclick="deleteActivity({{ $activity->id }})">
                                            <x-dashboard.icon.delete/>
                                        </button>
                                  
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Henüz aktivite kaydı bulunmuyor</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $activities->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function deleteActivity(id) {
    if (confirm('Bu aktivite kaydını silmek istediğinize emin misiniz?')) {
        fetch(`/dashboard/activities/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`activity-${id}`).remove();
                toastr.success(data.message);
            } else {
                toastr.error(data.message);
            }
        })
        .catch(error => {
            toastr.error('Bir hata oluştu');
        });
    }
}
</script>
@endpush
@endsection 