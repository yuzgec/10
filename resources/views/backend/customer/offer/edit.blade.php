@extends('backend.layout.app')

@section('content')
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h3 class="card-title"><x-dashboard.icon.edit/> Teklif Düzenle - {{ $offer->offer_no }}</h3>
                <div class="card-actions">
                    <a href="{{ route('customer-offers.show', $offer) }}" class="btn btn-outline-dark">
                        <x-dashboard.icon.back/> Geri
                    </a>
                </div>
            </div>
        </div>
    </div>

    {!! html()->model($offer)
        ->form('PUT', route('customer-offers.update', $offer->id))
        ->attribute('enctype', 'multipart/form-data') 
        ->attribute('data-action', 'update')
        ->open() 
        !!}
{{ html()->hidden('updated_by', auth()->user()->id) }}
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-status-top bg-blue"></div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-status-top bg-blue"></div>
                            <div class="card-header">
                                <h3 class="card-title">Teklif Detayları</h3>
                            </div>
                            <div class="card-body">
                                <label class="form-label">Müşteri</label>
                                <select name="customer_id" class="form-select" required>
                                    <option value="">Müşteri Seçin</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ $offer->customer_id == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->company_name }}
                                        </option>
                                    @endforeach
                                </select>

                                <label class="form-label">Teklif Başlığı</label>
                                <input type="text" name="name" class="form-control" value="{{ $offer->name }}" required>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-status-top bg-blue"></div>
                            <div class="card-header">
                                <h3 class="card-title">Teklif Kalemleri</h3>
                                <div class="card-actions">
                                    <button type="button" class="btn btn-primary" onclick="addItem()">
                                        <x-dashboard.icon.add/> İş Ekle
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="items-container">
                                    <!-- Kalemler buraya dinamik olarak eklenecek -->
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-7"></div>
                                    <div class="col-md-5">
                                        <table class="table table-sm">
                                            <tr>
                                                <th>Ara Toplam:</th>
                                                <td class="text-end"><span id="subtotal">0.00</span></td>
                                            </tr>
                                            <tr>
                                                <th>İndirim Toplam:</th>
                                                <td class="text-end">-<span id="discount-total">0.00</span></td>
                                            </tr>
                                            <tr>
                                                <th>KDV Toplam:</th>
                                                <td class="text-end"><span id="tax-total">0.00</span></td>
                                            </tr>
                                            <tr>
                                                <th>Genel Toplam:</th>
                                                <td class="text-end"><span id="grand-total">0.00</span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-status-top bg-blue"></div>
                            <div class="card-header">
                                <h3 class="card-title">Açıklama</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <textarea name="desc" class="form-control" rows="3">{{ $offer->desc }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-status-top bg-blue"></div>
                            <div class="card-header">
                                <h3 class="card-title">İç Notlar</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <textarea name="note" class="form-control" rows="3">{{ $offer->note }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-status-top bg-blue"></div>
                            <div class="card-header">
                                <h3 class="card-title">Teklif Şartları</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <textarea name="terms" class="form-control" rows="3">{{ $offer->terms }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-status-top bg-blue"></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Para Birimi</label>
                            <select name="currency" class="form-select" required>
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency->value }}" {{ $offer->currency == $currency->value ? 'selected' : '' }}>
                                        {{ $currency->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teklif Durumu</label>
                            <select name="status" class="form-select" required>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->value }}" {{ $offer->status == $status->value ? 'selected' : '' }}>
                                        {{ $status->title() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="offer_date">Teklif Tarihi</label>
                            <input type="date" name="offer_date" class="form-control" value="{{ $offer->offer_date->format('Y-m-d') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="valid_until">Geçerlilik Tarihi</label>
                            <input type="date" name="valid_until" class="form-control" value="{{ $offer->valid_until?->format('Y-m-d') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-end">
                        <button type="submit" class="btn btn-primary">
                            <x-dashboard.icon.save/> Değişiklikleri Kaydet
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@push('scripts')
<script type="text/javascript">
    CKEDITOR.replace('desc', {!! json_encode(config('ckeditor.default')) !!});
    CKEDITOR.replace('note', {!! json_encode(config('ckeditor.notes')) !!});
    CKEDITOR.replace('terms', {!! json_encode(config('ckeditor.terms')) !!});
</script>

<script>
let itemCount = 0;
let existingItems = @json($offer->items);

function addItem(itemData = null) {
    const container = document.getElementById('items-container');
    const itemHtml = `
        <div class="item-row border-bottom pb-2 mb-2" id="item-${itemCount}">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <input type="text" name="items[${itemCount}][item_name]" class="form-control" placeholder="İş Adı" required>
                </div>
                <div class="col-md-1 mb-2">
                    <input type="number" name="items[${itemCount}][unit]" class="form-control" placeholder="Adet" value="1" min="1" required onchange="calculateTotal(${itemCount})">
                </div>
                <div class="col-md-2 mb-2">
                    <input type="number" name="items[${itemCount}][amount]" class="form-control" placeholder="Birim Fiyat" step="0.01" required onchange="calculateTotal(${itemCount})">
                </div>
                <div class="col-md-1 mb-2">
                    <input type="number" name="items[${itemCount}][discount]" class="form-control" placeholder="%" value="0" min="0" max="50" required onchange="calculateTotal(${itemCount})">
                </div>
                <div class="col-md-2 mb-2">
                    <input type="number" name="items[${itemCount}][tax]" class="form-control" value="20" readonly required onchange="calculateTotal(${itemCount})">
                </div>
                <div class="col-md-3 mb-2 d-flex">
                    <input type="number" name="items[${itemCount}][total]" class="form-control" placeholder="Toplam" readonly>
                    <button type="button" class="btn btn-icon btn-danger ms-1" onclick="removeItem(${itemCount})">
                        <x-dashboard.icon.trash/>
                    </button>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', itemHtml);

    if (itemData) {
        const row = document.getElementById(`item-${itemCount}`);
        row.querySelector('input[name^="items"][name$="[item_name]"]').value = itemData.item_name;
        row.querySelector('input[name^="items"][name$="[unit]"]').value = itemData.unit;
        row.querySelector('input[name^="items"][name$="[amount]"]').value = itemData.amount;
        row.querySelector('input[name^="items"][name$="[discount]"]').value = itemData.discount;
        row.querySelector('input[name^="items"][name$="[tax]"]').value = itemData.tax;
        calculateTotal(itemCount);
    }

    itemCount++;
}

function removeItem(index) {
    document.getElementById(`item-${index}`).remove();
    calculateTotals();
}

function calculateTotal(index) {
    const row = document.getElementById(`item-${index}`);
    const unit = parseFloat(row.querySelector('input[name^="items"][name$="[unit]"]').value) || 0;
    const amount = parseFloat(row.querySelector('input[name^="items"][name$="[amount]"]').value) || 0;
    const discount = parseFloat(row.querySelector('input[name^="items"][name$="[discount]"]').value) || 0;
    const tax = parseFloat(row.querySelector('input[name^="items"][name$="[tax]"]').value) || 0;
    
    const subtotal = unit * amount;
    const discountAmount = subtotal * (discount / 100);
    const afterDiscount = subtotal - discountAmount;
    const taxAmount = afterDiscount * (tax / 100);
    const total = afterDiscount + taxAmount;
    
    row.querySelector('input[name^="items"][name$="[total]"]').value = total.toFixed(2);
    calculateTotals();
}

function calculateTotals() {
    let subtotal = 0;
    let discountTotal = 0;
    let taxTotal = 0;
    let grandTotal = 0;
    
    document.querySelectorAll('.item-row').forEach(row => {
        const unit = parseFloat(row.querySelector('input[name^="items"][name$="[unit]"]').value) || 0;
        const amount = parseFloat(row.querySelector('input[name^="items"][name$="[amount]"]').value) || 0;
        const discount = parseFloat(row.querySelector('input[name^="items"][name$="[discount]"]').value) || 0;
        const tax = parseFloat(row.querySelector('input[name^="items"][name$="[tax]"]').value) || 0;
        
        const rowSubtotal = unit * amount;
        const rowDiscount = rowSubtotal * (discount / 100);
        const afterDiscount = rowSubtotal - rowDiscount;
        const rowTax = afterDiscount * (tax / 100);
        
        subtotal += rowSubtotal;
        discountTotal += rowDiscount;
        taxTotal += rowTax;
        grandTotal += (afterDiscount + rowTax);
    });
    
    document.getElementById('subtotal').textContent = subtotal.toFixed(2);
    document.getElementById('discount-total').textContent = discountTotal.toFixed(2);
    document.getElementById('tax-total').textContent = taxTotal.toFixed(2);
    document.getElementById('grand-total').textContent = grandTotal.toFixed(2);
}

// Sayfa yüklendiğinde mevcut kalemleri yükle
document.addEventListener('DOMContentLoaded', function() {
    if (existingItems.length > 0) {
        existingItems.forEach(item => {
            addItem(item);
        });
    } else {
        addItem(); // Eğer kalem yoksa boş bir tane ekle
    }
});
</script>
@endpush
@endsection 