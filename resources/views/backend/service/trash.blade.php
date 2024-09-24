@extends('backend.layout.app') @section('content')


<div class="col-12 col-md-12">
    <div class="card">
        <div class="card-status-top bg-blue"></div>
        @if($all->total() != 0)

        <div class="card-header">
            <h3 class="card-title">Silinen Hizmetler Listesi [{{ $all->total()}}]</h3>
            <div class="card-actions d-flex">
                
                <div class="p-1">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark">
                        <x-dashboard.icon.back/>
                        Geri
                    </a>
                </div>
            
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Img</th>
                        <th>AD</th>
                        <th>Kategori</th>
                        <th>Silme Tarihi</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all as $item)
                    <tr>
                        <td>
                            <img src="{{ $item->getFirstMediaUrl('page', 'thumb')}}" class="avatar me-2">
                        </td>
                        <td>
                            <a href="{{ route('service.edit',$item->id)}}" title="Düzenle">
                                {{$item->name}}
                            </a>
                        </td>

                        <td class="text-secondary">
                            {{ $item->getCategory->name }}
                        </td>
                        <td class="text-secondary" title="{{ $item->deleted_at }}">
                            {{ $item->deleted_at->diffForHumans() }}
                        </td>
                        <td>
                            <a href="{{ route('service.restore', $item->id) }}" class="btn btn-success">Geri Yükle</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          
        </div>
        
        @else
            <x-dashboard.site.not-trash route="page"/>
        @endif


    </div>
  
</div>


@endsection