<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'transaction_id',
        'item_id',
        'price',
        'quantity',
        'type_of_service',
        'is_borrow',
        'is_free',
    ];

    protected $appends = ['item_id'];

    public function getItemIdAttribute($item_id)
    {
        return Item::find($item_id);
    }
}
