<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'employee_id',
        'discount',
        'credit',
        'status',
        'transaction_date',
    ];

    protected $appends = ['employee_info', 'latest_transaction'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) { // before delete() method call this
            try {
                DB::beginTransaction();

                $model->orders()->delete();

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                abort(500);
            }
        });
    }

    public function getEmployeeInfoAttribute()
    {
        return Employee::find($this->employee_id);
    }

    public function getLatestTransactionAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }
}
