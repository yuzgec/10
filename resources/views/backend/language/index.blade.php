@extends('backend.layout.app') @section('content')


<div class="col-12 col-md-12">
    <div class="card">
        <div class="card-status-top bg-blue"></div>

        <div class="card-header">
            <h3 class="card-title">Diller Listesi [{{ $all->total()}}]</h3>
            <div class="card-actions d-flex">
                <div class="d-none d-sm-inline-block  p-1">
                    <form>
                        <div class="input-icon mb-3">
                            <input type="text" class="form-control" name="q" placeholder="Arama" value="{{ request('q')}}">
                            <span class="input-icon-addon">
                                <x-dashboard.icon.search/>
                             </span>
                        </div>
                    </form>
                </div>
                @if(request('q'))
                <div class="p-1">
                    <a href="{{ route('language.index')}}" class="btn btn-icon" title="Sayfayı Yenile">
                        <x-dashboard.icon.refresh/>
                    </a>
                </div>
                @endif
                <div class="p-1">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark">
                        <x-dashboard.icon.back/>
                        Geri
                    </a>
                </div>
               

            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Language</th>
                        <th>İsim</th>
                        <th class="w-1"></th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all as $item)
                    <tr>
                        <td><img src="{{asset('/flags/'.$item->lang.'.svg')}}" alt="{{$item->lang}}"></td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->native}}</td>
                        <td>
                            <label class="form-check form-switch">
                                <input class="form-check-input toggle-language" 
                                       type="checkbox" 
                                       data-id="{{ $item->id }}"
                                       {{ $item->active ? 'checked' : '' }}>
                            </label>
                        </td>
                        <td></td>
        
                    </tr>
                    @endforeach
                </tbody>
            </table>
          
        </div>
        <div class="d-flex justify-content-center align-items-center text-center mt-3">
            {{ $all->appends(['q' => request('q')])->links() }}
        </div>
       

    </div>
  
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tüm toggle switchleri seç
    const toggles = document.querySelectorAll('.toggle-language');

    toggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const languageId = this.dataset.id;
            const isActive = this.checked;

            // CSRF token al
            const token = document.querySelector('meta[name="csrf-token"]').content;

            // Ajax isteği gönder
            fetch(`/go/settings/language/toggle/${languageId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    active: isActive
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Başarılı mesajı göster
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else {
                    // Hata durumunda switch'i eski haline getir
                    this.checked = !this.checked;
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Bir hata oluştu!',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            })
            .catch(error => {
                // Hata durumunda switch'i eski haline getir
                this.checked = !this.checked;
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Bir hata oluştu!',
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        });
    });
});
</script>
@endpush


@endsection