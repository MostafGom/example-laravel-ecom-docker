<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VariantAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'variant_id'];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class);
    }

    public function productVariantAttributes()
    {
        return $this->hasMany(ProductVariantAttribute::class, 'variant_attribute_id', 'id');
    }
}
