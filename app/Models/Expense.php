<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_type_id',
        'item_id',
        'note',
        'price',
        'quantity',
        'operation',
    ];

    protected $appends = ['expense_type_info', 'item_info'];

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            if (strtolower($model->expense_type_info->title) == 'item') {
                $model->restockItem($model);
            }
        });
    }

    public function getExpenseTypeInfoAttribute()
    {
        return ExpenseType::find($this->expense_type_id);
    }

    public function getItemInfoAttribute()
    {
        return Item::find($this->item_id);
    }

    public function item()
    {
        return $this->hasOne(Item::class);
    }

    public function expense_type()
    {
        return $this->hasOne(ExpenseItem::class);
    }

    public function restockItem($model)
    {
        $operations = array("add", "subtract");
        if (in_array($model->operation, $operations)) {
            $item = Item::find($model->item_id);
            $model->operation == 'add'
                ?  $item->quantity += $model->quantity
                : (($item->quantity -= $model->quantity) < 0
                    ? throw new Exception("Not enough stock, Invalid Operation.", 500)
                    : true);
            $item->save();
        } else {
            throw new Exception("Invalid Selected Operation", 500);
        }
    }
}
