@extends('backend.layout.app') @section('content')

<div class="col-12 col-md-3">
    <div class="card">
        <div class="card-status-top bg-blue"></div>
        <div class="card-header">
            <h3 class="card-title">Kategoriler</h3>
            <div class="card-actions d-flex">

                <div class="p-1">
                    <a href="{{ route('category.create')}}" title="sayfa Oluştur" class="btn btn-primary">
                        <x-dashboard.icon.add/>
                       Kategori Ekle
                    </a>
                </div>

            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped table-hover">
                <thead>
                    <tr>
                        <th>IMG</th>
                        <th>AD</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories->where('parent_id',7) as $item)
                    <tr>
                        <td>
                            <img src="{{ $item->getFirstMediaUrl('page', 'small')}}" class="avatar me-2">
                        </td>
                        <td>
                            <a href="{{ route('category.edit',$item->id)}}" title="Düzenle">
                                {{$item->name}} <small>[{{ $item->pages_count}}]</small>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('category.edit',$item->id)}}" title="Düzenle"><x-dashboard.icon.edit/></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>
<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-status-top bg-blue"></div>
        @if($all->total() != 0)

        <div class="card-header">
            <h3 class="card-title">Ürün Listesi [{{ $all->total()}}]</h3>
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
                    <a href="{{ route('page.index')}}" class="btn btn-icon" title="Sayfayı Yenile">
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
                <div class="p-1">
                    <a href="{{ route('page.create')}}" title="sayfa Oluştur" class="btn btn-primary">
                        <x-dashboard.icon.add/>
                        Ekle
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
                        <th>Durum</th>
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
                            <a href="{{ route('product.edit',$item->id)}}" title="Düzenle">
                                {{$item->name}}
                            </a>
                        </td>

                        <td class="text-secondary">
                            {{ $item->getCategory->name }}
                        </td>
                        <td class="text-secondary">
                            <div class="d-flex align-items-center">
                            <x-dashboard.icon.status  status='{{$item->status->color() }}'/>
                            {{$item->status->title() }}
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('page.edit',$item->id)}}" title="Düzenle"><x-dashboard.icon.edit/></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          
        </div>
        
        @else
            <x-dashboard.site.not-found route="product"/>
        @endif


    </div>
  
</div>


@endsection