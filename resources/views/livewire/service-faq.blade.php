<div>
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                @foreach($languages as $lang)
                    <li class="nav-item">
                        <a href="#faq-{{ $lang->lang }}" 
                           class="nav-link {{ $currentTab == $lang->lang ? 'active' : '' }}"
                           data-bs-toggle="tab"
                           wire:click="$set('currentTab', '{{ $lang->lang }}')">
                            {{ $lang->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active show" id="faq-{{ $currentTab }}">
                    @foreach($faqs as $index => $faq)
                        <div class="faq-item card p-3 mb-2">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h4 class="card-title m-0">
                                    <x-dashboard.icon.add/>
                                    FAQ #{{ $index + 1 }}
                                </h4>
                                <button type="button" class="btn btn-danger btn-sm btn-icon" 
                                        wire:click="removeFaq({{ $index }})">
                                    <x-dashboard.icon.delete width="16"/>
                                </button>
                            </div>
                            
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="form-floating mb-2">
                                        <input type="text" 
                                            class="form-control" 
                                            wire:model="faqs.{{ $index }}.name"
                                            placeholder="Soru">
                                        <label>Soru</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea 
                                            class="form-control" 
                                            wire:model="faqs.{{ $index }}.desc"
                                            style="height: 100px"
                                            placeholder="Cevap"></textarea>
                                        <label>Cevap</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-3">
                        <button type="button" class="btn btn-primary" wire:click="addFaq">
                            <x-dashboard.icon.add/> Yeni FAQ Ekle
                        </button>

                        @if(count($faqs) > 0)
                            <button type="button" class="btn btn-success" wire:click="save">
                                <x-dashboard.icon.save/> Kaydet
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 