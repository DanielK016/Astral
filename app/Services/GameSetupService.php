<?php

namespace App\Services;

use App\Models\GameSession;
use App\Models\Galaxy;
use App\Models\Player;
use App\Models\Fleet;
use App\Models\StarSystem;
use App\Models\Planet;
use App\Models\PlanetBuilding;
use App\Models\SystemVisibility;
use App\Services\PlanetFactoryService;
use Illuminate\Support\Facades\DB;


class GameSetupService
{
    public function createSession(array $opts): GameSession
    {
        $difficulty = $opts['difficulty'] ?? 'normal';
        $galaxySize = $opts['galaxy_size'] ?? 'medium';
        $aiCount    = (int)($opts['ai_count'] ?? 2);

        $sizeMap = ['small' => 120, 'medium' => 240, 'large' => 360];
        $systemCount = $sizeMap[$galaxySize] ?? 240;

        $seed = random_int(1, 2_000_000_000);

        return DB::transaction(function () use ($difficulty, $galaxySize, $aiCount, $systemCount, $seed, $opts) {
            $galaxy = Galaxy::create([
                'name' => 'Galaxy',
                'seed' => $seed,
                'size' => $systemCount,
                'arms' => 4,
            ]);

            $session = GameSession::create([
                'galaxy_id' => $galaxy->id,
                'turn' => 1,
                'difficulty' => $difficulty,
                'galaxy_size' => $galaxySize,
                'ai_count' => $aiCount,
                'state' => 'active',
                'round_phase' => 0,
            ]);

            $raceKey = $opts['race_key'] ?? 'humans';
            $passives = $opts['passives'] ?? [];
            $active   = $opts['active_key'] ?? 'deep_scan';

            $raceMap = config('game.races_by_key');

            $human = Player::create([
                'game_session_id' => $session->id,
                'name' => $raceMap[$raceKey]['name'],
                'race_key' => $raceKey,
                'is_ai' => 0,
                'passives_json' => json_encode($passives),
                'active_key' => $active,
            ]);

            $this->createAiPlayers($session, $raceKey, $aiCount);

            app(GalaxyGenerator::class)->generate($galaxy, $seed, $systemCount, 4);

            $players = $session->players()->orderBy('id')->get();
            $startSystems = $this->pickStartSystems($galaxy, $players->count());

            foreach ($players as $i => $p) {
                $sys = $startSystems[$i] ?? $startSystems[0];
                $this->setupEmpireStart($session, $p, $sys, $i === 0);
            }

            $session->current_player_id = $human->id;
            $session->save();

            return $session;
        });
    }

    private function createAiPlayers(GameSession $session, string $playerRaceKey, int $aiCount): void
    {
        $raceKeys = array_keys(config('game.races_by_key'));
        $raceKeys = array_values(array_filter($raceKeys, fn($k) => $k !== $playerRaceKey));

        for ($i = 0; $i < $aiCount; $i++) {
            $raceKey = $raceKeys[$i % count($raceKeys)];
            Player::create([
                'game_session_id' => $session->id,
                'name' => config('game.races_by_key')[$raceKey]['name'] . ' (AI)',
                'race_key' => $raceKey,
                'is_ai' => 1,
                'passives_json' => json_encode([]),
                'active_key' => 'deep_scan',
            ]);
        }
    }

    private function pickStartSystems(Galaxy $galaxy, int $count): array
    {
        $systems = StarSystem::where('galaxy_id', $galaxy->id)->get()->values();
        if ($systems->isEmpty()) return [];

        $chosen = [];
        $chosen[] = $systems->random();

        while (count($chosen) < $count) {
            $best = null;
            $bestD = -1;
            foreach ($systems as $s) {
                $minD = INF;
                foreach ($chosen as $c) {
                    $dx = $s->x - $c->x;
                    $dy = $s->y - $c->y;
                    $dz = $s->z - $c->z;
                    $d = $dx * $dx + $dy * $dy + $dz * $dz;
                    if ($d < $minD) $minD = $d;
                }
                if ($minD > $bestD) {
                    $bestD = $minD;
                    $best = $s;
                }
            }
            if (!$best) break;
            $chosen[] = $best;
        }

        return $chosen;
    }

