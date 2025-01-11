<select name="{{ $name }}" class="form-control form-select @error($name) is-invalid @enderror"
    {{ $attributes }}>
    @foreach ($options as $value => $text)
        <option value="{{ $value }}" @selected($value == $selected)>{{ $text }}</option>
    @endforeach
</select>
<x-form.validation-feedback :name="$name" />
