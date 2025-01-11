@extends('layouts.partials.dashboard')

@section('title', 'Edit Profile - Dashboard')

@push('css')
    {{-- إضافة أي أنماط CSS إضافية هنا --}}
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')
    <section class="section dashboard mt-5">
        {{-- alert messages Components --}}
        <x-alert type="success" />

        <x-alert type="danger" />
        {{-- end alert messages --}}
        <form class="row g-4" action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <!-- الاسم الأول واسم العائلة -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <x-form.input name="first_name" id="first_name" type="text" :value="$user->profile->first_name" />
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <x-form.input name="last_name" id="last_name" type="text" :value="$user->profile->last_name" />
                </div>
            </div>

            <!-- تاريخ الميلاد والجنس -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                    <label for="birthday" class="form-label">Birthday</label>
                    <x-form.input name="birthday" id="birthday" type="date" :value="$user->profile->birthday" />
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <x-form.radio name="gender" id="gender" :options="['male' => 'Male', 'female' => 'Female']" :checked="$user->profile->gender" />
                </div>
            </div>

            <!-- العنوان والمدينة والولاية -->
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <label for="street_address" class="form-label">Street Address</label>
                    <x-form.input name="street_address" id="street_address" type="text" :value="$user->profile->street_address" />
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <label for="city" class="form-label">City</label>
                    <x-form.input name="city" id="city" type="text" :value="$user->profile->city" />
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <label for="state" class="form-label">State</label>
                    <x-form.input name="state" id="state" type="text" :value="$user->profile->state" />
                </div>
            </div>

            <!-- الرمز البريدي، الدولة واللغة -->
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <label for="postal_code" class="form-label">Postal Code</label>
                    <x-form.input name="postal_code" id="postal_code" type="text" :value="$user->profile->postal_code" />
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <label for="country" class="form-label">Country</label>
                    <select name="country" id="country"
                        class="form-control form-select @error('country') is-invalid @enderror">
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country }}" @selected($country == $user->profile->country)>{{ $country }}</option>
                        @endforeach
                    </select>
                    @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <label for="local" class="form-label">Local</label>
                    <select name="local" id="local"
                        class="form-control form-select @error('local') is-invalid @enderror">
                        <option value="">Select Local</option>
                        @foreach ($locales as $local)
                            <option value="{{ $local }}" @selected($local == $user->profile->local)>{{ $local }}</option>
                        @endforeach
                    </select>
                    @error('local')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- زر الحفظ -->
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-lg">Save</button>
                </div>
            </div>
        </form>
    </section>
@endsection

@push('js')
    {{-- إضافة أي سكربتات جديدة هنا --}}
@endpush
