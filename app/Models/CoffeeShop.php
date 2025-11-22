<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoffeeShop extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'phone',
        'website',
    ];

    /**
     * Get the user that owns the coffee shop
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the images for the coffee shop
     */
    public function images(): HasMany
    {
        return $this->hasMany(CoffeeShopImage::class);
    }
}
