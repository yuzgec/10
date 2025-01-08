@extends('backend.layout.app')

@section('title', 'Teklif Şablonu Düzenle')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Teklif Şablonu Düzenle</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('backend.offer-templates.update', $template) }}" method="POST" id="templateForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Şablon Adı</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $template->name }}" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="currency">Para Birimi</label>
                                    <select name="currency" id="currency" class="form-control" required>
                                        <option value="TRY" {{ $template->currency === 'TRY' ? 'selected' : '' }}>TRY</option>
                                        <option value="USD" {{ $template->currency === 'USD' ? 'selected' : '' }}>USD</option>
                                        <option value="EUR" {{ $template->currency === 'EUR' ? 'selected' : '' }}>EUR</option>
                                        <option value="GBP" {{ $template->currency === 'GBP' ? 'selected' : '' }}>GBP</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="is_default" value="1" {{ $template->is_default ? 'checked' : '' }}> Varsayılan Şablon
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Açıklama</label>
                                    <textarea name="description" id="description" class="form-control" rows="3">{{ $template->description }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="terms">Şartlar</label>
                                    <textarea name="terms" id="terms" class="form-control" rows="3">{{ $template->terms }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="notes">İç Notlar</label>
                                    <textarea name="notes" id="notes" class="form-control" rows="3">{{ $template->notes }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>Teklif Kalemleri</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="itemsTable">
                                        <thead>
                                            <tr>
                                                <th>Kalem Adı</th>
                                                <th width="100">Adet</th>
                                                <th width="150">Birim Fiyat</th>
                                                <th width="100">İndirim %</th>
                                                <th width="100">KDV %</th>
                                                <th width="150">Toplam</th>
                                                <th width="50"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($template->items as $index => $item)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="items[{{ $index }}][item_name]" class="form-control" value="{{ $item->item_name }}" required>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="items[{{ $index }}][unit]" class="form-control" value="{{ $item->unit }}" min="1" required onchange="calculateTotal(this)">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="items[{{ $index }}][amount]" class="form-control" step="0.01" value="{{ $item->amount }}" min="0" required onchange="calculateTotal(this)">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="items[{{ $index }}][discount]" class="form-control" value="{{ $item->discount }}" min="0" max="100" required onchange="calculateTotal(this)">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="items[{{ $index }}][tax]" class="form-control" value="{{ $item->tax }}" min="0" max="100" required onchange="calculateTotal(this)">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{ $item->getTotal() }}" readonly>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeItem(this)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7">
                                                    <button type="button" class="btn btn-sm btn-info" onclick="addItem()">
                                                        <i class="fas fa-plus"></i> Kalem Ekle
                                                    </button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Kaydet</button>
                                <a href="{{ route('backend.offer-templates.index') }}" class="btn btn-secondary">İptal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let itemCount = {{ $template->items->count() }};

    function addItem() {
        const row = `
            <tr>
                <td>
                    <input type="text" name="items[${itemCount}][item_name]" class="form-control" required>
                </td>
                <td>
                    <input type="number" name="items[${itemCount}][unit]" class="form-control" value="1" min="1" required onchange="calculateTotal(this)">
                </td>
                <td>
                    <input type="number" name="items[${itemCount}][amount]" class="form-control" step="0.01" min="0" required onchange="calculateTotal(this)">
                </td>
                <td>
                    <input type="number" name="items[${itemCount}][discount]" class="form-control" value="0" min="0" max="100" required onchange="calculateTotal(this)">
                </td>
                <td>
                    <input type="number" name="items[${itemCount}][tax]" class="form-control" value="20" min="0" max="100" required onchange="calculateTotal(this)">
                </td>
                <td>
                    <input type="text" class="form-control" readonly>
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeItem(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;

        $('#itemsTable tbody').append(row);
        itemCount++;
    }

    function removeItem(button) {
        $(button).closest('tr').remove();
    }

    function calculateTotal(input) {
        const row = $(input).closest('tr');
        const unit = parseFloat(row.find('input[name$="[unit]"]').val()) || 0;
        const amount = parseFloat(row.find('input[name$="[amount]"]').val()) || 0;
        const discount = parseFloat(row.find('input[name$="[discount]"]').val()) || 0;
        const tax = parseFloat(row.find('input[name$="[tax]"]').val()) || 0;

        const subtotal = unit * amount;
        const discountAmount = subtotal * (discount / 100);
        const afterDiscount = subtotal - discountAmount;
        const taxAmount = afterDiscount * (tax / 100);
        const total = afterDiscount + taxAmount;

        row.find('input[readonly]').val(total.toFixed(2));
    }

    // Form gönderilmeden önce kontrol
    $('#templateForm').on('submit', function(e) {
        if ($('#itemsTable tbody tr').length === 0) {
            e.preventDefault();
            alert('En az bir kalem eklemelisiniz.');
        }
    });
</script>
@endpush