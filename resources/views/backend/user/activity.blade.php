
@extends('backend.layout.app')
@section('content')
<div class="page-header d-print-none">
    <div class="col-12 d-flex justify-content-between mb-3">
        <x-dashboard.site.title title='Kullanıcı Etkinlikleri'/>
        <x-dashboard.site.preview/>
    </div>
</div>
<div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>Role</th>
                    <th class="w-1"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($all as $item)
                
                <tr>
                

                    <td class="text-secondary">
                        {{ $item->log_name}}
                    </td>

                    <td>
                        <a href="#">Düzenle</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td>
                <div class="alert alert-info" role="alert">
                    <div class="d-flex">
                      <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v4"></path><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path><path d="M12 16h.01"></path></svg>
                      </div>
                      <div>
                        Henüz eklenmedi! <a href="">Eklemek için tıklatın</a>
                      </div>
                    </div>
                  </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection