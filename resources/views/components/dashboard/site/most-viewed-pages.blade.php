@props(['pages'])

<div class="card mb-3 card-link card-link-pop">
    <div class="card-status-top bg-primary"></div>
    <div class="card-header">
        <h3 class="card-title"><x-dashboard.icon.star/> Popüler Sayfalar</h3>
        <div class="card-actions">
            <div class="dropdown">
                <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <x-dashboard.icon.language/>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    @php
                        $currentLocale = app()->getLocale();
                    @endphp
                    @foreach($language as $lang)
                        <a class="dropdown-item {{ $currentLocale === $lang->lang ? 'active' : '' }}" 
                           href="{{ request()->fullUrlWithQuery(['locale' => $lang->lang]) }}">
                            {{ $lang->native }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
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
                                        <span class="visually-hidden">{{ number_format($page['percentage'], 2) }}%</span>
                                    </div>
                                </div>
                                <div class="progressbg-text" title="{{ $page['name'] }}">
                                    {{ Str::limit($page['name'], 20) }}
                                </div>
                            </div>
                        </td>
                        <td class="w-1 fw-bold text-end">{{ $page['views'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> 