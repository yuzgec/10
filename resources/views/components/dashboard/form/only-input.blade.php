
<div>
    {!! Html::text($name)
        ->class($class . ($errors->has($name) ? ' is-invalid' : ''))
        ->placeholder($placeholder)
        ->id($id) !!}

    @if($errors->has($name))
        <div class="invalid-feedback" style="display: block">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>