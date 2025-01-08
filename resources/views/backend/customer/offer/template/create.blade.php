@extends('backend.layout.app')

@section('content')
<form action="{{ route('offer-templates.store') }}" method="POST">
    @csrf

    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h3 class="card-title"><x-dashboard.icon.theme/> Yeni Teklif Şablonu Oluştur</h3>
                <div class="card-actions">
                    <a href="{{ route('offer-templates.index') }}" class="btn btn-outline-dark">
                        <x-dashboard.icon.back/>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <x-dashboard.icon.save/> Şablonu Kaydet
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-status-top bg-blue"></div>
                <div class="card-body">
                    
                    <div class="card">
                        <div class="card-status-top bg-blue"></div>
                        <div class="card-header">
                            <h3 class="card-title">Şablon Detayları</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="form-label">Şablon Adı</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-check mt-4">
                                            <input type="checkbox" class="form-check-input" name="is_default" value="1">
                                            <span class="form-check-label">Varsayılan Şablon</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
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
                            <div class="table-responsive">
                                <table class="table table-vcenter" id="itemsTable">
                                    <thead>
                                        <tr>
                                            <th>İş Adı</th>
                                            <th width="100">Adet</th>
                                            <th width="150">Birim Fiyat</th>
                                            <th width="100">İndirim %</th>
                                            <th width="100">KDV %</th>
                                            <th width="150">Toplam</th>
                                            <th width="50"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="items-container">
                                        <!-- Kalemler buraya eklenecek -->
                                    </tbody>
                                </table>
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
                                    <textarea name="description" id="description" class="form-control" rows="3"></textarea>
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
                                    <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
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
                                    <textarea name="terms" id="terms" class="form-control" rows="3"></textarea>
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
                            <option value="TRY">TRY</option>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                            <option value="GBP">GBP</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script type="text/javascript">
    CKEDITOR.replace('description', {!! json_encode(config('ckeditor.default')) !!});
    CKEDITOR.replace('notes', {!! json_encode(config('ckeditor.notes')) !!});
    CKEDITOR.replace('terms', {!! json_encode(config('ckeditor.terms')) !!});
</script>

<script>
let itemCount = 0;

function addItem(item = null) {
    const row = `
        <tr class="item-row" id="item-${itemCount}">
            <td>
                <input type="text" name="items[${itemCount}][item_name]" class="form-control" value="${item ? item.item_name : ''}" required>
            </td>
            <td>
                <input type="number" name="items[${itemCount}][unit]" class="form-control" value="${item ? item.unit : 1}" min="1" required onchange="calculateTotal(${itemCount})">
            </td>
            <td>
                <input type="number" name="items[${itemCount}][amount]" class="form-control" step="0.01" value="${item ? item.amount : ''}" min="0" required onchange="calculateTotal(${itemCount})">
            </td>
            <td>
                <input type="number" name="items[${itemCount}][discount]" class="form-control" value="${item ? item.discount : 0}" min="0" max="100" required onchange="calculateTotal(${itemCount})">
            </td>
            <td>
                <input type="number" name="items[${itemCount}][tax]" class="form-control" value="${item ? item.tax : 20}" min="0" max="100" required onchange="calculateTotal(${itemCount})">
            </td>
            <td>
                <input type="number" name="items[${itemCount}][total]" class="form-control" readonly>
            </td>
            <td>
                <button type="button" class="btn btn-icon btn-danger" onclick="removeItem(${itemCount})">
                    <x-dashboard.icon.delete/>
                </button>
            </td>
        </tr>
    `;

    $('#items-container').append(row);
    calculateTotal(itemCount);
    itemCount++;
}

function removeItem(index) {
    $(`#item-${index}`).remove();
    calculateTotals();
}

function calculateTotal(index) {
    const row = $(`#item-${index}`);
    const unit = parseFloat(row.find('input[name$="[unit]"]').val()) || 0;
    const amount = parseFloat(row.find('input[name$="[amount]"]').val()) || 0;
    const discount = parseFloat(row.find('input[name$="[discount]"]').val()) || 0;
    const tax = parseFloat(row.find('input[name$="[tax]"]').val()) || 0;
    
    const subtotal = unit * amount;
    const discountAmount = subtotal * (discount / 100);
    const afterDiscount = subtotal - discountAmount;
    const taxAmount = afterDiscount * (tax / 100);
    const total = afterDiscount + taxAmount;
    
    row.find('input[name$="[total]"]').val(total.toFixed(2));
    calculateTotals();
}

function calculateTotals() {
    let subtotal = 0;
    let discountTotal = 0;
    let taxTotal = 0;
    let grandTotal = 0;
    
    $('.item-row').each(function() {
        const unit = parseFloat($(this).find('input[name$="[unit]"]').val()) || 0;
        const amount = parseFloat($(this).find('input[name$="[amount]"]').val()) || 0;
        const discount = parseFloat($(this).find('input[name$="[discount]"]').val()) || 0;
        const tax = parseFloat($(this).find('input[name$="[tax]"]').val()) || 0;
        
        const rowSubtotal = unit * amount;
        const rowDiscount = rowSubtotal * (discount / 100);
        const afterDiscount = rowSubtotal - rowDiscount;
        const rowTax = afterDiscount * (tax / 100);
        
        subtotal += rowSubtotal;
        discountTotal += rowDiscount;
        taxTotal += rowTax;
        grandTotal += (afterDiscount + rowTax);
    });
    
    $('#subtotal').text(subtotal.toFixed(2));
    $('#discount-total').text(discountTotal.toFixed(2));
    $('#tax-total').text(taxTotal.toFixed(2));
    $('#grand-total').text(grandTotal.toFixed(2));
}

// Sayfa yüklendiğinde ilk kalemi ekle
$(document).ready(function() {
    addItem();
});
</script>
@endpush
@endsection
