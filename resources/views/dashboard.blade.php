@extends('layouts.bootstrap')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0"><i class="bi bi-speedometer2"></i> Dashboard</h1>
            @auth
                <a href="{{ route('coffee-shops.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add Coffee Shop
                </a>
            @endauth
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Welcome, {{ Auth::user()->name }}!</h5>
                <p class="card-text">You're logged in to Coffee Finder.</p>
                
                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h6 class="card-title"><i class="bi bi-cup-hot"></i> Coffee Shops</h6>
                                <p class="card-text">
                                    <a href="{{ route('coffee-shops.index') }}" class="text-white text-decoration-none">
                                        View All Coffee Shops <i class="bi bi-arrow-right"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h6 class="card-title"><i class="bi bi-plus-circle"></i> Add New</h6>
                                <p class="card-text">
                                    <a href="{{ route('coffee-shops.create') }}" class="text-white text-decoration-none">
                                        Create Coffee Shop <i class="bi bi-arrow-right"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
