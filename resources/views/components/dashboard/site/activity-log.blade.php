@props(['activities'])

<div class="card mt-3">
    <div class="card-status-top bg-primary"></div>
    <div class="card-header">
        <h3 class="card-title">
            <x-dashboard.icon.history/> Değişiklik Geçmişi
        </h3>
    </div>
    <div class="card-body card-body-scrollable card-body-scrollable-shadow" style="max-height:500px">
        @forelse($activities as $date => $logs)
            <div class="divide-y">
                <div class="activity-group mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <span class="avatar avatar-sm me-2" style="background-image: url({{ optional($logs->first()->causer)->profile_photo_url ?? '/backend/avatar.png' }})"></span>
                        <div>
                            <strong>{{ optional($logs->first()->causer)->name ?? 'Sistem' }}</strong>
                            <div class="text-muted small">
                                {{ \Carbon\Carbon::parse($date)->format('d.m.Y H:i') }}
                                ({{ \Carbon\Carbon::parse($date)->diffForHumans() }})
                            </div>
                        </div>
                    </div>

                    @foreach($logs as $activity)
                        <div class="activity-item ms-4 mb-3">
                            <div class="border-start border-2 ps-3 mt-2">
                                @if(isset($activity->properties['old']) && isset($activity->properties['attributes']))
                                    @foreach($activity->properties['attributes'] as $key => $value)
                                        @php
                                            $customNames = $activity->subject?->getCustomAttributeNames() ?? [];
                                            $fieldName = $customNames[$key] ?? ucfirst($key);
                                        @endphp
                                        @if(isset($activity->properties['old'][$key]) && $activity->properties['old'][$key] !== $value)
                                            <div class="mb-2">
                                                <div class="fw-bold text-muted">{{ $fieldName }}</div>
                                                <div class="d-flex gap-2 align-items-center">
                                                    <div class="text-danger bg-danger-lt px-2 py-1 rounded">
                                                        <small>{{ $activity->properties['old'][$key] ?: 'Boş' }}</small>
                                                    </div>
                                                    <div>
                                                        <x-dashboard.icon.right-arrow class="text-muted"/>
                                                    </div>
                                                    <div class="text-success bg-success-lt px-2 py-1 rounded">
                                                        <small>{{ $value ?: 'Boş' }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                                <div class="mt-2">
                                    <span class="badge bg-blue-lt">
                                        {{ $activity->description }}
                                    </span>
                                    <span class="badge bg-purple-lt">
                                        {{ optional($activity->causer)->email ?? 'Sistem' }}
                                    </span>
                                    <span class="badge bg-yellow-lt">
                                        IP: {{ $activity->properties['ip'] ?? 'Bilinmiyor' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="text-center text-muted">
                <x-dashboard.icon.alert-triangle class="mb-2"/>
                <div>Henüz değişiklik geçmişi bulunmuyor.</div>
            </div>
        @endforelse
    </div>
</div>