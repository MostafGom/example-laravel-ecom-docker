<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
	use HasFactory;
	protected $table = 'categories';

	protected $fillable = [
		'name',
		'slug',
		'description',
		'meta_title',
		'meta_keyword',
		'meta_description',
		'image_id',
		'is_active',
	];


	// public function images(): HasMany
	// {
	// 	return $this->hasMany(\App\Models\Image::class, 'id', 'image_id');
	// }

	public function image(): BelongsTo
	{
		return $this->belongsTo(\App\Models\Image::class, 'image_id', 'id');
	}

	public function products(): HasMany
	{
		return $this->hasMany(\App\Models\Product::class, 'category_product', 'category_id', 'product_id');
	}

	public function scopeSearch($query, $value)
	{
		$query->where('name', 'like', "%{$value}%")
			->orWhere('slug', 'like', "%{$value}%");
	}
}
