<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'delivery_charge',
        'pickup_charge',
        'purchase_charge',
    ];
}
