<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'address',
        'contact_number',
    ];

    protected $appends = ['fullname', 'register_customer'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) { // before delete() method call this
            try {
                DB::beginTransaction();

                $model->transactions()->delete();
                $model->orders()->delete();
                $model->borrows()->delete();

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                abort(500);
            }
        });
    }

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->middlename . ' ' . $this->lastname;
    }

    public function getRegisterCustomerAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
