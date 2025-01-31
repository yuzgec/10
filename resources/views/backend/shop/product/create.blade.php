@extends('backend.layout.app')

@section('content')
{!! html()->form()->method('POST')->action(route('product.store'))->attribute('enctype','multipart/form-data')->open() !!}

<x-dashboard.crud.create-header route="product" name="Ürün"/>

<div class="row">
    <div class="col-md-9 mb-3">
        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <x-dashboard.crud.tab-menu :language="$languages">
                    <li class="nav-item" role="presentation">
                        <a href="#properties" class="nav-link" data-bs-toggle="tab">
                            <x-dashboard.icon.star/> @lang('Özellikler')
                        </a>
                    </li>
                </x-dashboard.crud.tab-menu>
            </div>
            
            <div class="card-body">
                @foreach($languages as $lang)
                <div class="tab-pane @if($loop->first) active show @endif" id="{{ $lang }}" role="tabpanel">
                    <div class="card">
                        <div class="card-status-top bg-blue"></div>
                        <div class="card-body">
                            <x-dashboard.form.input 
                                label="Ürün Adı" 
                                name="name:{{ $lang }}" 
                                placeholder="Ürün Adı Giriniz ({{ $lang }})" 
                                :value="old('name:'.$lang)"
                                required />
                            
                            <x-dashboard.form.text-area 
                                label="Kısa Açıklama" 
                                name="short:{{ $lang }}" 
                                :value="old('short:'.$lang)" />
                            
                            <x-dashboard.form.text-area 
                                label="Açıklama" 
                                name="desc:{{ $lang }}" 
                                id="desc-{{ $lang }}"
                                :value="old('desc:'.$lang)" />
                        </div>
                    </div>
                    <x-dashboard.site.seo :lang="$lang" />
                </div>
                @endforeach

                <!-- Özellikler Sekmesi -->
                <div class="tab-pane" id="properties" role="tabpanel">
                    <div class="card">
                        <div class="card-status-top bg-blue"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <x-dashboard.form.only-number-input 
                                        name="price" 
                                        label="Fiyat" 
                                        :value="old('price')"
                                        required />
                                </div>
                                <div class="col-md-4">
                                    <x-dashboard.form.only-number-input 
                                        name="stock" 
                                        label="Stok Miktarı" 
                                        :value="old('stock')" />
                                </div>
                                <div class="col-md-4">
                                    <x-dashboard.form.only-number-input 
                                        name="weight" 
                                        label="Ağırlık (kg)" 
                                        :value="old('weight')" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Medya Yönetimi -->
        <div class="card mb-3">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h3 class="card-title">@lang('Görsel Yönetimi')</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <x-dashboard.form.file-upload 
                            label="Ana Görsel" 
                            name="image" 
                            required
                            accept="image/*" />
                    </div>
                    <div class="col-md-6">
                        <x-dashboard.form.file-upload 
                            label="Galeri" 
                            name="gallery[]" 
                            multiple
                            accept="image/*" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sağ Sidebar -->
    <div class="col-md-3">
        <!-- Kategoriler -->
        <div class="card mb-3">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h3 class="card-title">@lang('Kategoriler')</h3>
            </div>
            <div class="card-body">
                <livewire:category-manager :selected="[]" />
            </div>
        </div>

        <!-- Diğer Ayarlar -->
        <div class="card mb-3">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h3 class="card-title">@lang('Ayarlar')</h3>
            </div>
            <div class="card-body">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="status" id="status" checked>
                    <label class="form-check-label" for="status">@lang('Aktif')</label>
                </div>
                
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="featured" id="featured">
                    <label class="form-check-label" for="featured">@lang('Öne Çıkan')</label>
                </div>
            </div>
        </div>

        <!-- Özel Alanlar -->
        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h3 class="card-title">@lang('Özel Alanlar')</h3>
            </div>
            <div class="card-body">
                <x-dashboard.form.only-number-input 
                    name="warranty" 
                    label="Garanti Süresi (Ay)" 
                    :value="old('warranty')" />
                
                <x-dashboard.form.only-input 
                    name="barcode" 
                    label="Barkod" 
                    :value="old('barcode')" />
            </div>
        </div>
    </div>
</div>

{!! html()->form()->close() !!}
@endsection

@push('scripts')
@include('backend.layout.ck')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // CKEditor Initialization
    @foreach($languages as $lang)
    ClassicEditor
        .create(document.querySelector('#desc-{{ $lang }}'))
        .catch(error => {
            console.error(error);
        });
    @endforeach
});
</script>
@endpush 