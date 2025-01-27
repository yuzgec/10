@props(['model', 'count' => 0])
<td>
    <div class="avatar-list avatar-list-stacked">
        <a data-fslightbox="gallery" href="{{ $model->getFirstMediaUrl('page', 'thumb')}}">
            <img src="{{ $model->getFirstMediaUrl('page', 'icon')}}">
        </a>
        @if($count > 0)
            <span class="avatar avatar-sm rounded">+{{ $count }}</span>
        @endif
    </div>
</td>
