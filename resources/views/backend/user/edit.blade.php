@extends('backend.layout.app')
@section('content')
<div class="col-12 col-md-8">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Kullanıcı Düzenle</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST" data-action="update">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-3">
                    <label class="form-label">Ad Soyad</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $user->name) }}">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email', $user->email) }}">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

             

                <div class="form-group mb-3">
                    <label class="form-label">Şifre (Boş bırakılırsa değişmez)</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Roller</label>
                    <select name="roles[]" class="form-select @error('roles') is-invalid @enderror" multiple>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" 
                                {{ in_array($role->name, $userRoles) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('roles')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

               

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection