@extends('backend.layout.app')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row g-0">
            <div class="card">
                <div class="card-status-top bg-blue"></div>
                <div class="card-header">
                    <h3 class="card-title"><x-dashboard.icon.settings/>Ayarlar</h3>
                    <div class="card-actions">
                        <a href="#" class="btn btn-primary btn-icon">
                            <x-dashboard.icon.add/>
                        </a>
                    </div>
                </div>
                <div class="card-body d-flex">
                    <div class="col-md-3">
                        <ul class="nav flex-column nav-tabs me-3" data-bs-toggle="tabs" role="tablist">
                            <div class="card">
                                @foreach($categories->where('parent_id', 8) as $category)
                                <li class="nav-item" role="presentation">
                                    <a href="#category-{{ $category->id }}" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1" class="card card-link card-link-pop @if($loop->first) active @endif" >
                                        <div class="card-body">{{ $category->name }}</div>
                                    </a>
                                </li>
                                @endforeach
                            </div>
                        </ul>
                    </div>
                    <div class="col-md-9">
                    <!-- Tab İçeriği -->
                        <div class="tab-content flex-grow-1">
                            @foreach($categories->where('parent_id', 8)  as $category)
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="category-{{ $category->id }}">
                                <div class="card ">
                                    <table class="table table-vcenter card-table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Anahtar</th>
                                                <th></th>
                                                <th>Eylem</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($settings->where('category_id', $category->id) as $setting)
                                            <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                            <tr>
                                                <td>{{ $setting->item }}</td>
                                                <td>
                                                    @switch($setting->isType->value)
                                                        @case(\App\Enums\SettingsEnum::INPUT->value)
                                                            <input type="text" name="value" value="{{ $setting->value }}" class="form-control">
                                                            @break
                                                        @case(\App\Enums\SettingsEnum::TEXTAREA->value)
                                                            <textarea name="value" class="form-control">{{ $setting->value }}</textarea>
                                                            @break
                                                        @case(\App\Enums\SettingsEnum::CHECKBOX->value)
                                                        @case(\App\Enums\SettingsEnum::BOOLEAN->value)
                                                            <label class="form-check form-switch">
                                                                <input class="form-check-input" name="value" value="1" type="checkbox" {{ $setting->value ? 'checked' : '' }} wfd-id="id148">
                                                            </label>
                                                            @break
                                                        @case(\App\Enums\SettingsEnum::PASSWORD->value)
                                                            <input type="password" name="value" value="{{ $setting->value }}" class="form-control">
                                                            @break
                                                        @case(\App\Enums\SettingsEnum::FILE->value)
                                                            <input type="file" name="value" class="form-control">
                                                            @if($setting->value)
                                                                <div class="mt-2">{{ $setting->value }}</div>
                                                            @endif
                                                            @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary btn-icon"><x-dashboard.icon.edit/></button>
                                                </td>
                                            </tr>
                                            </form>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection