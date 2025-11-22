@extends('layouts.bootstrap')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-cup-hot"></i> Coffee Shops</h1>
    @auth
        <a href="{{ route('coffee-shops.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Coffee Shop
        </a>
    @endauth
</div>

@if($coffeeShops->count() > 0)
    <div class="row">
        @foreach($coffeeShops as $coffeeShop)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($coffeeShop->images->count() > 0)
                        @php
                            $imagePath = storage_path('app/public/' . $coffeeShop->images->first()->image_path);
                            $imageExists = file_exists($imagePath);
                        @endphp
                        @if($imageExists)
                            <img src="{{ asset('storage/' . $coffeeShop->images->first()->image_path) }}" 
                                 class="card-img-top" 
                                 alt="{{ $coffeeShop->name }}"
                                 style="height: 200px; object-fit: cover;"
                                 onerror="this.onerror=null; this.src='https://via.placeholder.com/400x200/6c757d/ffffff?text={{ urlencode($coffeeShop->name) }}';">
                        @else
                            <img src="https://via.placeholder.com/400x200/6c757d/ffffff?text={{ urlencode($coffeeShop->name) }}" 
                                 class="card-img-top" 
                                 alt="{{ $coffeeShop->name }}"
                                 style="height: 200px; object-fit: cover;">
                        @endif
                    @else
                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" 
                             style="height: 200px;">
                            <i class="bi bi-image text-white" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $coffeeShop->name }}</h5>
                        <p class="card-text">{{ Str::limit($coffeeShop->description, 100) }}</p>
                        <p class="text-muted small">
                            <i class="bi bi-person"></i> {{ $coffeeShop->user->name }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('coffee-shops.show', $coffeeShop) }}" class="btn btn-primary btn-sm">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $coffeeShops->links() }}
    </div>
@else
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> No coffee shops found. 
        @auth
            <a href="{{ route('coffee-shops.create') }}">Create the first one!</a>
        @else
            <a href="{{ route('register') }}">Register</a> to add coffee shops.
        @endauth
    </div>
@endif
@endsection

