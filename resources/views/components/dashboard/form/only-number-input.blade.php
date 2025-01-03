@php $componentName = "dashboard.icon.$icon" @endphp

<div>
    @if($icon)
    <div class="input-icon mb-3">
        <span class="input-icon-addon">
            <x-dynamic-component :component="$componentName" width="16" height="16" />
        </span>
        {!! Html::text($name)
            ->class($class . ($errors->has($name) ? ' is-invalid' : ''))
            ->placeholder($placeholder)
            ->id($id)
            ->attributes([
                'type' => 'number',
                'min' => $min ?? null,
                'max' => $max ?? null,
                'step' => $step ?? '0.01'
            ]) !!}
    </div>
    @else
    {!! Html::text($name)
        ->class($class . ($errors->has($name) ? ' is-invalid' : ''))
        ->placeholder($placeholder)
        ->id($id)
        ->attributes([
            'type' => 'number',
            'min' => $min ?? null,
            'max' => $max ?? null,
            'step' => $step ?? '0.01'
        ]) !!}
    @endif

    @if($errors->has($name))
        <div class="invalid-feedback" style="display: block">
            {{ $errors->first($name) }}
        </div>
    @endif
</div> 