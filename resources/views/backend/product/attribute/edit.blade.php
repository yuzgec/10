@extends('backend.layout.app')

@section('content')
   
      
{!! html()->modelForm($attribute, 'PUT', route('product-attributes.update', $attribute))->open() !!}

    <x-dashboard.crud.edit-header route='product-attributes' name="Özellik" :model="$attribute"/>

    <div class="col-12">
        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="card-body">
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
                                        <label class="form-label">
                                            Özellik Adı ({{ strtoupper($lang->lang) }})
                                        </label>
                                        <input type="text" 
                                                name="name[{{ $lang->lang }}]" 
                                                class="form-control"
                                                value="{{ $attribute->translate($lang->lang)->name ?? '' }}"
                                                required>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mb-3 mt-3">
                    <label class="form-check form-switch">
                        <input type="checkbox" 
                                class="form-check-input" 
                                name="status" 
                                value="1"
                                {{ $attribute->status ? 'checked' : '' }}>
                        <span class="form-check-label">Aktif</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

{!! html()->closeModelForm() !!}
           
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('valuesContainer');
        const addButton = document.getElementById('addValue');
        const typeSelect = document.getElementById('typeSelect');
        let valueCount = {{ $attribute->values->count() }};

        function addValueField() {
            const isColor = typeSelect.value === 'color';
            const wrapper = document.createElement('div');
            wrapper.className = 'row mb-2 align-items-center';
            
            wrapper.innerHTML = `
                <div class="col">
                    @foreach($language as $locale)
                    <input type="text" name="values[${valueCount}][${locale}]" 
                           class="form-control mb-2" 
                           placeholder="Değer (${locale.toUpperCase()})" required>
                    @endforeach
                </div>
                ${isColor ? `
                    <div class="col-auto">
                        <input type="color" name="colors[]" class="form-control form-control-color">
                    </div>
                ` : ''}
                <div class="col-auto">
                    <button type="button" class="btn btn-icon btn-outline-danger" onclick="this.closest('.row').remove()">
                        <x-dashboard.icon.add />
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
    });
</script>
@endpush 