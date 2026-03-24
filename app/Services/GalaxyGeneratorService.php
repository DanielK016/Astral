<?php

namespace App\Services;

use App\Models\GameSession;
use App\Models\Player;

class GalaxyGeneratorService
{
    public function createAiPlayers(GameSession $session, string $playerRaceKey, int $aiCount): void
    {
        $races = array_keys(config('game.races_by_key'));
        $races = array_values(array_filter($races, fn($k) => $k !== $playerRaceKey));

        for ($i = 0; $i < $aiCount; $i++) {
            $raceKey = $races[$i % count($races)];
            Player::create([
                'game_session_id' => $session->id,
                'name' => config('game.races_by_key')[$raceKey]['name'] . ' (AI)',
                'race_key' => $raceKey,
                'is_ai' => 1,
                'passives_json' => json_encode([]),
                'active_key' => 'scan_boost',
            ]);
        }
    }

    public function generate(GameSession $session): void
    {
        
    }
}
