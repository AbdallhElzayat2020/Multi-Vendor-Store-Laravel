@extends('layouts.partials.dashboard')


@section('title')
    {{ $category->name }}
@endsection
@push('css')
    {{-- add new css here --}}
@endpush
@section('breadcrumb')
    {{-- for active breadcrumb --}}
    <li class="breadcrumb-item active">Categories / {{ $category->name }}</li>
@endsection
<!-- End Page Title -->

@section('content')
    {{-- table --}}
    <table class="table table-responsive">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Store Name</th>
                <th>Status</th>
                <th>Created_at</th>
            </tr>
        </thead>

        <tbody>
            @php
                $products = $category->products()->with('store')->latest()->paginate(5);
            @endphp
            @forelse ($products as $key=> $product)
                <tr>
                    <td>
                        @if ($product->image == null)
                            <span class="badge bg-danger">No Image Available</span>
                        @else
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="80"
                                height="80" class="img-thumbnail">
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->store->name }}</td>
                    <td>
                        @if ($product->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Archived</span>
                        @endif
                    </td>
                    <td>{{ $category->created_at->diffForHumans() }}</td>
                </tr>

            @empty
                <tr class="text-center">
                    <td colspan="9">No products Available in Category</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{-- table --}}
    {{ $products->links() }}
@endsection


@push('js')
    {{-- add new js here --}}
@endpush
