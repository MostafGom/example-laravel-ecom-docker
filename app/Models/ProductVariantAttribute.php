<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ProductVariantAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'price_override',
        'stock_quantity',
        'product_id',
        'variant_attribute_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function variantAttribute(): BelongsTo
    {
        return $this->belongsTo(VariantAttribute::class, 'variant_attribute_id', 'id');
    }

    public function variant()
    {
        return $this->variantAttribute->variant();
    }


    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%")
            ->orWhere('id', 'like', "%{$value}%");
    }

    public function scopeSearchWithVariantAttribute($query, $value)
    {
        $query->where('name', 'like', "%{$value}%")
            ->orWhere('id', 'like', "%{$value}%")
            ->orWhereHas('variantAttribute', function ($query) use ($value) {
                $query->where('name', 'like', "%{$value}%");
            });
    }
}
