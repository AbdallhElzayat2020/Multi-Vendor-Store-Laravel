@extends('layouts.partials.dashboard')
@section('title', 'Import Products')
@section('breadcrumb')
    <li class="breadcrumb-item active">Import Products</li>
@endsection
@section('content')
    <form action="{{route('dashboard.products.import')}}" method="post">
        @csrf
        <div class="form-group">
            <x-form.input label="Products count" type="text" class="form-control" name="count" />
        </div>
        <button type="submit" class="btn btn-primary mt-3">Start Import...</button>
    </form>
@endsection
