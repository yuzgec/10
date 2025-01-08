@extends('backend.layout.app')

@section('content')
   
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Yeni Ürün Özelliği</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('product-attributes.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Özellik Tipi</label>
                    <select name="type" class="form-select" id="typeSelect">
                        <option value="select">Seçenek</option>
                        <option value="color">Renk</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" name="status" checked>
                        <span class="form-check-label">Aktif</span>
                    </label>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sıralama</label>
                    <input type="number" name="rank" class="form-control" value="0">
                </div>

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            @foreach($language as $lang)
                            <li class="nav-item">
                                <a href="#{{ $lang->lang }}" class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab">
                                    <img src="/flags/{{ $lang->lang }}.svg" width="20px">
                                    <span class="ms-2">{{ $lang->native }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            @foreach($language as $lang)
                                <div class="tab-pane {{ $loop->first ? 'active show' : '' }}" id="{{ $lang->lang }}">
                                    <div class="mb-3">
                                        <label class="form-label">Özellik Adı ({{ strtoupper($lang->lang) }})</label>
                                        <input type="text" name="name:{{ $lang->lang }}" class="form-control">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Değerler</h3>
                        <div class="card-actions">
                            <button type="button" class="btn btn-primary" id="addValue">
                                <x-dashboard.icon.add />
                                Yeni Değer Ekle
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="valuesContainer"></div>
                    </div>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
    
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('valuesContainer');
    const addButton = document.getElementById('addValue');
    const typeSelect = document.getElementById('typeSelect');
    let valueCount = 0;

    function addValueField() {
        const isColor = typeSelect.value === 'color';
        const wrapper = document.createElement('div');
        wrapper.className = 'row mb-2 align-items-center';
        
        wrapper.innerHTML = `
            <div class="col">
                @foreach($language as $lang)
                <input type="text" name="values[${valueCount}][{{ $lang->lang }}]" 
                       class="form-control mb-2" 
                       placeholder="Değer ({{ strtoupper($lang->lang) }})" required>
                @endforeach
            </div>
            ${isColor ? `
                <div class="col-auto">
                    <input type="color" name="colors[${valueCount}]" class="form-control form-control-color">
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