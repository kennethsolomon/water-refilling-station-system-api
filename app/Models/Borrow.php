<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrow extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'transaction_id',
        'order_id',
        'quantity',
    ];

    // protected $appends = ['transaction_id', 'order_id'];


    // public function getTransactionIdAttribute($transaction_id)
    // {
    //     return Transaction::find($transaction_id);
    // }

    // public function getOrderIdAttribute($order_id)
    // {
    //     return Order::find($order_id);
    // }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
