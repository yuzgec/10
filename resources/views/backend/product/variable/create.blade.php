@extends('backend.layout.app')
@section('content')
<div class="row">
    <div class="col-md-9">
        <div>
            <form action="{{ route('product.storeVariable') }}" method="POST">
                @csrf
                
                <div class="card">
                    <div class="card-status-top bg-blue"></div>
                    <div class="card-header">
                        <x-dashboard.crud.tab-menu :language='$language'></x-dashboard.crud.tab-menu>
                    </div>
                    
                    <div class="card-body">

                        @foreach($language as $lang)
                        <div class="tab-content">
                            <div class="tab-pane @if ($loop->first) active show @endif" id="{{$lang->lang}}" role="tabpanel">

                                <div class="card">
                                    <div class="card-status-top bg-blue"></div>
                                    <div class="card-body">
                                        <x-dashboard.form.input required="true" label='Ürün Adı' name='name:{{ $lang->lang }}' placeholder="Ürün Adı Giriniz ({{ $lang->native }})" maxlength="40"/>
                                        <x-dashboard.form.text-area label='Kısa Açıklama' name='short:{{ $lang->lang }}'/>
                                        <x-dashboard.form.text-area label='Açıklama' name='desc:{{ $lang->lang }}' id='desc'/>
                                    </div>
                                </div>

                                <x-dashboard.site.seo :lang="$lang" />

                            </div>       
                        </div>
                        @endforeach

                        <div class="tab-content">
                            <div class="tab-pane" id="image" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-stamp">
                                                <div class="card-stamp-icon bg-blue">
                                                    <x-dashboard.icon.image/>
                                                </div>
                                            </div>
                                            <div class="card-status-top bg-blue"></div>
                                            <div class="card-header">
                                                <h4 class="card-title"><x-dashboard.icon.image/>Image</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="image-preview-container">
                                                    <input 
                                                        type="file" 
                                                        class="image-preview-input" 
                                                        name="image" 
                                                        id="pageImageInput"
                                                        data-preview-target="pageImagePreview"
                                                        accept="image/*"
                                                    >
                                                    <img 
                                                        src="/backend/resimyok.jpg" 
                                                        id="pageImagePreview"
                                                        class="preview-image mb-2"
                                                        alt="Preview"
                                                    >
                                                    <div class="upload-button">
                                                        <x-dashboard.icon.add-image width="12"/>
                                                        <p class="text-muted">Resim yüklemek için tıklayın veya sürükleyin</p>
                                                        <small class="text-muted">PNG, JPG veya JPEG</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-stamp">
                                                <div class="card-stamp-icon bg-green">
                                                    <x-dashboard.icon.image/>
                                                </div>
                                            </div>
                                            <div class="card-status-top bg-blue"></div>
                                            <div class="card-header">
                                                <h4 class="card-title"><x-dashboard.icon.image/>Cover</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="image-preview-container">
                                                    <input 
                                                        type="file" 
                                                        class="image-preview-input" 
                                                        name="cover" 
                                                        id="coverInput"
                                                        data-preview-target="coverPreview"
                                                        accept="image/*"
                                                    >
                                                    <img 
                                                        src="/backend/resimyok.jpg" 
                                                        id="coverPreview" 
                                                        class="preview-image mb-2"
                                                        alt="Cover"
                                                    >
                                                    <div class="upload-button">
                                                        <x-dashboard.icon.add-image/>
                                                        <p class="text-muted">Cover resmi yüklemek için tıklayın veya sürükleyin</p>
                                                        <small class="text-muted">PNG, JPG veya JPEG</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="card">
                                            <div class="card-status-top bg-blue"></div>
                                            <div class="card-stamp">
                                                <div class="card-stamp-icon bg-purple">
                                                    <x-dashboard.icon.gallery/>
                                                </div>
                                            </div>
                                            <div class="card-header">
                                                <h4 class="card-title"><x-dashboard.icon.gallery/>Foto Galeri</h4>
                                            </div>
                                            <div class="card-body">
                                                <input class="form-control" type="file" name="gallery[]" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <!-- Varyasyon Yönetimi -->
                <livewire:variation-manager :attributes="$attributes" />

               
              
            </form>
        </div>
    </div>

    <div class="col-md-3">
        <!-- Kategori Yönetimi -->
        <livewire:category-manager />
        <!-- Marka Yönetimi -->
        <livewire:brand-manager />
        <!-- Etiket Yönetimi -->
        <livewire:tag-manager type="product" />
       
    </div>
</div>

@endsection 
@push('scripts')
@include('backend.layout.ck')
@endpush