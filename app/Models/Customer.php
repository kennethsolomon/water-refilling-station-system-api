<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    protected $appends = ['classification_id'];

    public function getClassificationIdAttribute($classification_id)
    {
        return Classification::find($classification_id);
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
