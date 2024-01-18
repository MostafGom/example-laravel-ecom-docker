<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function attributes(): HasMany
    {
        return $this->hasMany(VariantAttribute::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
