@extends('backend.layout.app')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Yeni Yetki Ekle</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('permission.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Yetki Adı</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name') }}" placeholder="örn: user.create">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Mevcut Yetkiler</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Yetki Adı</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <form action="{{ route('permission.destroy', $permission->id) }}" method="POST" 
                                          onsubmit="return confirm('Emin misiniz?')">
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

    <div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Rollere Yetki Ata</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('permission.assign') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label class="form-label">Rol Seçin</label>
                    <select name="role" class="form-select @error('role') is-invalid @enderror">
                        <option value="">Seçin</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Yetkiler</label>
                    
                    {{-- Toplu İşlem Butonları --}}
                    <div class="mb-3">
                        <button type="button" class="btn btn-sm btn-primary" id="selectAll">Tümünü Seç</button>
                        <button type="button" class="btn btn-sm btn-danger" id="deselectAll">Tümünü Kaldır</button>
                    </div>
                
                    <div class="row">
                        @foreach($permissions->chunk(ceil($permissions->count() / 3)) as $chunk)
                            <div class="col-md-4">
                                @foreach($chunk as $permission)
                                    <label class="form-check mb-2">
                                        <input type="checkbox" 
                                               name="permissions[]" 
                                               class="form-check-input permission-checkbox" 
                                               value="{{ $permission->id }}">
                                        <span class="form-check-label">{{ $permission->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    @error('permissions')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Yetkileri Ata</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.querySelector('select[name="role"]');
    const selectAllBtn = document.getElementById('selectAll');
    const deselectAllBtn = document.getElementById('deselectAll');
    const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

    // URL'yi dinamik olarak oluştur
    const baseUrl = '{{ url("/") }}';

    // Tümünü Seç
    selectAllBtn.addEventListener('click', function() {
        permissionCheckboxes.forEach(checkbox => checkbox.checked = true);
    });

    // Tümünü Kaldır
    deselectAllBtn.addEventListener('click', function() {
        permissionCheckboxes.forEach(checkbox => checkbox.checked = false);
    });

    // Rol değiştiğinde yetkileri getir
    roleSelect.addEventListener('change', async function() {
        const roleName = this.value;
        if (!roleName) {
            permissionCheckboxes.forEach(checkbox => checkbox.checked = false);
            return;
        }

        try {
            // Loading durumu
            selectAllBtn.disabled = true;
            deselectAllBtn.disabled = true;
            permissionCheckboxes.forEach(checkbox => checkbox.disabled = true);

            const response = await fetch(`/go/user/permission/role/${encodeURIComponent(roleName)}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
                permissionCheckboxes.forEach(checkbox => {
                    checkbox.checked = data.permissions.includes(parseInt(checkbox.value));
                });
            } else {
                throw new Error(data.message || 'Bilinmeyen bir hata oluştu');
            }
        } catch (error) {
            console.error('Yetkiler yüklenirken hata:', error);
            alert('Yetkiler yüklenirken bir hata oluştu: ' + error.message);
        } finally {
            // Loading durumunu kaldır
            selectAllBtn.disabled = false;
            deselectAllBtn.disabled = false;
            permissionCheckboxes.forEach(checkbox => checkbox.disabled = false);
        }
    });

    // Sayfa yüklendiğinde seçili rol varsa yetkilerini getir
    if (roleSelect.value) {
        roleSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endpush
@endsection 