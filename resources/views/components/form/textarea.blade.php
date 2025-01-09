@props([
    'name', 'value' => '', 'placeholder' => '', 'label' => false
])

@if ($label)
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
@endif


<textarea  name="{{ $name }}"
    placeholder="{{ $placeholder }}" {{ $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($name),
    ]) }}
    >{{ old($name) , $value }}</textarea>

@error($name)
    <span class="text-danger">{{ $message }}</span>
@enderror
