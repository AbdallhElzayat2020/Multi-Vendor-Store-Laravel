@props([
    'name', 'type' => 'text', 'value' => '', 'placeholder' => '', 'label' => false
])

@if ($label)
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
@endif


<input type="{{ $type }}" value="{{ old($name) ?? $value }}" name="{{ $name }}"
    placeholder="{{ $placeholder }}" 
    {{ $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($name),
    ]) }}>

@error($name)
    <span class="text-danger">{{ $message }}</span>
@enderror
