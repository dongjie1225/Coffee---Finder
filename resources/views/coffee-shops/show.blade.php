@extends('layouts.bootstrap')

@section('content')
<div class="mb-4">
    <a href="{{ route('coffee-shops.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to List
    </a>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="mb-0">{{ $coffeeShop->name }}</h2>
        @can('update', $coffeeShop)
            <div>
                <a href="{{ route('coffee-shops.edit', $coffeeShop) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('coffee-shops.destroy', $coffeeShop) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" 
                            onclick="return confirm('Are you sure you want to delete this coffee shop?')">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
            </div>
        @endcan
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h5>Description</h5>
                <p>{{ $coffeeShop->description ?? 'No description provided.' }}</p>
                
                <h5>Contact Information</h5>
                <ul class="list-unstyled">
                    @if($coffeeShop->address)
                        <li><i class="bi bi-geo-alt"></i> {{ $coffeeShop->address }}</li>
                    @endif
                    @if($coffeeShop->phone)
                        <li><i class="bi bi-telephone"></i> {{ $coffeeShop->phone }}</li>
                    @endif
                    @if($coffeeShop->website)
                        <li><i class="bi bi-globe"></i> <a href="{{ $coffeeShop->website }}" target="_blank">{{ $coffeeShop->website }}</a></li>
                    @endif
                </ul>
                
                <p class="text-muted">
                    <small>Created by {{ $coffeeShop->user->name }} on {{ $coffeeShop->created_at->format('M d, Y') }}</small>
                </p>
            </div>
        </div>

        <hr>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Images</h5>
            @can('update', $coffeeShop)
                <a href="{{ route('coffee-shops.images.create', $coffeeShop) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle"></i> Add Image
                </a>
            @endcan
        </div>

        @if($coffeeShop->images->count() > 0)
            <div class="row">
                @foreach($coffeeShop->images as $image)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            @php
                                $imagePath = storage_path('app/public/' . $image->image_path);
                                $imageExists = file_exists($imagePath);
                            @endphp
                            @if($imageExists)
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     class="card-img-top" 
                                     alt="{{ $image->title }}"
                                     style="height: 200px; object-fit: cover;"
                                     onerror="this.onerror=null; this.src='https://via.placeholder.com/400x200/6c757d/ffffff?text={{ urlencode($image->title) }}';">
                            @else
                                <img src="https://via.placeholder.com/400x200/6c757d/ffffff?text={{ urlencode($image->title) }}" 
                                     class="card-img-top" 
                                     alt="{{ $image->title }}"
                                     style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h6 class="card-title">{{ $image->title }}</h6>
                                <p class="card-text small">{{ $image->description }}</p>
                                @can('update', $coffeeShop)
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('coffee-shops.images.edit', [$coffeeShop, $image]) }}" 
                                           class="btn btn-warning">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('coffee-shops.images.destroy', [$coffeeShop, $image]) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" 
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> No images uploaded yet.
                @can('update', $coffeeShop)
                    <a href="{{ route('coffee-shops.images.create', $coffeeShop) }}">Upload the first image!</a>
                @endcan
            </div>
        @endif
    </div>
</div>
@endsection

