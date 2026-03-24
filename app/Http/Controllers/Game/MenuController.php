<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\GameSession;
use Illuminate\Support\Facades\Session;


class MenuController extends Controller
{
    public function menu()
    {
        return view('game.menu');
    }

    public function continue()
    {
        $sessions = GameSession::orderByDesc('id')->limit(20)->get();
        return view('game.continue', compact('sessions'));
    }

    public function load(GameSession $session)
    {
        Session::put('game.session_id', $session->id);

        $player = $session->players()->where('is_ai', 0)->first();
        if ($player) Session::put('game.player_id', $player->id);

        return redirect()->route('game.galaxy', ['session' => $session->id]);
    }

    public function settings()
    {
        return view('game.settings');
    }
}
