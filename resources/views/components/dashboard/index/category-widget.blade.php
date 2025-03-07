@props(['cat', 'count' => 0, 'slug','name'])

<div class="col-12 col-md-3 d-none d-sm-inline-block ">
    <div class="card">
        <div class="card-status-top bg-blue"></div>
        <div class="card-header">
            <h3 class="card-title"><x-dashboard.icon.category/> Kategori</h3>
            <div class="card-actions d-flex">
                <div class="p-1">
                    <a  href="{{ route('category.index',['q' => $slug, 'name' => $name])}}" 
                        title="Kategori Oluştur" 
                        class="btn btn-primary btn-icon">
                        <x-dashboard.icon.add width="16" height="16"/>
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
                            <img src="{{ $item->getFirstMediaUrl('page', 'icon')}}" class="avatar me-2">
                        </td>
                        <td>
                            <a href="{{ route('category.edit',$item->id)}}" title="{{$item->name}} - Düzenle">
                                {{$item->name}} <small>[{{ $item->$count }}]</small>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('category.edit',$item->id)}}" title="{{$item->name}} - Düzenle">
                                <x-dashboard.icon.edit/>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>