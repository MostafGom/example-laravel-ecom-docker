<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'long_description',
        'price',
        'sku',
        'thumbnail',
        'brand_id',
    ];

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Image::class, 'image_product', 'product_id', 'image_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Brand::class, 'brand_id', 'id');
    }

    public function productVariantAttributes(): HasMany
    {
        return $this->hasMany(\App\Models\ProductVariantAttribute::class, 'product_id', 'id');
    }

    public function variantAttributes()
    {
        return $this->hasManyThrough(
            VariantAttribute::class,
            ProductVariantAttribute::class,
            'product_id', // Foreign key on ProductVariantAttribute table
            'id', // Local key on Product table
            'id', // Local key on VariantAttribute table
            'variant_attribute_id' // Foreign key on ProductVariantAttribute table
        );
    }

    public function variantsSQL()
    {
        return Variant::select('variants.*')
            ->join('variant_attributes', 'variants.id', '=', 'variant_attributes.variant_id')
            ->join('product_variant_attributes', 'variant_attributes.id', '=', 'product_variant_attributes.variant_attribute_id')
            ->where('product_variant_attributes.product_id', $this->id)
            ->distinct()
            ->get();
    }

    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%")
            ->orWhere('slug', 'like', "%{$value}%");
    }
}
