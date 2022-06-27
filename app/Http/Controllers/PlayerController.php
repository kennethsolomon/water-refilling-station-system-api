<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    function getAllPlayers()
    {
        return Player::with(['bet'])->get();
    }
}
