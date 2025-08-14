<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'description',
        'status',
        'popular',
        'image',
        'meta_title',
        'meta_description',
        'meta_keyword',
    ];

    // Relationships
    public function singleProducts()
    {
        return $this->hasMany(SingleProducts::class, 'category_id');
    }

    public function recommendedProducts()
    {
        return $this->hasMany(RecommendedProducts::class, 'category_id');
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, 'category_id');
    }

    public function deliveries()
    {
        return $this->hasMany(Deliveries::class, 'category_id');
    }
}