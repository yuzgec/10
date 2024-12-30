@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h3 class="card-title">Çeviriler</h3>
                <div class="card-actions d-flex">
                    <div class="p-1">
                        <a href="{{ route('translation.create')}}" title="Sayfa Oluştur" class="btn btn-primary">
                            <x-dashboard.icon.add/>
                            Ekle
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Tab Başlıkları -->
                <ul class="nav nav-tabs" id="languageTabs" role="tablist" id="tab-menu">
                    @foreach ($locales as $index => $locale)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $index === 0 ? 'active' : '' }}" 
                                    id="tab-{{ $locale }}" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#content-{{ $locale }}" 
                                    type="button" 
                                    role="tab" 
                                    aria-controls="content-{{ $locale }}" 
                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                    <img src="/flags/{{ $locale }}.svg" width="20px" style="margin-right: 5px"> 
                                <b>{{ strtoupper($locale) }}</b>
                            </button>
                        </li>
                    @endforeach
                </ul>
                
                <!-- Tab İçerikleri -->
                <div class="tab-content mt-3" id="languageTabContent">
                    @foreach ($locales as $index => $locale)
                        <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" 
                            id="content-{{ $locale }}" 
                            role="tabpanel" 
                            aria-labelledby="tab-{{ $locale }}">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Group</th>
                                            <th>Key</th>
                                            <th>Value ({{ strtoupper($locale) }})</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all as $translation)
                                            @if (isset($translation->text[$locale]))
                                                <tr>
                                                    <td>{{ $translation->group }}</td>
                                                    <td>{{ $translation->key }}</td>
                                                    <td>{{ $translation->text[$locale] }}</td>
                                                    <td>
                                                        <!-- Düzenle Butonu -->
                                                        <a 
                                                                href="{{ route('translation.edit', $translation->id)}}">
                                                                <x-dashboard.icon.edit/>
                                                    </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('customJS')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const translationId = button.getAttribute('data-id');

            // AJAX İsteği ile Çeviri Bilgilerini Getir
            fetch(`/translations/${translationId}`)
                .then(response => response.json())
                .then(data => {
                    // Modal içindeki alanları doldur
                    document.getElementById('editId').value = data.id;
                    document.getElementById('editGroup').value = data.group;
                    document.getElementById('editKey').value = data.key;

                    @foreach ($locales as $locale)
                        document.getElementById('text-{{ $locale }}').value = data.text['{{ $locale }}'] || '';
                    @endforeach
                });
        });
    });
</script>
@endsection