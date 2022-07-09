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

    public function classification()
    {
        return $this->hasOne(Classification::class);
    }

    public function borrow()
    {
        return $this->hasMany(Borrow::class);
    }

    public function owned_item()
    {
        return $this->hasMany(OwnedItem::class);
    }
}
