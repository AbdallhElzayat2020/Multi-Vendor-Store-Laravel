{{-- <div class="col-md-6">
    <label for="flexRadioDefault">Select Status</label>
    <div class="form-check @error('name') is-invalid @enderror">
        <input class="form-check-input " type="radio" value="active" @checked(old('status' ?? $category->status) == 'active') name="status"
            id="active" checked>
        <label class="form-check-label" for="active">
            Active
        </label>
        @error('status')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div @class(['form-check', 'is-invalid' => $errors->has('parent_id')])>
        <input class="form-check-input" type="radio" value="archived" name="status" @checked(old('status' ?? $category->status) == 'archived')
            id="archived">
        <label class="form-check-label" for="archived">
            Archived
        </label>
        @error('status')
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    </div>
</div> --}}


@props([
    'name', 'options', 'checked' => false
])

@foreach ($options as $value => $text)
    <div class="form-check">
        <input 
        type="radio" value="{{ $value }}"
        @checked(old( $name , $checked) == $value) name="{{ $name }}"
        {{ $attributes->class([
            'form-check-input',
            'is-invalid' => $errors->has($name),
        ]) }}
        id="{{ $value }}">

        <label class="form-check-label" for="{{ $value }}">
            {{ $text }}
        </label>
    </div>
@endforeach