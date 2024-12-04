@extends('backend.layout.app')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row g-0">
            <!-- Sol Taraf: Tab Bar -->
            <div class="col-12 col-md-3 border-end">
                <div class="card-body">
                    <h4 class="subheader">Ayarlar</h4>
                    <div class="list-group list-group-transparent">
                        @foreach($categories->where('id', 8) as $category)
                        <a href="#category-{{ $category->id }}" class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="tab">
                            {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Sağ Taraf: Tab İçerikleri -->
            <div class="col-12 col-md-9 d-flex flex-column">
                <div class="tab-content">
                @foreach($categories->where('id', 8) as $category)
                <div class="tab-pane fade" id="category-{{ $category->id }}">
                        <div class="card-body">
                            <h2 class="mb-4">{{ $category->name }}</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Value</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($settings->where('category_id', $category->id) as $setting)
                                    <tr>
                                        <td>{{ $setting->item }}</td>
                                        <td>
                                            @if($setting->isImage)
                                            <img src="{{ asset('storage/' . $setting->value) }}" alt="{{ $setting->item }}" width="50">
                                            @else
                                            {{ $setting->value }}
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                @if($setting->isType == \App\Enums\SettingsEnum::INPUT)
                                                <input type="text" name="value" value="{{ $setting->value }}" class="form-control">
                                                @elseif($setting->isType == \App\Enums\SettingsEnum::TEXTAREA)
                                                <textarea name="value" class="form-control">{{ $setting->value }}</textarea>
                                                @elseif($setting->isType == \App\Enums\SettingsEnum::CHECKBOX)
                                                <input type="checkbox" name="value" value="1" {{ $setting->value ? 'checked' : '' }}>
                                                @endif

                                                @if($setting->isImage)
                                                <input type="file" name="image" class="form-control mt-2">
                                                @endif

                                                <button type="submit" class="btn btn-primary mt-2">Update</button>
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

    <!-- Create Modal -->
    <div class="modal fade" id="createSettingModal" tabindex="-1" aria-labelledby="createSettingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createSettingModalLabel">Yeni Ayar Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-label">Item</div>
                    <input type="text" name="item" class="form-control" required>
                    
                    <div class="form-label mt-3">Category</div>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <div class="form-label mt-3">Type</div>
                    <select name="isType" class="form-control" required>
                        <option value="{{ \App\Enums\SettingsEnum::INPUT }}">Input</option>
                        <option value="{{ \App\Enums\SettingsEnum::TEXTAREA }}">Textarea</option>
                        <option value="{{ \App\Enums\SettingsEnum::CHECKBOX }}">Checkbox</option>
                    </select>

                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" name="isImage" id="isImage">
                        <label class="form-check-label" for="isImage">Is Image?</label>
                    </div>

                    <div class="form-label mt-3">Value</div>
                    <input type="text" name="value" class="form-control">
                    <input type="file" name="image" class="form-control mt-2">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection