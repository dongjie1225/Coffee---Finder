<?php

namespace App\Http\Controllers;

use App\Models\CoffeeShop;
use App\Models\CoffeeShopImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CoffeeShopImageController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(CoffeeShop $coffeeShop)
    {
        $this->authorize('update', $coffeeShop);
        return view('coffee-shop-images.create', compact('coffeeShop'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CoffeeShop $coffeeShop)
    {
        $this->authorize('update', $coffeeShop);

        // Data validation - title and description are required, file is required
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB
        ]);

        // Store the uploaded file
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('coffee-shop-images', 'public');
            $validated['image_path'] = $imagePath;
        }

        $validated['coffee_shop_id'] = $coffeeShop->id;

        CoffeeShopImage::create($validated);

        return redirect()->route('coffee-shops.show', $coffeeShop)
            ->with('success', 'Image uploaded successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CoffeeShop $coffeeShop, CoffeeShopImage $image)
    {
        $this->authorize('update', $coffeeShop);
        $coffeeShopImage = $image;
        return view('coffee-shop-images.edit', compact('coffeeShop', 'coffeeShopImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CoffeeShop $coffeeShop, CoffeeShopImage $image)
    {
        $this->authorize('update', $coffeeShop);

        // Data validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Update image file if new one is uploaded
        if ($request->hasFile('image')) {
            // Delete old image
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            // Store new image
            $imagePath = $request->file('image')->store('coffee-shop-images', 'public');
            $validated['image_path'] = $imagePath;
        }

        $image->update($validated);

        return redirect()->route('coffee-shops.show', $coffeeShop)
            ->with('success', 'Image updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoffeeShop $coffeeShop, CoffeeShopImage $image)
    {
        $this->authorize('update', $coffeeShop);

        // Delete image file
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return redirect()->route('coffee-shops.show', $coffeeShop)
            ->with('success', 'Image deleted successfully!');
    }
}
