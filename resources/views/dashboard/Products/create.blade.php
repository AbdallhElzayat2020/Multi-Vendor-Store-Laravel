@extends('layouts.partials.dashboard')
@section('title', 'Create Products')
@section('breadcrumb')
    <li class="breadcrumb-item active">Create Products</li>
@endsection
@section('content')
    <form action="{{route('dashboard.products.store')}}" method="post">
        @csrf
        @include('dashboard.Products._form')
    </form>
@endsection
