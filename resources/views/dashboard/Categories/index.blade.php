@extends('layouts.partials.dashboard')


@section('title', ' Home - Dashboard')

@push('css')
    {{-- add new css here --}}
@endpush

@section('breadcrumb')
    {{-- for active breadcrumb --}}
    <li class="breadcrumb-item active">Categories</li>
@endsection
<!-- End Page Title -->

@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary mb-4" href="{{ route('categories.create') }}">Add Category</a>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Parent</th>
                            <th>Created_at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($categories as $key=> $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->image }}</td>
                                <td>{{ $category->status }}</td>
                                <td>{{ $category->parent_id }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="btn btn-sm btn-outline-success">Edit</a>

                                    <a href="{{ route('categories.destroy', $category->id) }}"
                                        class="btn btn-sm btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No data Available</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </section>
@endsection


@push('js')
    {{-- add new js here --}}
@endpush
