<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $casts = [
        'cards' => 'array',
    ];

    public function getCardsAttribute($cards)
    {
        return json_decode($cards);
    }

    public function bet()
    {
        return $this->hasOne(Bet::class);
    }

    public function game()
    {
        return $this->hasOne(Game::class);
    }
}
