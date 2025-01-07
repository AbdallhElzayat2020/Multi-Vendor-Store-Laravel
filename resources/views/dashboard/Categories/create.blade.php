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
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $error }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
        <form class="row g-4" action="{{ route('dashboard.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            @include('dashboard.Categories._form', [
                'button_lable' => 'Create',
            ])

        </form>
    </section>
@endsection


@push('js')
    {{-- add new js here --}}
@endpush
