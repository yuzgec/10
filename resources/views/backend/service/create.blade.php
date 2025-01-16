@extends('backend.layout.app')
@section('content')
{!! Html::form()
    ->method('POST')
    ->action(route('service.store'))
    ->attribute('enctype', 'multipart/form-data')
    ->open()
!!}

<x-dashboard.crud.create-header route='service' name="Hizmet"/>

<div class="row">
    <div class="col-md-9 mb-3 p-1">
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
                                <x-dashboard.form.input required label='Hizmet Adı' name='name:{{ $lang->lang }}' placeholder="Hizmet Adı Giriniz ({{ $lang->native }})" maxlength="75"/>
                                <x-dashboard.form.text-area label='Kısa Açıklama' name='short:{{ $lang->lang }}'/>
                                <x-dashboard.form.text-area label='Açıklama' name='desc:{{ $lang->lang }}' id='desc'/>
                            </div>
                        </div>

                        <x-dashboard.site.seo :lang="$lang" />

                        <div class="card mb-3">
                            <div class="card-status-top bg-blue"></div>
                            <div class="card-header">
                                <h4 class="card-title">{{ strtoupper($lang->lang) }} FAQ</h4>
                            </div>
                            <div class="card-body">
                                <div class="faq-items-{{ $lang->lang }}">
                                    <div class="faq-item card p-3 mb-2">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h4 class="card-title m-0">
                                                <x-dashboard.icon.add/>
                                                Yeni FAQ
                                            </h4>
                                            <button type="button" class="btn btn-danger btn-sm btn-icon remove-faq">
                                                <x-dashboard.icon.delete width="16"/>
                                            </button>
                                        </div>
                                        
                                        <div class="row g-2">
                                            <div class="col-12">
                                                <div class="form-floating mb-2">
                                                    <input type="text" 
                                                        class="form-control" 
                                                        name="faqs[{{ $lang->lang }}][0][name]" 
                                                        placeholder="Soru yazınız">
                                                    <label>Soru</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <textarea 
                                                        class="form-control" 
                                                        name="faqs[{{ $lang->lang }}][0][desc]"
                                                        style="height: 100px"
                                                        placeholder="Cevap yazınız"></textarea>
                                                    <label>Cevap</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end mt-3">
                                    <button type="button" class="btn btn-primary add-faq" data-locale="{{ $lang->lang }}">
                                        <x-dashboard.icon.add class="me-1"/>
                                        Yeni FAQ Ekle
                                    </button>
                                </div>
                            </div>
                        </div>

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
    
    </div>

    <div class="col-md-3 mb-3 p-1">
        
        <x-dashboard.crud.category :cat='$cat'/>
        
        
        <div class="card mt-2">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h4 class="card-title"><x-dashboard.icon.image/> Yayınlama</h4>
            </div>
            <div class="card-body">  
                <div class="mb-3">
                    @foreach ($status->take(3) as $item)
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="{{$item->value}}" id='{{ $item->id()}}' @if($item->value == 1) checked @endif>
                            <span class="form-check-label">{{ $item->title()}}</span>
                        </label>
                    @endforeach
                </div>

                <div id="dateInput">
                    <label for="dateField">Yayınlanma Tarihi:</label>
                    <input type="date" class="form-control" id="dateField" name="publish_date" value="{{ date('Y-m-d')}}">
                </div>

                <hr>
                <label class="form-check form-switch mt-2">&nbsp; Google İndex
                    <input class="form-check-input switch" name="addGoogle" type="checkbox" value="1" checked>
                </label>
                <label class="form-check form-switch mt-2">&nbsp; Yorum Yapılabilir
                    <input class="form-check-input switch" name="addComment" type="checkbox" value="0">
                </label>
                <label class="form-check form-switch mt-2">&nbsp; İçeriği Kaldır
                    <input class="form-check-input switch" name="deleteContent" type="checkbox" value="0">
                </label>
            </div>
        </div>
    </div>



</div>
{!! Html::form()->close() !!}


@endsection

@section('customJS')

<script>
    document.querySelectorAll('.add-faq').forEach(button => {
        button.addEventListener('click', function() {
            const locale = this.dataset.locale;
            const container = document.querySelector(`.faq-items-${locale}`);
            const index = container.querySelectorAll('.faq-item').length;
            
            const template = `
                <div class="faq-item card p-3 mb-2">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="card-title m-0">
                            <x-dashboard.icon.add/>
                            Yeni FAQ
                        </h4>
                        <button type="button" class="btn btn-danger btn-sm btn-icon remove-faq">
                            <x-dashboard.icon.delete width="16"/>
                        </button>
                    </div>
                    
                    <div class="row g-2">
                        <div class="col-12">
                            <div class="form-floating mb-2">
                                <input type="text" 
                                    class="form-control" 
                                    name="faqs[${locale}][${index}][name]" 
                                    placeholder="Soru yazınız">
                                <label>Soru</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea 
                                    class="form-control" 
                                    name="faqs[${locale}][${index}][desc]"
                                    style="height: 100px"
                                    placeholder="Cevap yazınız"></textarea>
                                <label>Cevap</label>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', template);
        });
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-faq')) {
            const faqItem = e.target.closest('.faq-item');
            faqItem.remove();
        }
    });
</script>

<style>
    .faq-item {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,.125);
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
    }

    .faq-item:hover {
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
    }

    .form-floating > .form-control::placeholder {
        color: transparent;
    }

    .form-floating > .form-control:focus::placeholder {
        color: #6c757d;
    }

    .btn-danger {
        transition: all 0.2s ease;
        border-radius: 50%;
    }

    .btn-danger:hover {
        transform: scale(1.05);
    }
</style>

@include('backend.layout.ck')
@endsection