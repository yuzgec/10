@props([
    'type' => 'text',
    'name',
    'label',
    'column' => 3,
    'class' => 'form-control',
    'placeholder' => '',
    'icon' => null,
    'id' => null,
    'maxlength' => 75,
    'options' => [],
    'selected' => null,
    'multiple' => false
])

@php $componentName = "dashboard.icon.$icon" @endphp

<div class="form-group mb-3 row">
    <label class="form-label col-{{$column}} col-form-label">{{$label}}</label>
    <div class="col">
        @if($icon)
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <x-dynamic-component :component="$componentName" width="16" height="16" />
                </span>
                @if($type === 'select')
                    <select name="{{ $name }}{{ $multiple ? '[]' : '' }}" 
                            class="{{ $class }} {{ $errors->has($name) ? 'is-invalid' : '' }}"
                            {{ $multiple ? 'multiple' : '' }}
                            {{ $attributes }}>
                        @if(!$multiple)
                            <option value="">{{ $placeholder }}</option>
                        @endif
                        @foreach($options as $option)
                            <option value="{{ $option->id }}" 
                                    {{ $multiple 
                                        ? (is_array($selected) && in_array($option->id, $selected) ? 'selected' : '')
                                        : ($selected == $option->id ? 'selected' : '') }}>
                                {{ $option->name }}
                            </option>
                        @endforeach
                    </select>
                @else
                    {!! Html::$type($name)
                        ->class($class . ($errors->has($name) ? ' is-invalid' : ''))
                        ->placeholder($placeholder)
                        ->attribute('maxlength', $maxlength ?? null)
                        ->id($id) !!}
                @endif
            </div>
        @else
            @if($type === 'select')
                <select name="{{ $name }}{{ $multiple ? '[]' : '' }}" 
                        class="{{ $class }} {{ $errors->has($name) ? 'is-invalid' : '' }}"
                        {{ $multiple ? 'multiple' : '' }}
                        {{ $attributes }}>
                    @if(!$multiple)
                        <option value="">{{ $placeholder }}</option>
                    @endif
                    @foreach($options as $option)
                        <option value="{{ $option->id }}" 
                                {{ $multiple 
                                    ? (is_array($selected) && in_array($option->id, $selected) ? 'selected' : '')
                                    : ($selected == $option->id ? 'selected' : '') }}>
                            {{ $option->name }}
                        </option>
                    @endforeach
                </select>
            @else
                {!! Html::$type($name)
                    ->class($class . ($errors->has($name) ? ' is-invalid' : ''))
                    ->placeholder($placeholder)
                    ->attribute('maxlength', $maxlength ?? null)
                    ->id($id) !!}
            @endif
        @endif
            
        @if($errors->has($name))
            <div class="invalid-feedback" style="display: block">
                {{ $errors->first($name) }}
            </div>
        @endif
        
        @if($maxlength > 0)
            <small class="charCount character-count" style="float: right"></small>
        @endif
    </div>
</div>
