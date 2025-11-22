<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoffeeShopImage extends Model
{
    protected $fillable = [
        'coffee_shop_id',
        'title',
        'description',
        'image_path',
    ];

    /**
     * Get the coffee shop that owns the image
     */
    public function coffeeShop(): BelongsTo
    {
        return $this->belongsTo(CoffeeShop::class);
    }
}
