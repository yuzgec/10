@props(['model'])
<td>
    <a data-fslightbox="gallery" href="{{ $model->getFirstMediaUrl('page', 'thumb')}}">
        <img src="{{ $model->getFirstMediaUrl('page', 'icon')}}" class="avatar me-2">
    </a>
</td>