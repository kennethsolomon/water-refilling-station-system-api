<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $casts = [
        'cards' => 'array',
        'shuffled_cards' => 'string'
    ];

    public function getCardsAttribute($cards)
    {
        return json_decode($cards);
    }
}
