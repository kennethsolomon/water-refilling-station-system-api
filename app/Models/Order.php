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
        'is_free',
    ];

    protected $appends = ['item_info', 'charge'];

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            // FIXME: Comment if doing Migration & Seed
            // Minus Item if Purchase or Borrowed
            $item = Item::find($model->item_id);
            if ($model->type_of_service == 'purchase' || $model->is_borrow == true) {
                if ($item->quantity >= $model->quantity) {
                    $item->quantity -= $model->quantity;
                    $item->save();
                } else {
                    throw new Exception("Insufficient Item.", 500);
                }
            }
        });
    }

    public function getItemInfoAttribute()
    {
        return Item::find($this->item_id);
    }

    public function getChargeAttribute()
    {
        $prices = Customer::find(
            Transaction::find($this->transaction_id)->customer_id
        )
            ->classification_id;

        switch ($this->type_of_service) {
            case "pickup":
                return $prices->pickup_charge;
                break;
            case "delivery":
                return $prices->delivery_charge;
                break;
            case "purchase":
                return $prices->purchase_charge;
                break;
            default:
                return abort(400);
        }
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
