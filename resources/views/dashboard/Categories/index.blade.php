@extends('layouts.partials.dashboard')


@section('title', ' Home - Dashboard')

@push('css')
    {{-- add new css here --}}
@endpush

@section('breadcrumb')
    {{-- for active breadcrumb --}}
    <li class="breadcrumb-item active">
        Categories</li>
@endsection
<!-- End Page Title -->

@section('content')
    <section class="section dashboard mt-5">
        {{-- alert messages Components --}}
        <x-alert type="success" />
        <x-alert type="danger" />
        {{-- end alert messages --}}
        <div class="row mt-4">
            <div class="col-lg-12">
                <a class="btn btn-primary mb-4" href="{{ route('dashboard.categories.create') }}">Add Category</a>

                {{-- seacrh form and filter status --}}
                <form action="{{ URL::current() }}" method="get" class="my-4">
                    <div class="d-flex justify-content-between align-items-center gap-2">

                        <x-form.input type="text" :value="request('name')" class="mx-2" name="name" placeholder="Search" />

                        <select name="status" class="form-control mx-2" id="">
                            <option value="">All</option>
                            <option value="active" @selected(request('status') == 'active')>Active</option>
                            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
                        </select>
                        <button type="submit" class="btn btn-primary mx-2">Search</button>
                    </div>
                </form>
                {{-- seacrh form and filter status --}}

                {{-- table --}}
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Parent</th>
                            <th>Image</th>
                            <th>Created_at</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($categories as $key=> $category)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if ($category->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Archived</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($category->parent)
                                        {{ $category->parent->name }}
                                    @else
                                        <span class="badge bg-primary">Primary Category</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($category->image == null)
                                        <span class="badge bg-danger">No Image Available</span>
                                    @else
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                            width="80" height="80" class="img-thumbnail">
                                    @endif
                                </td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                        class="btn btn-sm btn-outline-success">Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $category->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @include('dashboard.Categories.delete')

                        @empty
                            <tr class="text-center">
                                <td colspan="8">No Categories Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- table --}}

                {{-- pagination --}}
                {{ $categories->withQueryString()->links() }}
            </div>



        </div>
    </section>
@endsection


@push('js')
    {{-- add new js here --}}
@endpush
