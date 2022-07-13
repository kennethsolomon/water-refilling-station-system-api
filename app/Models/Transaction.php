<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'employee_id',
        'discount',
        'credit',
        'status',
    ];

    protected $appends = ['employee_id'];

    public function getEmployeeIdAttribute($employee_id)
    {
        return Employee::find($employee_id);
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
