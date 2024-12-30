@props(['model'])
<td class="text-secondary">
    <div class="d-flex align-items-center">
    <x-dashboard.icon.status  status='{{$model->status->color() }}'/>
    {{$model->status->title() }}
    @if ($model->status->value == 2)
        <div style="margin-top: px">
            <small class="badge bg-{{$model->status->color() }} text-white">
                {{ $model->publish_date}}
            </small>
        </div>
    @endif
    </div>
</td>