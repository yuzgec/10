
@extends('backend.layout.app')
@section('content')
<div class="page-header d-print-none">
    <div class="col-12 d-flex justify-content-between mb-3">
        <x-dashboard.site.title title='Kullanıcı Rolleri'/>
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
                

                    <td class="text-secondary text-capitalize">
                        {{ $item->name}}
                    </td>

                    <td>
                        <a href="#">Düzenle</a>
                    </td>
                </tr>
                @empty
                    <div>Eklenmedi</div>
                @endforelse
            </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection