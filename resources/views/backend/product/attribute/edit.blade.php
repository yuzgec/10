@extends('backend.layout.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ürün Özelliği Düzenle</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('product-attributes.update', $attribute->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Özellik Adı (Çoklu Dil) -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                        @foreach(config('app.locales') as $locale)
                                            <li class="nav-item">
                                                <a href="#{{ $locale }}" class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab">
                                                    {{ strtoupper($locale) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        @foreach(config('app.locales') as $locale)
                                            <div class="tab-pane {{ $loop->first ? 'active show' : '' }}" id="{{ $locale }}">
                                                <div class="mb-3">
                                                    <label class="form-label">Özellik Adı ({{ strtoupper($locale) }})</label>
                                                    <input type="text" 
                                                           name="name[{{ $locale }}]" 
                                                           class="form-control @error('name.'.$locale) is-invalid @enderror"
                                                           value="{{ old('name.'.$locale, $attribute->translate($locale)?->name) }}" 
                                                           required>
                                                    @error('name.'.$locale)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Özellik Ayarları -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Özellik Tipi</label>
                                <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                    <option value="select" {{ $attribute->type == 'select' ? 'selected' : '' }}>Seçim Kutusu</option>
                                    <option value="color" {{ $attribute->type == 'color' ? 'selected' : '' }}>Renk</option>
                                    <option value="size" {{ $attribute->type == 'size' ? 'selected' : '' }}>Beden</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-check">
                                    <input type="checkbox" 
                                           name="is_filterable" 
                                           class="form-check-input"
                                           {{ $attribute->is_filterable ? 'checked' : '' }}>
                                    <span class="form-check-label">Filtrelenebilir</span>
                                </label>
                            </div>

                            <div class="mb-3">
                                <label class="form-check">
                                    <input type="checkbox" 
                                           name="is_required" 
                                           class="form-check-input"
                                           {{ $attribute->is_required ? 'checked' : '' }}>
                                    <span class="form-check-label">Zorunlu</span>
                                </label>
                            </div>
                        </div>

                        <!-- Özellik Değerleri -->
                        <div class="col-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Özellik Değerleri</h3>
                                </div>
                                <div class="card-body">
                                    <div id="values-container">
                                        @foreach($attribute->values as $value)
                                            <div class="row mb-2 value-row">
                                                <div class="col">
                                                    <input type="text" 
                                                           name="values[]" 
                                                           class="form-control"
                                                           value="{{ $value->value }}" 
                                                           required>
                                                </div>
                                                @if($attribute->type == 'color')
                                                    <div class="col">
                                                        <input type="color" 
                                                               name="colors[]" 
                                                               class="form-control form-control-color"
                                                               value="{{ $value->color_code }}" 
                                                               required>
                                                    </div>
                                                @endif
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-danger btn-icon remove-value">
                                                        <x-dashboard.icon.delete/>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-success mt-3" id="add-value">
                                        <x-dashboard.icon.add/> Yeni Değer Ekle
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('values-container');
            const addButton = document.getElementById('add-value');
            const type = document.querySelector('select[name="type"]');

            addButton.addEventListener('click', function() {
                const row = document.createElement('div');
                row.className = 'row mb-2 value-row';
                
                let html = `
                    <div class="col">
                        <input type="text" name="values[]" class="form-control" required>
                    </div>`;

                if (type.value === 'color') {
                    html += `
                        <div class="col">
                            <input type="color" name="colors[]" class="form-control form-control-color" required>
                        </div>`;
                }

                html += `
                    <div class="col-auto">
                        <button type="button" class="btn btn-danger btn-icon remove-value">
                            <x-dashboard.icon.delete/>
                        </button>
                    </div>`;

                row.innerHTML = html;
                container.appendChild(row);
            });

            container.addEventListener('click', function(e) {
                if (e.target.closest('.remove-value')) {
                    e.target.closest('.value-row').remove();
                }
            });

            type.addEventListener('change', function() {
                const rows = container.querySelectorAll('.value-row');
                rows.forEach(row => {
                    const colorColumn = row.querySelector('.col:nth-child(2)');
                    if (this.value === 'color') {
                        if (!colorColumn) {
                            const col = document.createElement('div');
                            col.className = 'col';
                            col.innerHTML = `
                                <input type="color" name="colors[]" class="form-control form-control-color" required>
                            `;
                            row.insertBefore(col, row.lastElementChild);
                        }
                    } else {
                        if (colorColumn) {
                            colorColumn.remove();
                        }
                    }
                });
            });
        });
    </script>
    @endpush
@endsection 