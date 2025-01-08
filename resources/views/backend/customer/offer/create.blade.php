@extends('backend.layout.app')

@section('content')
<form action="{{ route('customer-offers.store') }}" method="POST">
    @csrf

    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-status-top bg-blue"></div>
            <div class="card-header">
                <h3 class="card-title"><x-dashboard.icon.add/> Yeni Teklif Oluştur</h3>
                <div class="card-actions">
                    <a href="{{ route('customer-offers.index') }}" class="btn btn-outline-dark">
                        <x-dashboard.icon.back/>
                    </a>
                    <button type="submit" class="btn btn-primary" data-action="save">
                        <x-dashboard.icon.save/> Teklifi Kaydet
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
       

        
    </div>

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
                                    <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->company_name }}
                                    </option>
                                @endforeach
                            </select>

                            
                                <div class="form-group mt-3">
                                    <select name="template_id" id="template_id" class="form-control select2">
                                        <option value="">Şablon Seçin</option>
                                        @foreach($templates as $template)
                                            <option value="{{ $template->id }}" data-items="{{ json_encode($template->items) }}" 
                                                    data-currency="{{ $template->currency }}"
                                                    data-description="{{ $template->description }}"
                                                    data-terms="{{ $template->terms }}"
                                                    data-notes="{{ $template->notes }}">
                                                {{ $template->name }} ({{ $template->currency }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                          

                            <input type="text" name="name" class="form-control mt-3" placeholder="Teklif Başlığı" required>
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
                                    <textarea name="desc" class="form-control" rows="3"></textarea>
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
                                    <textarea name="note" class="form-control" rows="3"></textarea>
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
                                    <textarea name="terms" class="form-control" rows="3"></textarea>
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
                                <option value="{{ $currency->value }}">{{ $currency->value }}</option>
                            @endforeach
                        </select>
                        <div id="current-rate-info" class="form-text text-muted mt-1"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Teklif Durumu</label>
                        <select name="status" class="form-select" required>
                            @foreach($statuses as $status)
                                <option value="{{ $status->value }}">{{ $status->title() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="offer_date">Teklif Tarihi</label>
                        <input type="date" name="offer_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="valid_until">Geçerlilik Tarihi</label>
                        <input type="date" name="valid_until" class="form-control" value="{{ date('Y-m-d', strtotime('+1 month')) }}">
                    </div>

                
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

// Şablon seçildiğinde
$('#template_id').on('change', function() {
    const $selected = $(this).find('option:selected');
    if ($selected.val()) {
        const items = $selected.data('items');
        const currency = $selected.data('currency');
        
        // Para birimini güncelle
        $('select[name="currency"]').val(currency).trigger('change');
        
        // Açıklama, şartlar ve notları güncelle
        CKEDITOR.instances.desc.setData($selected.data('description'));
        CKEDITOR.instances.terms.setData($selected.data('terms'));
        CKEDITOR.instances.note.setData($selected.data('notes'));
        
        // Mevcut kalemleri temizle
        $('#items-container').empty();
        
        // Şablon kalemlerini ekle
        items.forEach(item => {
            addItem(item);
        });
    }
});

// Sayfa yüklendiğinde ilk kalemi ekle
$(document).ready(function() {
    addItem();
});

// Currency değiştiğinde çalışacak fonksiyon
$('select[name="currency"]').on('change', async function() {
    const newCurrency = $(this).val();
    const oldCurrency = $(this).data('current-currency') || 'TRY';
    
    // Aynı para birimi seçildiyse işlem yapma
    if (newCurrency === oldCurrency) {
        return;
    }

    try {
        // Tüm kalemleri yeni para birimine çevir
        const promises = [];
        $('.item-row').each(function() {
            const $row = $(this);
            const $amountInput = $row.find('input[name$="[amount]"]');
            const amount = parseFloat($amountInput.val()) || 0;

            if (amount > 0) {
                const promise = $.ajax({
                    url: '{{ route("exchange-rates.convert") }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        amount: amount,
                        from_currency: oldCurrency,
                        to_currency: newCurrency
                    }
                }).then(response => {
                    if (response.success && typeof response.amount === 'number') {
                        $amountInput.val(response.amount.toFixed(2));
                        calculateTotal($row.attr('id').replace('item-', ''));
                    }
                });
                promises.push(promise);
            }
        });

        await Promise.all(promises);
        $(this).data('current-currency', newCurrency);
        calculateTotals();
        showCurrentRate();

    } catch (error) {
        console.error('Döviz çevirme hatası:', error);
        alert('Döviz çevirme işlemi sırasında bir hata oluştu.');
        // Hata durumunda eski para birimine geri dön
        $(this).val(oldCurrency);
        $(this).data('current-currency', oldCurrency);
    }
});

// Güncel kur bilgisini göster
async function showCurrentRate() {
    const currency = $('select[name="currency"]').val();
    if (currency === 'TRY') {
        $('#current-rate-info').text('');
        return;
    }

    try {
        const response = await $.ajax({
            url: '{{ route("exchange-rates.current-rate") }}',
            method: 'GET',
            data: { currency }
        });

        if (response.success && response.rate) {
            const message = `1 ${currency} = ${response.rate.selling_rate} TRY`;
            $('#current-rate-info').text(message);
        }
    } catch (error) {
        console.error('Kur bilgisi alma hatası:', error);
        $('#current-rate-info').text('Kur bilgisi alınamadı');
    }
}

// Sayfa yüklendiğinde kur bilgisini göster
$(document).ready(function() {
    showCurrentRate();
});
</script>
@endpush
@endsection