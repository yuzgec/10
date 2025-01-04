@extends('backend.layout.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Yeni Ürün Özelliği</h3>
                <div class="card-actions">
                    <a href="{{ route('product-attributes.index') }}" class="btn btn-primary">
                        <x-dashboard.icon.back /> Geri
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('product-attributes.store') }}" method="POST">
                    @csrf

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
                                                           class="form-control @error("name.$locale") is-invalid @enderror" 
                                                           value="{{ old("name.$locale") }}" 
                                                           required>
                                                    @error("name.$locale")
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Özellik Tipi -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Özellik Tipi</label>
                                <select name="type" class="form-select" id="attribute-type">
                                    @foreach(App\Enums\ProductAttributeType::cases() as $type)
                                        <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Değerler -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Özellik Değerleri</h3>
                            <div class="card-actions">
                                <button type="button" class="btn btn-primary" id="add-value">
                                    <x-dashboard.icon.add /> Değer Ekle
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="values-container">
                                <!-- JavaScript ile değerler buraya eklenecek -->
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('values-container');
        const addButton = document.getElementById('add-value');
        const typeSelect = document.getElementById('attribute-type');
        let valueCount = 0;

        function addValueField() {
            const isColor = typeSelect.value === 'color';
            const wrapper = document.createElement('div');
            wrapper.className = 'row mb-2 align-items-center';
            wrapper.innerHTML = `
                <div class="col">
                    <input type="text" name="values[]" class="form-control" placeholder="Değer" required>
                </div>
                ${isColor ? `
                    <div class="col-auto">
                        <input type="color" name="colors[]" class="form-control form-control-color" required>
                    </div>
                ` : ''}
                <div class="col-auto">
                    <button type="button" class="btn btn-icon btn-outline-danger" onclick="this.closest('.row').remove()">
                        <x-dashboard.icon.delete />
                    </button>
                </div>
            `;
            container.appendChild(wrapper);
            valueCount++;
        }

        addButton.addEventListener('click', addValueField);
        typeSelect.addEventListener('change', function() {
            container.innerHTML = '';
            valueCount = 0;
            addValueField();
        });

        // İlk değer alanını ekle
        addValueField();
    });
</script>
@endpush 