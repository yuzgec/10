@php
    // Noktalı syntax için error kontrolü
    $hasError = str_contains($name, '.') 
        ? $errors->has(str_replace(['.', '[]', '[', ']'], ['.*', '', '.', ''], $name))
        : $errors->has($name);
@endphp

<div class="form-group mb-3 row">
    <label class="form-label col-{{$column}} col-form-label {{ $required ? 'required' : '' }}">{{$label}}</label>
    <div class="col">
        @if($icon)
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <x-dynamic-component :component="$componentName" width="16" height="16" />
                </span>
                {!! Html::text($name)
             ->class([$class, $errors->has($name) ? 'is-invalid' : ''])
                    ->placeholder($placeholder)
                    ->attribute('maxlength', $maxlength ?? null)
                    ->id($id) 
                !!}
            </div>
        @else
            {!! Html::text($name)
                ->class([$class, $errors->has($name) ? 'is-invalid' : ''])
                ->placeholder($placeholder)
                ->attribute('maxlength', $maxlength ?? null)
                ->id($id) !!}
        @endif
            
        @if($hasError)
            <div class="invalid-feedback" style="display: block">
                {{ str_contains($name, '.') 
                    ? $errors->first(str_replace(['.', '[]', '[', ']'], ['.*', '', '.', ''], $name))
                    : $errors->first($name) }}
            </div>
        @endif
        
        @if($maxlength > 0)
            <small class="charCount character-count" style="float: right"></small>
        @endif
    </div>
</div>