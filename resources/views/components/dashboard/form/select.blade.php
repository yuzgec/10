@props([
    'label' => '',       // Label text for the select element
    'name' => '',        // Name attribute of the select element
    'options' => [],     // Array of options (key => value pairs)
    'selected' => [],    // Array of selected values
    'multiple' => false, // Whether the select allows multiple values
])

<div class="form-group">
    @if($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <select 
        name="{{ $name }}" 
        id="{{ $name }}" 
        class="form-control" 
        {{ $multiple ? 'multiple' : '' }}
    >
        @foreach($options as $key => $value)
            <option 
                value="{{ $key }}" 
                {{ in_array($key, (array) $selected) ? 'selected' : '' }}
            >
                {{ $value }}
            </option>
        @endforeach
    </select>
</div>