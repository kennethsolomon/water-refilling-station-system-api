<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'pickup_price',
        'delivery_price',
        'purchase_price',
        'quantity',
        'is_pos',
    ];
}
