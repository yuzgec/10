@extends('backend.layout.app')

@section('title', 'Teklif Şablonları')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Teklif Şablonları</h4>
                    <a href="{{ route('offer-templates.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Yeni Şablon
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Şablon Adı</th>
                                    <th>Para Birimi</th>
                                    <th>Kalem Sayısı</th>
                                    <th>Varsayılan</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($templates as $template)
                                    <tr>
                                        <td>{{ $template->name }}</td>
                                        <td>{{ $template->currency }}</td>
                                        <td>{{ $template->items->count() }}</td>
                                        <td>
                                            @if($template->is_default)
                                                <span class="badge badge-success">Evet</span>
                                            @else
                                                <span class="badge badge-secondary">Hayır</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
                                                    İşlemler
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); createOffer({{ $template->id }})">
                                                        <i class="fas fa-file-invoice"></i> Teklif Oluştur
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('offer-templates.edit', $template) }}">
                                                        <i class="fas fa-edit"></i> Düzenle
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); deleteTemplate({{ $template->id }})">
                                                        <i class="fas fa-trash"></i> Sil
                                                    </a>
                                                </div>
                                            </div>

                                            <form id="delete-form-{{ $template->id }}" action="{{ route('offer-templates.destroy', $template) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Henüz teklif şablonu eklenmemiş.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Müşteri Seçim Modalı -->
    <div class="modal fade" id="customerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Müşteri Seçin</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="createOfferForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="customer_id">Müşteri</label>
                            <select name="customer_id" id="customer_id" class="form-control select2" required>
                                <option value="">Müşteri Seçin</option>
                                @foreach(\App\Models\Customer::all() as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <button type="submit" class="btn btn-primary">Teklif Oluştur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function createOffer(templateId) {
        $('#createOfferForm').attr('action', `/backend/offer-templates/${templateId}/create-offer`);
        $('#customerModal').modal('show');
    }

    function deleteTemplate(templateId) {
        if (confirm('Bu şablonu silmek istediğinize emin misiniz?')) {
            document.getElementById('delete-form-' + templateId).submit();
        }
    }

    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            dropdownParent: $('#customerModal')
        });
    });
</script>
@endpush