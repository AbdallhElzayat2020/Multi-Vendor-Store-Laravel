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


                        {{-- @if ($categories->count() == 0)
                            <tr class="text-center">
                                <td colspan="8">No data Available</td>
                            </tr>
                        @else
                            @foreach ($categories as $key => $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->image }}</td>
                                    <td>{{ $category->status }}</td>
                                    <td>{{ $category->parent->name }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn btn-sm btn-outline-success">Edit</a>

                                        <a href="{{ route('categories.destroy', $category->id) }}"
                                            class="btn btn-sm btn-outline-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif --}}


                    </tbody>
                </table>
            </div>



            {{-- <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datatables</h5>
                        <p>Add lightweight datatables to your project with using the <a
                                href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple
                                DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to
                            conver to a datatable. Check for <a
                                href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more
                                examples</a>.</p>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        <b>N</b>ame
                                    </th>
                                    <th>Ext.</th>
                                    <th>City</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                                    <th>Completion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Unity Pugh</td>
                                    <td>9958</td>
                                    <td>Curicó</td>
                                    <td>2005/02/11</td>
                                    <td>37%</td>
                                </tr>
                                <tr>
                                    <td>Theodore Duran</td>
                                    <td>8971</td>
                                    <td>Dhanbad</td>
                                    <td>1999/04/07</td>
                                    <td>97%</td>
                                </tr>
                                <tr>
                                    <td>Kylie Bishop</td>
                                    <td>3147</td>
                                    <td>Norman</td>
                                    <td>2005/09/08</td>
                                    <td>63%</td>
                                </tr>
                                <tr>
                                    <td>Willow Gilliam</td>
                                    <td>3497</td>
                                    <td>Amqui</td>
                                    <td>2009/29/11</td>
                                    <td>30%</td>
                                </tr>
                                <tr>
                                    <td>Blossom Dickerson</td>
                                    <td>5018</td>
                                    <td>Kempten</td>
                                    <td>2006/11/09</td>
                                    <td>17%</td>
                                </tr>
                                <tr>
                                    <td>Elliott Snyder</td>
                                    <td>3925</td>
                                    <td>Enines</td>
                                    <td>2006/03/08</td>
                                    <td>57%</td>
                                </tr>


                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div> --}}


            {{-- <div class="pagination">
                {{ $categories->links() }}
            </div> --}}

        </div>
    </section>
@endsection


@push('js')
    {{-- add new js here --}}
@endpush