    private function setupEmpireStart(GameSession $session, Player $player, StarSystem $home, bool $isHuman): void
    {
        $home->owner_player_id = $player->id;
        $home->save();

        $player->home_star_system_id = $home->id;

        $player->influence = 20;
        $player->unity = 10;
        $player->influence_income = 1;
        $player->unity_income = 0;

        $player->energy = 100;
        $player->minerals = 120;
        $player->science = 0;
        $player->rare_metals = 0;
        $player->exotic_gases = 0;
        $player->xenocultures = 0;

        $player->save();

        $capital = Planet::where('star_system_id', $home->id)->orderBy('id')->first();
        if ($capital) {
            $capital->is_capital = true;
            $capital->population = 20;
            $capital->happiness = 0.75;
            $capital->size_slots = max(10, min(18, (int)round($capital->radius * 10)));
            $capital->specialization = 'balanced';

            $typeCfg = config('game.planet_types')[$capital->type] ?? ['yields' => ['energy' => 3, 'minerals' => 3, 'science' => 2]];
            $capital->base_yields = $typeCfg['yields'];
            $capital->save();

            $this->ensureBuilding($capital, 0, 'power');
            $this->ensureBuilding($capital, 1, 'mine');
            $this->ensureBuilding($capital, 2, 'lab');
            $this->ensureBuilding($capital, 3, 'shipyard');
            $this->ensureBuilding($capital, 4, 'culture');

            app(PlanetFactoryService::class)->ensureCapitalFactories($session, $player, $home);
        }

        $this->setVisibility($player, $home->id, 'surveyed');

        $neighbors = $this->neighborSystems($session->galaxy_id, $home->id);
        foreach ($neighbors as $nid) {
            $this->setVisibility($player, $nid, 'discovered');
        }
        $homePlanetId = $capital?->id
            ?: Planet::where('star_system_id', $home->id)
            ->orderByDesc('is_capital')
            ->orderBy('orbit_radius')
            ->value('id');
        Fleet::create([
            'player_id' => $player->id,
            'star_system_id' => $home->id,
            'planet_id' => $homePlanetId,
            'name' => 'Scout Fleet',
            'mission' => 'idle',
            'speed' => 1,
            'power' => 10,
        ]);

        Fleet::create([
            'player_id' => $player->id,
            'star_system_id' => $home->id,
            'planet_id' => $homePlanetId,
            'name' => 'Defense Fleet',
            'mission' => 'idle',
            'speed' => 1,
            'power' => 18,
        ]);
    }

    private function ensureBuilding(Planet $planet, int $slot, string $key): void
    {
        PlanetBuilding::updateOrCreate(
            ['planet_id' => $planet->id, 'slot_index' => $slot],
            ['building_key' => $key]
        );
    }

    private function setVisibility(Player $player, int $systemId, string $status): void
    {
        app(PlanetFactoryService::class)->setVisibilityForPlayer($player, $systemId, $status, (int) ($player->session->turn ?? 1));
    }

    private function neighborSystems(int $galaxyId, int $systemId): array
    {
        $rows = DB::table('hyperlanes')
            ->where('galaxy_id', $galaxyId)
            ->where(function ($q) use ($systemId) {
                $q->where('from_star_system_id', $systemId)->orWhere('to_star_system_id', $systemId);
            })->get();

        $ids = [];
        foreach ($rows as $r) {
            $ids[] = ($r->from_star_system_id == $systemId) ? (int)$r->to_star_system_id : (int)$r->from_star_system_id;
        }
        return array_values(array_unique($ids));
    }
}
