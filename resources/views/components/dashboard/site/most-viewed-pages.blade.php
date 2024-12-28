@props(['pages'])

<div class="card mb-3 card-link card-link-pop bg-primary-lt">
    <div class="card-status-top bg-primary"></div>
    <div class="card-header">
        <h3 class="card-title">Top Pages</h3>
    </div>
    <div class="card-body">
       
        <table class="table table-sm table-borderless">
            <thead>
                <tr>
                    <th>Sayfa</th>
                    <th class="text-end">Görüntülenme</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td>
                            <div class="progressbg">
                                <div class="progress progressbg-progress">
                                    <div class="progress-bar bg-primary-lt" 
                                         style="width: {{ number_format($page['percentage'], 2) }}%" 
                                         role="progressbar" 
                                         aria-valuenow="{{ $page['percentage'] }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                        <span class="visually-hidden">{{ number_format($page['percentage'], 2) }}% Complete</span>
                                    </div>
                                </div>
                                <div class="progressbg-text" title="{{$page['name']}}">/{{ substr($page['url'],0,15); }}</div>
                            </div>
                        </td>
                        <td class="w-1 fw-bold text-end">{{ $page['views'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> 