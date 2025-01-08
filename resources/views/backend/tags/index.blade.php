@extends('backend.layout.app')

@section('content')
<div class="container-xl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Etiketler</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tagModal">
                            Yeni Etiket
                        </button>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ad</th>
                                    <th>Slug</th>
                                    <th>Tür</th>
                                    <th>Kullanım</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tags as $tag)
                                <tr>
                                    <td>{{ is_array($tag->name) ? $tag->name['tr'] : $tag->name }}</td>
                                    <td>{{ $tag->slug }}</td>
                                    <td>{{ $tag->type }}</td>
                                    <td>
                                        <a href="{{ route('tags.products', $tag) }}" class="badge bg-blue">
                                            {{ $tag->products_count }} ürün
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tag Modal -->
<div class="modal fade" id="tagModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="tagForm">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Etiket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Türkçe Ad</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">Tür</label>
                        <select class="form-select" name="type" required>
                            <option value="product">Ürün</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tagForm = document.getElementById('tagForm');
    tagForm.addEventListener('submit', function(e) {
        e.preventDefault();

        fetch('{{ route("tags.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(Object.fromEntries(new FormData(this)))
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload(); // Sayfayı yenile
            } else {
                // Hata mesajı göster
            }
        });
    });
});

// SweetAlert2 entegrasyonu
$('.delete-form').on('submit', function(e) {
    e.preventDefault();
    const form = this;
    
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Bu etiketi silmek istediğinize emin misiniz?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet, sil!',
        cancelButtonText: 'İptal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
</script>
@endpush 