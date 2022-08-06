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
        'item_id',
        'quantity',
    ];

    protected $appends = ['item_info'];

    public static function boot()
    {
        parent::boot();

        static::updated(function ($model) { // before delete() method call this
            if ($model->quantity === 0) {
                $model->delete();
            }
        });
    }

    public function getItemInfoAttribute()
    {
        $price = 0;
        $order = Order::find($this->order_id);
        $item = Item::find($this->item_id);
        if ($order->is_purchase) {
            $price = $item->purchase_price;
        } else if (!$order->is_purchase && $order->type_of_service == 'delivery') {
            $price = $item->delivery_price;
        } else if (!$order->is_purchase && $order->type_of_service == 'pickup') {
            $price = $item->pickup_price;
        }
        $item->price = $price;
        return $item;
    }

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

    public function item()
    {
        return $this->hasOne(Item::class);
    }
}
