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
                                    <a href="#category-{{ $category->id }}" class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                                        <span class="p-2">{{ $category->name }}</span>
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
                                <div class="card table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>Anahtar</th>
                                                <th>Değer</th>
                                                <th></th>
                                                <th>Eylem</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($settings->where('category_id', $category->id) as $setting)
                                            <tr>
                                                <td>{{ $setting->item }}</td>
                                                <td>
                                                    @if($setting->isImage)
                                                    <img src="{{ asset('storage/' . $setting->value) }}" alt="{{ $setting->item }}" width="50">
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        @switch($setting->isType->value)
                                                            @case(\App\Enums\SettingsEnum::INPUT->value)
                                                                <input type="text" name="value" value="{{ $setting->value }}" class="form-control">
                                                                @break
                                                            @case(\App\Enums\SettingsEnum::TEXTAREA->value)
                                                                <textarea name="value" class="form-control">{{ $setting->value }}</textarea>
                                                                @break
                                                            @case(\App\Enums\SettingsEnum::CHECKBOX->value)
                                                            @case(\App\Enums\SettingsEnum::BOOLEAN->value)
                                                                <input type="checkbox" name="value" value="1" {{ $setting->value ? 'checked' : '' }}>
                                                                @break
                                                            @case(\App\Enums\SettingsEnum::PASSWORD->value)
                                                                <input type="password" name="value" value="{{ $setting->value }}" class="form-control">
                                                                @break
                                                            @case(\App\Enums\SettingsEnum::FILE->value)
                                                                <input type="file" name="value" class="form-control">
                                                                @if($setting->value)
                                                                    <div class="mt-2">Mevcut dosya: {{ $setting->value }}</div>
                                                                @endif
                                                                @break
                                                        @endswitch

                                                        @if($setting->isImage)
                                                        <input type="file" name="image" class="form-control mt-2">
                                                        @endif

                                                </td>
                                                <td>
                                                    
                                                    <button type="submit" class="btn btn-primary btn-icon"><x-dashboard.icon.edit/></button>
                                                </form>
                                                </td>
                                            </tr>
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