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
        'quantity',
        'type_of_service',
        'is_borrow',
        'is_free',
    ];

    protected $appends = ['item_id', 'charge'];

    public function getItemIdAttribute($item_id)
    {
        return Item::find($item_id);
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
}
