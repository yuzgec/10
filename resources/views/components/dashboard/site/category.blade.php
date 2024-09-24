<div class="card">
    <div class="card-status-top bg-blue"></div>
    <div class="card-header">
        <h4 class="card-title"><x-dashboard.icon.star/> Kategori </h4>
    </div>
    <div class="card-body">
        <select class="form-select tomselected {{$errors->has('category_id') ? 'is-invalid'  : ''}}" name="category_id">
            @foreach ($categories->where('parent_id',$parent) as $item)
            <option value="{{ $item->id}}" {{ ($item->id == $category) ? 'selected' : null}}> {{ $item->name}}</option>
            @endforeach
        </select>
        @if ($errors->has('category_id'))
        <div class="invalid-feedback">{{$errors->first('category_id')}}</div>
        @endif

    </div>
</div>