<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';

    protected $fillable = [
        'image_path',
        'original_name',
        'mime_type',
    ];


    public function products(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Product::class, 'image_product', 'image_id', 'product_id');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(\App\Models\Category::class);
    }

    public function brands(): HasMany
    {
        return $this->hasMany(\App\Models\Brand::class);
    }


    public function scopeSearch($query, $value)
    {
        $query->where('original_name', 'like', "%{$value}%")
            ->orWhere('image_path', 'like', "%{$value}%");
    }
}
