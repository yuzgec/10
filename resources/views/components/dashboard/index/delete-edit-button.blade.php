@props(['model', 'route'])
<td>
    <a data-bs-toggle="modal" data-bs-target="#silmeonayi{{ $model->id }}" title="Sayfa Sil">
        <x-dashboard.icon.delete color="red" />
    </a>
</td>
<td>
    <a href="{{ route($route.'.edit',$model->id)}}" title="Düzenle"><x-dashboard.icon.edit/></a>
</td>