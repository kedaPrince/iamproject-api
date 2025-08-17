<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SingleProducts extends Model
{
    use HasFactory;

    protected $table = 'single_products';

    protected $fillable = [
        'uuid',
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}