@extends('backend.layout.app')

@section('content')
{!! html()->form()->method('POST')->action(route('product.store'))->attribute('enctype','multipart/form-data')->open() !!}

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Yeni Ürün Ekle</h2>
            </div>
            <div class="col-auto ms-auto">
                <div class="btn-list">
                    <a href="{{ route('product.index') }}" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" /></svg>
                        Geri
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                        Kaydet
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-9 mb-3">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                    @foreach($language as $lang)
                        <li class="nav-item" role="presentation">
                            <a href="#{{ $lang->lang }}" class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab">
                                {{ strtoupper($lang->lang) }}
                            </a>
                        </li>
                    @endforeach
                    <li class="nav-item" role="presentation">
                        <a href="#properties" class="nav-link" data-bs-toggle="tab">
                            Özellikler
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="card-body">
                <div class="tab-content">
                    @foreach($language as $lang)
                        <div class="tab-pane @if($loop->first) active show @endif" id="{{ $lang->lang }}" role="tabpanel">
                            <div class="form-group mb-3">
                                <label class="form-label">Ürün Adı</label>
                                <input type="text" name="{{ $lang }}[name]" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">SEO URL</label>
                                <input type="text" name="{{ $lang }}[slug]" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Kısa Açıklama</label>
                                <textarea name="{{ $lang }}[short_description]" rows="3" class="form-control"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Detaylı Açıklama</label>
                                <textarea name="{{ $lang }}[description]" rows="5" class="form-control"></textarea>
                            </div>
                            
                            <div class="hr-text">SEO Bilgileri</div>
                            
                            <div class="form-group mb-3">
                                <label class="form-label">SEO Başlık</label>
                                <input type="text" name="{{ $lang }}[seoTitle]" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">SEO Açıklama</label>
                                <textarea name="{{ $lang }}[seoDesc]" rows="2" class="form-control"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">SEO Anahtar Kelimeler</label>
                                <input type="text" name="{{ $lang }}[seoKey]" class="form-control">
                            </div>
                        </div>
                    @endforeach

                    <div class="tab-pane" id="properties" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Ürün Tipi</label>
                                    <select name="type" class="form-select" id="product-type">
                                        <option value="1">Basit Ürün</option>
                                        <option value="2">Varyasyonlu Ürün</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Marka</label>
                                    <select name="brand_id" class="form-select">
                                        <option value="">Marka Seçin</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div id="simple-product-fields">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">SKU</label>
                                        <input type="text" name="sku" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Fiyat</label>
                                        <input type="number" name="price" step="0.01" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Stok</label>
                                        <input type="number" name="stock" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="manage_stock">
                                            <span class="form-check-label">Stok Yönetimi</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="status" checked>
                                            <span class="form-check-label">Aktif</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @livewire('variation-manager')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Görseller</h3>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label">Ana Görsel</label>
                    <input type="file" class="form-control" name="image">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Galeri</label>
                    <input type="file" class="form-control" name="gallery[]" multiple>
                </div>
            </div>
        </div>
    </div>
</div>

{!! html()->form()->close() !!}
@endsection

@push('scripts')
<script src="{{ asset('js/product-variation.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Slug oluşturma
        document.querySelectorAll('input[name$="[name]"]').forEach(input => {
            input.addEventListener('input', function() {
                const lang = this.name.match(/^(\w+)\[/)[1];
                const slugInput = document.querySelector(`input[name="${lang}[slug]"]`);
                if (slugInput) {
                    slugInput.value = this.value
                        .toLowerCase()
                        .replace(/[^\w\s-]/g, '')
                        .replace(/\s+/g, '-');
                }
            });
        });

        // Ürün tipi değiştiğinde
        const productTypeSelect = document.getElementById('product-type');
        if (productTypeSelect) {
            productTypeSelect.addEventListener('change', function() {
                const isVariable = this.value === '2'; // 2: Variable, 1: Simple
                const simpleFields = document.getElementById('simple-product-fields');
                const variableFields = document.querySelector('.variable-product-fields');
                
                if (simpleFields) {
                    simpleFields.style.display = isVariable ? 'none' : 'block';
                }
                
                if (variableFields) {
                    variableFields.style.display = isVariable ? 'block' : 'none';
                }
                
                // Livewire bileşenine bildir
                if (window.Livewire) {
                    Livewire.dispatch('productTypeChanged', { type: isVariable ? '2' : '1' });
                }
            });
            
            // Sayfa yüklendiğinde mevcut seçime göre göster/gizle
            const isVariable = productTypeSelect.value === '2';
            const simpleFields = document.getElementById('simple-product-fields');
            const variableFields = document.querySelector('.variable-product-fields');
            
            if (simpleFields) {
                simpleFields.style.display = isVariable ? 'none' : 'block';
            }
            
            if (variableFields) {
                variableFields.style.display = isVariable ? 'block' : 'none';
            }
        }
    });
</script>
@endpush
