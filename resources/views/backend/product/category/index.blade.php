
@extends('backend.layout.app')
@section('content')
<div class="col-12 col-md-12 mb-3">
    <div class="card">

        <div class="card-header">
            <h3 class="card-title"><b><u>{{request('name')}}</u></b> Kategori Listesi</h3>
            <div class="card-actions d-flex">
               
                <div class="p-1">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark">
                        <x-dashboard.icon.back/>
                        Geri
                    </a>
                </div>
                <div class="p-1">
                    <a href="{{ route('product-categories.create')}}" title="Kategori Oluştur" class="btn btn-primary">
                        <x-dashboard.icon.add/>
                        Ekle
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>IMG</th>
                    <th>Kategori Adı</th>
                    <th>Kategori Türü</th>
                    <th class="w-1"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all as $item)
                <tr>

                    <td>
                        @if($item->parent_id == null)
                        <span class="badge bg-blue text-blue-fg">{{ $item->id}}</b>
                        @else
                        {{ $item->id}}
                        @endif
                    </td>
                    <td>
                        <a data-fslightbox="gallery" href="{{ $item->getFirstMediaUrl('page', 'thumb')}}">
                            <img src="{{ $item->getFirstMediaUrl('page', 'thumb')}}" class="avatar me-2">
                        </a>
                    </td>
                
                    <td class="text-secondary text-capitalize">
                        <span class="">
                            {{ $item->parent_id == null ? '' : '--'}} {{ $item->name}}
                        </span>
                    </td>
                    <td class="text-secondary">
                        @if($item->parent_id == null)
                        <span class="badge bg-blue text-blue-fg">Ana Menu</b>
                        @else
                        <span class="badge badge-outline text-blue">Alt Menu</b>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('product-categories.edit', $item->id)}}">Düzenle</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection