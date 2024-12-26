@props(['cat', 'count' => 0])

<div class="col-12 col-md-3 d-none d-sm-inline-block ">
    <div class="card">
        <div class="card-status-top bg-blue"></div>
        <div class="card-header">
            <h3 class="card-title">Kategoriler</h3>
            <div class="card-actions d-flex">

                <div class="p-1">
                    <a href="{{ route('category.index',['q' => 'hizmet', 'name' => 'Hizmetler'])}}" title="Kategori Oluştur" class="btn btn-primary">
                        <x-dashboard.icon.add width="16" height="16"/>
                        Ekle
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
               
                    @foreach ($cat as $item)
                    <tr>
                        <td>
                            <img src="{{ $item->getFirstMediaUrl('page', 'small')}}" class="avatar me-2">
                        </td>
                        <td>
                            <a href="{{ route('category.edit',$item->id)}}" title="Düzenle">
                                {{$item->name}} <small>[{{ $item->$count }}]</small>
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