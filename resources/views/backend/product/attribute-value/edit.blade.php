@extends('backend.layout.app')

@section('content') 

{!! html()->modelForm($value, 'PUT', route('product-attribute-values.update', $value))->open() !!}

<x-dashboard.crud.edit-header route='product-attribute-values' name="Özellik Değeri" :model="$value"/>

<div class="col-12">
    <div class="card">
        <div class="card-status-top bg-primary"></div>
        <div class="card-body">
            
            <div class="mb-3">
                <label class="form-label">Özellik Seçimi</label>
                <select name="attribute_id" class="form-select" required>
                    <option value="">Özellik Seçiniz</option>
                    @foreach($attributes as $attribute)
                        <option value="{{ $attribute->id }}" 
                                {{ $value->attribute_id == $attribute->id ? 'selected' : '' }}>
                            {{ $attribute->translate('tr')->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        @foreach($language as $lang)
                            <li class="nav-item">
                                <a href="#{{ $lang->lang }}" 
                                   class="nav-link {{ $loop->first ? 'active' : '' }}"
                                   data-bs-toggle="tab" 
                                   role="tab">
                                    <img src="/flags/{{ $lang->lang }}.svg" alt="{{ $lang->lang }}" style="margin-right: 5px;"> 
                                    <b>{{ strtoupper($lang->lang) }}</b>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        @foreach($language as $lang)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                                 id="{{ $lang->lang }}" 
                                 role="tabpanel">
                                <div class="mb-3">
                                    <label class="form-label">Değer Adı ({{ strtoupper($lang->lang) }})</label>
                                    <input type="text" 
                                           name="name[{{ $lang->lang }}]" 
                                           class="form-control"
                                           value="{{ $value->translate($lang->lang)->name ?? '' }}"
                                           required>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Renk Kodu</label>
                        <div class="input-group">
                            <input type="color" 
                                   name="color_code" 
                                   class="form-control form-control-color" 
                                   value="{{ $value->color_code ?? '#ffffff' }}">
                            <input type="text" 
                                   class="form-control" 
                                   id="colorHexCode" 
                                   value="{{ $value->color_code ?? '#ffffff' }}"
                                   placeholder="#ffffff">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Sıralama</label>
                        <input type="number" 
                               name="rank" 
                               class="form-control" 
                               value="{{ $value->rank ?? 0 }}" 
                               min="0">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-check form-switch">
                    <input type="checkbox" 
                           class="form-check-input" 
                           name="status" 
                           value="1"
                           {{ $value->status ? 'checked' : '' }}>
                    <span class="form-check-label">Aktif</span>
                </label>
            </div>

        </div>
    </div>
</div>

{!! html()->closeModelForm() !!}

@push('scripts')
<script>
    document.querySelector('input[type="color"]').addEventListener('input', function(e) {
        document.querySelector('#colorHexCode').value = e.target.value;
    });
    
    document.querySelector('#colorHexCode').addEventListener('input', function(e) {
        document.querySelector('input[type="color"]').value = e.target.value;
    });
</script>
@endpush

@endsection 