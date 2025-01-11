@extends('layouts.partials.dashboard')


@section('title', 'Products')

@push('css')
    {{-- add new css here --}}
@endpush

@section('breadcrumb')
    {{-- for active breadcrumb --}}
    <li class="breadcrumb-item active">
        Products
    </li>
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
                <a class="btn btn-primary mb-4 mx-2" href="{{ route('dashboard.products.create') }}">Add product</a>
                {{-- <a class="btn btn-primary mb-4 mx-2" href="{{ route('dashboard.products.trash') }}">Trash</a> --}}

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
                            <th>Category Name</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Store Name</th>
                            <th>Created_at</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($products as $key=> $product)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @if ($product->category_id)
                                        {{ $product->category->name }}
                                    @else
                                        <span class="badge bg-danger">No Category</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Archived</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($product->image == null)
                                        <span class="badge bg-danger">No Image Available</span>
                                    @else
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            width="80" height="80" class="img-thumbnail">
                                    @endif
                                </td>
                                <td>{{ $product->store->name }}</td>
                                <td>{{ $product->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                        class="btn btn-sm btn-outline-success">Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $product->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @include('dashboard.Products.delete')

                        @empty
                            <tr class="text-center">
                                <td colspan="9">No products Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- table --}}

                {{-- pagination --}}
                {{ $products->withQueryString()->links() }}
            </div>



        </div>
    </section>
@endsection


@push('js')
    {{-- add new js here --}}
@endpush
