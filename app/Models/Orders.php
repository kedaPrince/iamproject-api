<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'category_id',
        'customer_name',
        'customer_email',
        'status',
        'total_amount',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}