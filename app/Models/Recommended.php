<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recommended extends Model
{
    use HasFactory;

    protected $table = 'recommended';

    protected $fillable = [
        'category_id',
        'product_id',
        'name',
        'description',
        'quantity',
        'estimated_price',
        'is_active',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function product()
    {
        return $this->belongsTo(SingleProducts::class, 'product_id');
    }
}