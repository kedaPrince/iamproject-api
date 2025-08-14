<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecommendedProducts extends Model
{
    use HasFactory;

    protected $table = 'recommended';

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'quantity',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}