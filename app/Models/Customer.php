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
        'classification_id',
        'firstname',
        'middlename',
        'lastname',
        'address',
        'contact_number',
    ];

    protected $appends = ['classification_id', 'fullname'];

    public static function boot() {
        parent::boot();

        static::deleting(function($model) { // before delete() method call this
            try {
                DB::beginTransaction();

                $model->transactions()->delete();
                $model->orders()->delete();
                $model->borrows()->delete();

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
                abort(405);
            }
        });
    }

    public function getClassificationIdAttribute($classification_id)
    {
        return Classification::find($classification_id);
    }

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->middlename . ' ' . $this->lastname;
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
