<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\GameSetupService;


class NewGameController extends Controller
{
    public function difficulty()
    {
        return view('game.difficulty');
    }

    public function storeDifficulty(Request $request)
    {
        Session::put('newgame.difficulty', $request->input('difficulty', 'normal'));
        return redirect()->route('newgame.race');
    }

    public function race(Request $request)
    {
        $races = config('game.races');
        $count = max(1, count($races));

        $i = null;
        if ($request->has('i')) {
            $i = (int) $request->query('i');
        } else {
            $savedKey = (string) Session::get('newgame.race', '');
            if ($savedKey !== '') {
                foreach ($races as $idx => $r) {
                    if (($r['key'] ?? null) === $savedKey) {
                        $i = (int) $idx;
                        break;
                    }
                }
            }
        }

        if ($i === null) {
            $i = 0;
        }
        $i = ($i % $count + $count) % $count;

        $race = $races[$i];
        $prevIndex = ($i - 1 + $count) % $count;
        $nextIndex = ($i + 1) % $count;

        $raceUi = [
            'humans' => [
                'banner' => 'assets/img_model_main/human/RASA/human_baner.png',
                'icon'   => 'assets/img_model_main/human/RASA/human_icon.png',
                'planet' => 'assets/img_model_main/human/RASA/human_planet.png',
                'avatar' => 'assets/img_model_main/human/RASA/human_avatar.png',
                'ship'   => 'assets/img_model_main/human/RASA/human_ship.png',
                'history'=> "United Terran Federation — a resilient, united human civilization.\n\nIts worlds are bound by diplomacy, scientific ambition, and disciplined expansion across the stars.",
            ],
            'lorians' => [
                'banner' => 'assets/img_model_main/zab_human/RASA/zab_human_baner.png',
                'icon'   => 'assets/img_model_main/zab_human/RASA/zab_human_icon.png',
                'planet' => 'assets/img_model_main/zab_human/RASA/zab_human_planet.png',
                'avatar' => 'assets/img_model_main/zab_human/RASA/zab_human_avatar.png',
                'ship'   => 'assets/img_model_main/zab_human/RASA/zab_human_ship.png',
                'history'=> "Lorian Remnant — descendants of a lost colony rebuilt through steel and memory.\n\nThey survive through cybernetic adaptation, defensive doctrine, and relentless repair under pressure.",
            ],
            'zeth' => [
                'banner' => 'assets/img_model_main/roi/RASA/roi_baner.png',
                'icon'   => 'assets/img_model_main/roi/RASA/roi_icon.png',
                'planet' => 'assets/img_model_main/roi/RASA/roi_planet.png',
                'avatar' => 'assets/img_model_main/roi/RASA/roi_avatar.png',
                'ship'   => 'assets/img_model_main/roi/RASA/roi_ship.png',
                'history'=> "Zeth Hive — a collective mind where no single voice exists apart from the swarm.\n\nIt overwhelms its enemies with perfect coordination, explosive growth, and absolute unity of purpose.",
            ],
        ];

        $assets = $raceUi[$race['key']] ?? $raceUi['humans'];

        return view('game.race', compact('races', 'race', 'i', 'prevIndex', 'nextIndex', 'assets'));
    }

    public function storeRace(Request $request)
    {
        Session::put('newgame.race', $request->input('race_key', 'humans'));
        return redirect()->route('newgame.configure');
    }

    public function configure()
    {
        $passives = config('game.passives');
        $actives  = config('game.actives');

        $selectedPassives = Session::get('newgame.passives', []);
        $selectedActive   = Session::get('newgame.active', 'deep_scan');
        $galaxySize       = Session::get('newgame.galaxy_size', 'medium');
        $aiCount          = Session::get('newgame.ai_count', 2);

        return view('game.configure', compact('passives','actives','selectedPassives','selectedActive','galaxySize','aiCount'));
    }

    public function storeConfigure(Request $request)
    {
        $passives = array_slice(array_values(array_unique($request->input('passives', []))), 0, 2);

        Session::put('newgame.passives', $passives);
        Session::put('newgame.active', $request->input('active', 'deep_scan'));
        Session::put('newgame.galaxy_size', $request->input('galaxy_size', 'medium'));
        Session::put('newgame.ai_count', (int)$request->input('ai_count', 2));

        return redirect()->route('newgame.generate');
    }

    public function generating()
    {
        return view('game.generating');
    }

    public function runGenerate(GameSetupService $setup)
    {
        $session = $setup->createSession([
            'difficulty' => Session::get('newgame.difficulty', 'normal'),
            'race_key' => Session::get('newgame.race', 'humans'),
            'passives' => Session::get('newgame.passives', []),
            'active_key' => Session::get('newgame.active', 'deep_scan'),
            'galaxy_size' => Session::get('newgame.galaxy_size', 'medium'),
            'ai_count' => Session::get('newgame.ai_count', 2),
        ]);

        Session::put('game.session_id', $session->id);

        $human = $session->players()->where('is_ai', 0)->first();
        if ($human) {
            Session::put('game.player_id', $human->id);
        }

        return redirect()->route('game.galaxy', ['session' => $session->id]);
    }
}
