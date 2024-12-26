@extends('backend.layout.app') @section('content')

<x-dashboard.site.index-category-widget :cat="$cat" count="faqs_count"/>

<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-status-top bg-blue"></div>
        @if($all->total() != 0)

        <div class="card-header">
            <h3 class="card-title">S.S.S Listesi [{{ $all->total()}}]</h3>
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
                    <a href="{{ route('faq.index')}}" class="btn btn-icon" title="Sayfayı Yenile">
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
                    <a href="{{ route('faq.create')}}" title="S.S.S. Oluştur" class="btn btn-primary">
                        <x-dashboard.icon.add/>
                        Ekle
                    </a>
                </div>

            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
                <thead>
                    <tr>
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
                            <a href="{{ route('faq.edit',$item->id)}}" title="Düzenle">
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
                            <a href="{{ route('faq.edit',$item->id)}}" title="Düzenle"><x-dashboard.icon.edit/></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          
        </div>

        @else
            <x-dashboard.site.not-found route="faq"/>
        @endif

    </div>
  
</div>


@endsection