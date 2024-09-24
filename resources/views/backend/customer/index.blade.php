@extends('backend.layout.app') @section('content')

<div class="col-12">
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Müşteri Listesi [{{ $all->total()}}]</h3>
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
                    <a href="{{ route('customer.index')}}" class="btn btn-icon" title="Sayfayı Yenile">
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
                    <a href="{{ route('customer.create')}}" title="sayfa Oluştur" class="btn btn-primary">
                        <x-dashboard.icon.add/>
                        Ekle
                    </a>
                </div>

                <div class="p-1 d-none d-sm-inline-block ">
                    <a href="{{ route('customer.export')}}" title="sayfa Oluştur" class="btn btn-primary ">
                        <x-dashboard.icon.pdf/>
                        İndir
                    </a>
                </div>

            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Firma</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Teklif</th>
                        <th>İş</th>
                        <th>Durum</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all as $item)

                    <tr>
                        <td>
                            <img src="./static/avatars/010m.jpg" class="avatar me-2">
                        </td>
                        <td>
                            <a href="{{ route('customer.edit',$item->id)}}" title="Düzenle">
                                {{$item->company_name}}
                            </a>
                        </td>
                        <td class="text-secondary">
                            {{ $item->email}}
                        </td>
                        <td class="text-secondary">
                            {{ $item->phone1}}
                        </td>

                        <td class="text-white">
                            <a href="{{ route('offer.index',['name' => 'offer','customer_id' => $item->id])}}" title="Tekliflere Git">
                                <span class="avatar bg-black text-white">{{ $item->offers_count}}</span>
                            </a>
                        </td>

                        <td class="text-secondary">
                            <a href="{{ route('works.index',['name' => 'work', 'customer_id' => $item->id])}}" title="İşlere Git">
                                <span class="avatar">{{ $item->works_count}}</span>
                            </a>
                        </td>

                        <td class="text-secondary">
                            {{$item->status->title()}}
                        </td>

                        <td>
                            <a href="{{ route('customer.edit',$item->id)}}" title="Düzenle">Düzenle</a>
                        </td>
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
@endsection