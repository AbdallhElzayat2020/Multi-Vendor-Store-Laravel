{{-- Name --}}
<div class="col-md-6">
    <label for="name" class="form-label">Category Name</label>
    <input type="text" value="{{ old('name') ?? $category->name }}" name="name" @class(['form-control', 'is-invalid' => $errors->has('name')])
        placeholder="Category Name">
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
{{-- Image --}}
<div class="col-md-6">
    <label for="image" class="form-label">Category Image</label>
    <input type="file" name="image"@class(['form-control', 'is-invalid' => $errors->has('image')]) accept="image/*">
    @error('image')
        <span class="text-danger">{{ $message }}</span>
    @enderror
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
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
{{-- Description --}}
<div class="col-md-12">
    <label for="description" class="form-label">Category Description</label>
    <textarea type="text" name="description" class="form-control" placeholder="Category Description">{{ old('description' ?? $category->description) }}</textarea>
</div>

<div>
    {{-- <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Create' }}</button> --}}
    <button type="submit" class="btn btn-primary">{{ $button_lable ?? 'Save' }}</button>
</div>
