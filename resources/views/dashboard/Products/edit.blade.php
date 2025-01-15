@extends('layouts.partials.dashboard')


@section('title', ' Home - Products')

@push('css')
    {{-- add new css here --}}
@endpush
@section('breadcrumb')
    {{-- for active breadcrumb --}}
    <li class="breadcrumb-item active">Edit {{ $product->name }}</li>
@endsection
<!-- End Page Title -->

@section('content')
    <section class="section dashboard mt-5">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $error }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
        {{-- alert messages Components --}}
        <form class="row g-4" action="{{ route('dashboard.products.update', $product->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')


            <div class="form-group">
                <x-form.input label="Product Name" type="text" class="form-control" name="name" :value="$product->name" />
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Primary Category</option>

                    @foreach (App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" @selected($category->id == $product->category_id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Description</label>
                <x-form.textarea name="description" :value="$product->description" />
            </div>
            <div class="form-group">
                <x-form.label id="image">Image</x-form.label>
                <x-form.input type="file" name="image" accept="image/*" />
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="img-thumbnail mt-2" style="width: 100px">
                @endif
            </div>
            <div class="form-group">
                <x-form.input label="Price" type="number" class="form-control" name="price" :value="$product->price" />
            </div>
            <div class="form-group">
                <x-form.input label="Compare Price" type="number" class="form-control" name="compare_price"
                    :value="$product->compare_price" />
            </div>
            <div class="form-group">
                <x-form.input label="Tags" type="text" class="form-control" name="tags" :value="$tags" />
            </div>
            <div class="form-group">
                <x-form.label id="Status">Select Status</x-form.label>
                <x-form.radio name="status" type="radio" :options="[
                    'active' => 'active',
                    'inactive' => 'inactive',
                    'Draft' => 'draft',
                ]" :checked="$product->status" />
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Save</button>
        </form>
    </section>
@endsection


@push('js')
    {{-- add new js here --}}
@endpush
