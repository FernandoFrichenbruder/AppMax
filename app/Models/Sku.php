<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sku',
        'price',
        'stock',
    ];

    /**
     * Get the product that owns the sku.
     */
    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    /**
     * Get the items for the Sku.
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
