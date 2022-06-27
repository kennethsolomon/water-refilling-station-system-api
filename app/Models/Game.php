<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'deck_id'
    ];

    protected $casts = [
        'cards' => 'array',
    ];

    public function getCardsAttribute($cards)
    {
        return json_decode($cards);
    }

    public function player()
    {
        return $this->hasMany(Player::class);
    }
}
