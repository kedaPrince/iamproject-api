<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deliveries extends Model
{
    use HasFactory;

    protected $table = 'deliveries';

    protected $fillable = [
        'category_id',
        'order_id',
        'delivery_date',
        'delivery_status',
        'address',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
}