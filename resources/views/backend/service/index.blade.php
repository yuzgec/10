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
                    @foreach ($categories->where('parent_id',2) as $item)
                    <tr>
                        <td>
                            <img src="{{ $item->getFirstMediaUrl('page', 'small')}}" class="avatar me-2">
                        </td>
                        <td>
                            <a href="{{ route('category.edit',$item->id)}}" title="Düzenle">
                                {{$item->name}} <small>[{{ $item->services_count}}]</small>
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
            <h3 class="card-title">Hizmet Listesi [{{ $all->total()}}]</h3>
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
                    <a href="{{ route('service.index')}}" class="btn btn-icon" title="Sayfayı Yenile">
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
                    <a href="{{ route('service.create')}}" title="sayfa Oluştur" class="btn btn-primary">
                        <x-dashboard.icon.add/>
                        Ekle
                    </a>
                </div>

            </div>
        </div>

        <div class="table-responsive">
        <table class="table table-vcenter card-table table-striped table-hover" id="sortableTable">
            <thead>
                    <tr>
                        <th>Img</th>
                        <th>AD</th>
                        <th>Kategori</th>
                        <th>Durum</th>
                        <th class="w-1"></th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all as $item)
                    <tr data-id="{{ $item->id }}">
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
                        <td class="text-secondary">
                            <div class="d-flex align-items-center">
                            <x-dashboard.icon.status  status='{{$item->status->color() }}'/>
                            {{$item->status->title() }}
                            </div>
                        </td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#silmeonayi{{ $item->id }}" title="Sayfa Sil">
                                <x-dashboard.icon.delete color="red" />
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('service.edit',$item->id)}}" title="Düzenle"><x-dashboard.icon.edit/></a>
                        </td>
                    </tr>
                    <div class="modal modal-blur fade" id="silmeonayi{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Silme Onayı</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Silmek üzeresiniz. Bu işlem geri alınmamaktadır.
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" /></svg>
                                        İptal Et
                                    </a>
                                    <form action="{{ route('service.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm ms-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                            Silmek İstiyorum
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
          
        </div>
        
        @else
            <x-dashboard.site.not-found route="service"/>
        @endif
    </div>
</div>
@endsection

@section('customJS')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('sortableTable');

            new Sortable(table.querySelector('tbody'), {
                handle: 'td', // Drag handle
                animation: 150,
                onEnd: function (evt) {
                    const rows = table.querySelectorAll('tr');
                    let order = Array.from(rows).map(row => row.dataset.id);

                    fetch('{{ route('service.sort') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ order: order })
                    }).then(response => response.json());
                }
            });
        });
    </script>
@endsection