@extends('layouts.partials.dashboard')


@section('title', ' Home - Dashboard')

@push('css')
    {{-- add new css here --}}
@endpush
@section('breadcrumb')
    {{-- for active breadcrumb --}}
    <li class="breadcrumb-item active">Create Category</li>
@endsection
<!-- End Page Title -->

@section('content')
    <section class="section dashboard mt-5">
        <form class="row g-4" action="{{ route('dashboard.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            {{-- Name --}}
            <div class="col-md-6">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" value="{{ old('name') }}" name="name" class="form-control"
                    placeholder="Category Name">
            </div>

            {{-- Image --}}
            <div class="col-md-6">
                <label for="image" class="form-label">Category Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            {{-- Parent Category --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="parent_id">Parent Category</label>
                    <select name="parent_id" id="parent_id" class="form-select">
                        <option value="">Primary Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Status --}}
            <div class="col-md-6">
                <label for="flexRadioDefault">Select Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="active" name="status" id="active" checked>
                    <label class="form-check-label" for="active">
                        Active
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="archived" name="status" id="archived">
                    <label class="form-check-label" for="archived">
                        Archived
                    </label>
                </div>
            </div>

            {{-- Description --}}
            <div class="col-md-12">
                <label for="description" class="form-label">Category Description</label>
                <textarea type="text" name="description" class="form-control" placeholder="Category Description"></textarea>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </section>
@endsection


@push('js')
    {{-- add new js here --}}
@endpush
