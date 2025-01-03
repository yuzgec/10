@props([
    'name',
    'label',
    'column' => 3,
    'class' => 'form-select',
    'placeholder' => 'Seçiniz',
    'icon' => null,
    'options' => [],
    'selected' => null,
    'multiple' => false
])

@php $componentName = "dashboard.icon.$icon" @endphp

<div class="form-group mb-3 row">
    <div class="col">
        @if($icon)
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <x-dynamic-component :component="$componentName" width="16" height="16" />
                </span>
                <select name="{{ $name }}{{ $multiple ? '[]' : '' }}" 
                        class="{{ $class }} {{ $errors->has($name) ? 'is-invalid' : '' }}"
                        {{ $multiple ? 'multiple' : '' }}
                        {{ $attributes }}>
                    @if(!$multiple)
                        <option value="">{{$label}} {{ $placeholder }}</option>
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
            </div>
        @else
            <select name="{{ $name }}{{ $multiple ? '[]' : '' }}" 
                    class="{{ $class }} {{ $errors->has($name) ? 'is-invalid' : '' }}"
                    {{ $multiple ? 'multiple' : '' }}
                    {{ $attributes }}>
                @if(!$multiple)
                    <option value="">{{ $label }} {{ $placeholder }}</option>
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
        @endif

        @if($errors->has($name))
            <div class="invalid-feedback" style="display: block">
                {{ $errors->first($name) }}
            </div>
        @endif
    </div>
</div>