@props(['model', 'route'])
<td>
    <a href="{{ route($route.'.edit',$model->id)}}" title="{{$model->name}} - Düzenle">
        {{$model->name}}
    </a>
</td>