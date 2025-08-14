<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SingleProducts extends Model
{
    use HasFactory;

    protected $table = 'single_product';

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}