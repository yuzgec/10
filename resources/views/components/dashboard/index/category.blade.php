@props(['model'])
<td class="text-secondary">
    <a href="{{ route('category.edit', $model->getCategory->slug) }}" title=" {{ $model->getCategory->id}} - Düzenle">
    {{ $model->getCategory->name }}
    </a>
</td>