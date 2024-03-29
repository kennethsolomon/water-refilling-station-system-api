<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'transaction_id',
        'item_id',
        'quantity',
        'type_of_service',
        'is_borrow',
        'is_purchase',
        'is_free',
    ];

    protected $appends = ['item_info'];

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            // Minus Item if Purchase or Borrowed
            $model->calculateItem($model);

            // Add Borrow if borrow is true
            if ($model->is_borrow) {
                $model->createBorrow($model);
            }
        });
    }

    public function getItemInfoAttribute()
    {
        return Item::find($this->item_id);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function createBorrow($model)
    {
        $data = [
            'order_id' => $model->id,
            'transaction_id' => $model->transaction_id,
            'customer_id' => $model->customer_id,
            'item_id' => $model->item_id,
            'quantity' => $model->quantity,
        ];

        Borrow::create($data);
    }

    public function calculateItem($model)
    {
        $item = Item::find($model->item_id);
        if ($model->is_purchase == true || $model->is_borrow == true) {
            if ($item->quantity >= $model->quantity) {
                $item->quantity -= $model->quantity;
                $item->save();
            } else {
                throw new Exception('Insufficient stock: ' . $item->name, 501);
            }
        }
    }
}
