<?php

namespace App\Models;

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
        'quantity'
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

        // TODO: update Item

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
        $item = Item::find($model->item_id);
        $item->quantity += $model->quantity;
        $item->save();
    }
}
