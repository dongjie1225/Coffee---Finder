<?php

namespace App\Http\Controllers;

use App\Models\CoffeeShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CoffeeShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coffeeShops = CoffeeShop::with(['user', 'images'])->latest()->paginate(12);
        return view('coffee-shops.index', compact('coffeeShops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', CoffeeShop::class);
        return view('coffee-shops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', CoffeeShop::class);

        // Data validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
        ]);

        $validated['user_id'] = Auth::id();

        $coffeeShop = CoffeeShop::create($validated);

        return redirect()->route('coffee-shops.show', $coffeeShop)
            ->with('success', 'Coffee shop created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(CoffeeShop $coffeeShop)
    {
        $coffeeShop->load(['user', 'images']);
        return view('coffee-shops.show', compact('coffeeShop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CoffeeShop $coffeeShop)
    {
        $this->authorize('update', $coffeeShop);
        return view('coffee-shops.edit', compact('coffeeShop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CoffeeShop $coffeeShop)
    {
        $this->authorize('update', $coffeeShop);

        // Data validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
        ]);

        $coffeeShop->update($validated);

        return redirect()->route('coffee-shops.show', $coffeeShop)
            ->with('success', 'Coffee shop updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoffeeShop $coffeeShop)
    {
        $this->authorize('delete', $coffeeShop);

        // Delete associated images
        foreach ($coffeeShop->images as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
        }

        $coffeeShop->delete();

        return redirect()->route('coffee-shops.index')
            ->with('success', 'Coffee shop deleted successfully!');
    }
}
