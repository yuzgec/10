@extends('backend.layout.app')
@section('content')

<div class="col-12">
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Ödeme Listesi</h3>
            <div class="card-actions d-flex">
                <div class="d-none d-sm-inline-block  p-1">
                    <input class="form-control" type="text" name="" placeholder="Ara"/>
                </div>
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
                        <th>Durum</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all as $item)

                    <tr>
                        <td>
                            <a href="{{ route('customer.edit',$item->id)}}" title="Düzenle">
                                {{$item->name}}
                            </a>
                        </td>
                        <td class="text-secondary">
                            {{ $item->offer}}
                        </td>
                        
                        <td>

                            @if($item->send_mail == false)
                              Mesaj Gönder
                              @else
                              Gönderildi  
                              @endif
                        </td>

                        <td>
                            <a href="{{ route('customer.edit',$item->id)}}" title="Düzenle">Düzenle</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection