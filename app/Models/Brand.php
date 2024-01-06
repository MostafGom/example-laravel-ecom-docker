<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image_id',
        'is_active',
    ];


    // public function images(): HasMany
    // {
    //     return $this->hasMany(\App\Models\Image::class, 'id', 'image_id');
    // }

    public function image(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Image::class, 'image_id', 'id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(\App\Models\Product::class, 'brand_id', 'id');
    }

    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%")
            ->orWhere('slug', 'like', "%{$value}%");
    }
}
