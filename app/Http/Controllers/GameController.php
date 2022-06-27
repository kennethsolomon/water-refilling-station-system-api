<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GameController extends Controller
{
    function setGameConfig(Request $request)
    {
        if ($request->has('new')) {
            $game = Game::find(1)->first();
            $game->deck_id = $request->deck_id;
            $game->drawn_card = $request->drawn_card;
            $game->card_remaining = $request->card_remaining;
            $game->current_playing = 1;
            $game->cards = $request->cards;
            $game->save();
            return response(null, Response::HTTP_CREATED);
        }

        $game = Game::find(1)->first();

        if ($request->has('cards')) {
            $game->cards = $request->cards;
        }

        if ($request->has('drawn_card')) {
            $game->drawn_card = $request->drawn_card;
            $game->save();
        }

        if ($request->has('current_playing')) {
            $game->current_playing = $request->current_playing;
        }

        if ($request->has('card_remaining')) {
            $game->card_remaining = $request->card_remaining;
            $game->save();
        }

        return response(null, Response::HTTP_CREATED);
    }

    public function getGameConfig()
    {
        return Game::first();
    }
}
