<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'description',
        'available_quantity',
        'initial_quantity',
        'discount',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
