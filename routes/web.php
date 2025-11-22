<?php

use App\Http\Controllers\CoffeeShopController;
use App\Http\Controllers\CoffeeShopImageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('coffee-shops.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Coffee Shops Routes - Authenticated users only (must be before public routes to avoid route conflict)
Route::middleware('auth')->group(function () {
    // Define create route first (before {id} route) to avoid route conflict
    Route::get('coffee-shops/create', [CoffeeShopController::class, 'create'])->name('coffee-shops.create');
    Route::post('coffee-shops', [CoffeeShopController::class, 'store'])->name('coffee-shops.store');
    Route::get('coffee-shops/{coffee_shop}/edit', [CoffeeShopController::class, 'edit'])->name('coffee-shops.edit');
    Route::put('coffee-shops/{coffee_shop}', [CoffeeShopController::class, 'update'])->name('coffee-shops.update');
    Route::patch('coffee-shops/{coffee_shop}', [CoffeeShopController::class, 'update']);
    Route::delete('coffee-shops/{coffee_shop}', [CoffeeShopController::class, 'destroy'])->name('coffee-shops.destroy');
    
    // Coffee Shop Images Routes
    Route::resource('coffee-shops.images', CoffeeShopImageController::class)->except(['index', 'show']);
});

// Coffee Shops Routes - Public access for viewing (after auth routes to avoid conflict)
Route::get('coffee-shops', [CoffeeShopController::class, 'index'])->name('coffee-shops.index');
Route::get('coffee-shops/{coffee_shop}', [CoffeeShopController::class, 'show'])->name('coffee-shops.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
