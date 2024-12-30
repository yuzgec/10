@extends('backend.layout.app') 
@section('content')

    <x-dashboard.index.category-widget :cat="$cat" count="teams_count" slug="ekip" name="Ekip Üyesi"/>

    <div class="col-12 col-md-9">
        <div class="card">
            <div class="card-status-top bg-blue"></div>
            @if($all->total() != 0)

            <x-dashboard.index.card-header 
                :all='$all' 
                route='team'
                category='ekip' 
                name='Ekip'
            />
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped table-hover" id="sortableTable">
                    
                    <thead>
                        <tr>
                            <th>Img</th>
                            <th>Ad</th>
                            <th>Kategori</th>
                            <th>Durum</th>
                            <th class="w-1"></th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($all as $item)
                        <tr data-id="{{ $item->id }}">
                            <x-dashboard.index.image :model="$item" />

                            <x-dashboard.index.name :model="$item" route="team"/>

                            <x-dashboard.index.category :model="$item"/>

                            <x-dashboard.index.status :model="$item"/>

                            <x-dashboard.index.delete-edit-button :model="$item" route="team"/>

                        </tr>

                        <x-dashboard.index.delete-modal :model="$item" route="team"/>

                        @endforeach

                    </tbody>
                </table>

                <div class="d-flex align-items-center justify-content-center mt-2">
                    {{ $all->appends(['siralama' => 'team', 'q' => request('q'), 'category_id' => request('category_id')])->links() }}
                </div>
            
            </div>
            
            @else
                <x-dashboard.site.not-found route="team"/>
            @endif

        </div>

        <x-dashboard.charts.view-stats 
            model="App\Models\Team" 
            title="En Çok Bakılan Haberler" 
            :category-id="request('category_id', null)" 
            :limit="10"
        />

    </div>
@endsection

@section('customJS')
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initSortable('{{ route('team.sort') }}');
        });
    </script>
@endpush
@endsection