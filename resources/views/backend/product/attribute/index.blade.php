@extends('backend.layout.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ürün Özellikleri</h3>
                <div class="card-actions">
                    <a href="{{ route('product-attributes.create') }}" class="btn btn-primary">
                        <x-dashboard.icon.add /> Yeni Ekle
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Özellik Adı</th>
                                <th>Tip</th>
                                <th>Değerler</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attributes as $attribute)
                                <tr>
                                    <td>
                                        {{ $attribute->translations->where('locale', app()->getLocale())->first()->name ?? '' }}
                                    </td>
                                    <td>
                                        <span class="badge {{ $attribute->type->badge() }}">
                                            {{ $attribute->type->label() }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($attribute->values as $value)
                                                @if($attribute->type === 'color')
                                                    <span class="badge" style="background-color: {{ $value->color_code }}">
                                                        {{ $value->value }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-blue-lt">{{ $value->value }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('product-attributes.edit', $attribute->id) }}" 
                                               class="btn btn-icon btn-outline-primary">
                                                <x-dashboard.icon.edit />
                                            </a>
                                            <form action="{{ route('product-attributes.destroy', $attribute->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Emin misiniz?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-outline-danger">
                                                    <x-dashboard.icon.delete />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Henüz özellik eklenmemiş</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    {{ $attributes->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection 