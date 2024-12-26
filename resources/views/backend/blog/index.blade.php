@extends('backend.layout.app')
@section('content')

<x-dashboard.site.index-category-widget :cat="$cat" count="blogs_count"/>

<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-status-top bg-blue"></div>
        @if($all->total() != 0)

             <div class="card-header">
            <h3 class="card-title">Bloglar [{{ $all->total()}}]</h3>
            <div class="card-actions d-flex">
                <div class="d-none d-sm-inline-block p-1">
                    <form>
                        <div class="input-icon mb-3">
                            <input type="text" class="form-control" name="q" placeholder="Arama" value="{{ request('q')}}">
                            <span class="input-icon-addon">
                                <x-dashboard.icon.search/>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="d-none d-sm-inline-block p-1">
                    <form>
                        <select class="form-select" name="category_id" onchange="location = this.value;">
                            <option value="?category_id=0" {{ request('category_id') == 0 ? 'selected' :  null}}>Hepsi</option>
                            @foreach ($categories->where('parent_id',3) as $item)
                                <option value="?category_id={{ $item->id}}" {{ request('category_id') == $item->id ? 'selected' :  null}}>{{ $item->name}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                @if(request('q'))
                <div class="p-1">
                    <a href="{{ route('blog.index')}}" class="btn btn-icon" title="Sayfayı Yenile">
                        <x-dashboard.icon.refresh/>
                    </a>
                </div>
                @endif
                <div class="p-1">
                    <a href="{{ url()->previous() }}" class="btn btn-icon">
                        <x-dashboard.icon.back/>
                    </a>
                </div>
                <div class="p-1">
                    <a href="{{ route('blog.create')}}" title="Blog Oluştur" class="btn btn-icon btn-primary" >
                        <x-dashboard.icon.add/>
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
                            <a data-fslightbox="gallery" href="{{ $item->getFirstMediaUrl('page', 'thumb')}}">
                                <img src="{{ $item->getFirstMediaUrl('page', 'thumb')}}" class="avatar me-2">
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('blog.edit',$item->id)}}" title="Düzenle">
                                {{$item->name}}
                            </a>
                        </td>
                        <td class="text-secondary">
                            <a href="{{ route('category.edit', $item->getCategory->id) }}" title=" {{ $item->getCategory->id}} - Düzenle">
                            {{ $item->getCategory->name }}
                            </a>
                        </td>
                        <td class="text-secondary">
                            <div class="d-flex align-items-center">
                            <x-dashboard.icon.status  status='{{$item->status->color() }}'/>
                                <div class="flex-column-reverse">
                                    {{$item->status->title() }}
                                    @if ($item->status->value == 2)
                                        <div style="margin-top: px">
                                            <small class="badge bg-{{$item->status->color() }} text-white">
                                                {{ $item->publish_date}}
                                            </small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#silmeonayi{{ $item->id }}" title="Sayfa Sil">
                                <x-dashboard.icon.delete color="red" />
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('blog.edit',$item->id)}}" title="Düzenle"><x-dashboard.icon.edit/></a>
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
                                    <form action="{{ route('blog.destroy', $item->id) }}" method="POST">
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
          
               
            <div class="d-flex align-items-center justify-content-center mt-2">
                {{ $all->appends(['siralama' => 'blog', 'q' => request('q'), 'category_id' => request('category_id')])->links() }}
            </div>

        </div>
        
        @else
            <x-dashboard.site.not-found route="blog"/>
        @endif


    </div>
    
    <x-dashboard.charts.view-stats model="App\Models\Blog" title="En Çok Bakılan Haberler" :category-id="request('category_id', null)" :limit="10" />

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

                    fetch('{{ route('blog.sort') }}', {
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