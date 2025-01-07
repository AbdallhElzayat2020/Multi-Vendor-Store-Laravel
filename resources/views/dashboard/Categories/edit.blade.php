@extends('layouts.partials.dashboard')


@section('title', ' Home - Dashboard')

@push('css')
    {{-- add new css here --}}
@endpush
@section('breadcrumb')
    {{-- for active breadcrumb --}}
    <li class="breadcrumb-item active">Edit {{ $category->name }}</li>
@endsection
<!-- End Page Title -->

@section('content')
    <section class="section dashboard mt-5">
        <form class="row g-4" action="{{ route('dashboard.categories.update', $category->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- <input type="hidden" name="id" value="{{ $category->id }}"> --}}
            @include('dashboard.Categories._form', [
                'button_lable' => 'Update',
            ])
        </form>
    </section>
@endsection


@push('js')
    {{-- add new js here --}}
@endpush
