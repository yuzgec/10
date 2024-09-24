<div class="col-12">
    <div class="card">
        <div class="card-status-top bg-blue"></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Etkinlik</th>
                            <th>AD</th>
                            <th>Değişim Zamanı</th>
                            <th>Kullanıcı</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td>{{ __('activitylog.log.' . $activity->description) }}</td>
                                @if (isset($activity->changes['attributes']))
                                <td>
                                    @foreach ($activity->changes['attributes'] as $attribute => $value)
                                        <strong>{{ __('activitylog.log.' . $attribute) }}</strong>: {{ $value}}
                                    <br/>
                                    @endforeach
                                </td>
                                @else
                                <td></td>
                                @endif
                              
                                <td class="text-secondary" title="{{ $activity->created_at->diffForHumans()}}">
                                    {{ $activity->created_at }} 
                                </td>
                                <td>
                                    @if($activity->causer)
                                        {{ $activity->causer->name }}
                                    @else
                                        {{ 'GO Admin' }}
                                    @endif
                                </td>
                                <td class="text-secondary"></td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
              
            </div>
            
        </div>
    </div>
</div>