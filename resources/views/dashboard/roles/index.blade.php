@extends('layouts.partials.dashboard')


@section('title', 'roles')

@push('css')
    {{-- add new css here --}}
@endpush

@section('breadcrumb')
    {{-- for active breadcrumb --}}
    <li class="breadcrumb-item active">
        roles
    </li>
@endsection
<!-- End Page Title -->

@section('content')
    <section class="section dashboard mt-5">
        {{-- alert messages Components --}}
        <x-alert type="success"/>

        <x-alert type="danger"/>
        {{-- end alert messages --}}
        <div class="row mt-4">
            <div class="col-lg-12">
                {{--                @if(Auth::user()->can('roles.create'))--}}
                {{--                @endif--}}
                <a class="btn btn-primary mb-4 mx-2" href="{{ route('dashboard.roles.create') }}">
                    Add role
                </a>

                {{-- table --}}
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created_at</th>
                        <th colspan="2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($roles as $key=> $role)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                {{ $role->name }}
                            </td>

                            <td>{{ $role->created_at->diffForHumans() }}</td>
                            <td>
                                {{--                                @can('roles.update')--}}

                                <a href="{{ route('dashboard.roles.edit', $role->id) }}"
                                   class="btn btn-sm btn-outline-success">Edit
                                </a>
                                {{--                                @endcan--}}
                                {{--                                @can('roles.delete')--}}
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $role->id }}">
                                    Delete
                                </button>
                                {{--                                @endcan--}}

                            </td>
                        </tr>
                        @include('dashboard.roles.delete')
                    @empty
                        <tr class="text-center">
                            <td colspan="4">No roles Available</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{-- table --}}

                {{-- pagination --}}
                {{ $roles->withQueryString()->links() }}
            </div>


        </div>
    </section>
@endsection


@push('js')
    {{-- add new js here --}}
@endpush
