<div class="form-group">
    <x-form.input label="Product Name" type="text" class="form-control" name="name" :value="$product->name"/>
</div>

<div class="form-group">
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id" class="form-control">
        <option value="">Primary Category</option>

        @foreach (App\Models\Category::all() as $category)
            <option value="{{ $category->id }}" @selected($product->category_id === $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="">Description</label>
    <x-form.textarea name="description" :value="$product->description"/>
</div>
<div class="form-group">
    <x-form.label id="image">Image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*"/>
    @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail mt-2"
             style="width: 100px">
    @endif
</div>
