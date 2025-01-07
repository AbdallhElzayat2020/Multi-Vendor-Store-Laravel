{{-- Name --}}
<div class="col-md-6">
    <label for="name" class="form-label">Category Name</label>
    <input type="text" value="{{ $category->name ?? '' }}" name="name" class="form-control"
        placeholder="Category Name">
</div>
{{-- Image --}}
<div class="col-md-6">
    <label for="image" class="form-label">Category Image</label>
    <input type="file" name="image" class="form-control" accept="image/*">
    @if ($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-thumbnail mt-2"
            style="width: 100px">
    @endif
</div>
{{-- Parent Category --}}
<div class="col-md-6">
    <div class="form-group">
        <label for="parent_id">Parent Category</label>
        <select name="parent_id" id="parent_id" class="form-select">
            <option value="">Primary Category</option>

            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}" @selected($parent->id == $category->parent_id)>{{ $parent->name }}</option>
            @endforeach
        </select>
    </div>
</div>
{{-- Status --}}
<div class="col-md-6">
    <label for="flexRadioDefault">Select Status</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" value="active" @checked($category->status == 'active') name="status"
            id="active" checked>
        <label class="form-check-label" for="active">
            Active
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" value="archived" name="status" @checked($category->status == 'archived')
            id="archived">
        <label class="form-check-label" for="archived">
            Archived
        </label>
    </div>
</div>
{{-- Description --}}
<div class="col-md-12">
    <label for="description" class="form-label">Category Description</label>
    <textarea type="text" name="description" class="form-control" placeholder="Category Description">{{ $category->description }}</textarea>
</div>

<div>
    {{-- <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Create' }}</button> --}}
    <button type="submit" class="btn btn-primary">{{ $button_lable ?? 'Save' }}</button>
</div>
