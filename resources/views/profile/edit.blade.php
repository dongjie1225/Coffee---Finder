@extends('layouts.bootstrap')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h1 class="mb-4"><i class="bi bi-person-circle"></i> Profile</h1>

        <!-- Update Profile Information -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Profile Information</h5>
            </div>
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Update Password</h5>
            </div>
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete Account -->
        <div class="card mb-4 shadow-sm border-danger">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Delete Account</h5>
            </div>
            <div class="card-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
