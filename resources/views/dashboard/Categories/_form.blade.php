{{-- Name --}}
<div class="col-md-6">

    <x-form.input class="form-control" type="text" label="Category Name" name="name" :value="$category->name"
        placeholder="Category Name" />

</div>
{{-- Image --}}
<div class="col-md-6">
    {{-- <label for="image" class="form-label">Category Image</label> --}}
    <x-form.label id="image">Image</x-form.label>
    <x-form.input type="file" name="image" />
    @if ($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-thumbnail mt-2"
            style="width: 100px">
    @endif
</div>

{{-- Parent Category --}}
<div class="col-md-6">

    <div class="form-group">
        <label for="parent_id">Parent Category</label>
        <select name="parent_id" id="parent_id" @class(['form-control', 'is-invalid' => $errors->has('parent_id')])>
            <option value="">Primary Category</option>

            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
            @endforeach
        </select>
        @error('parent_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
{{-- Status --}}
<div class="col-md-6">

    {{-- <label for="flexRadioDefault"></label> --}}
    <x-form.label id="Status">Select Status</x-form.label>

    <x-form.radio  name="status" type="radio" :options="[
        'active' => 'Active',
        'archived' => 'Archived'
    ]" />
</div>

{{-- Description --}}
<div class="col-md-12">
        <x-form.textarea name="description" label="Category Description" :value="$category->description"
        placeholder="Category Description" />
</div>

<div>
    {{-- <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Create' }}</button> --}}
    <button type="submit" class="btn btn-primary">{{ $button_lable ?? 'Save' }}</button>
</div>
