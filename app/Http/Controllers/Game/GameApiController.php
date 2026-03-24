<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\GameSession;
use App\Models\Player;
use App\Models\StarSystem;
use App\Models\Hyperlane;
use App\Models\Planet;
use App\Models\PlanetBuilding;
use App\Models\Fleet;
use App\Models\SystemVisibility;
use App\Models\DiplomaticRelation;
use App\Models\SystemEncounter;
use Illuminate\Support\Facades\DB;
use App\Services\PlanetFactoryService;


class GameApiController extends Controller
{
    private function playerOrFail(GameSession $session, ?int $playerId): Player
    {
        $pid = $playerId ?: (int)Session::get('game.player_id');
        return Player::where('id', $pid)->where('game_session_id', $session->id)->firstOrFail();
    }

    private function fleetVariant(Fleet $fleet, int $index = 0): string
    {
        $name = mb_strtolower((string) $fleet->name);

        if (str_contains($name, 'heavy')) return 'heavy';
        if (str_contains($name, 'medium')) return 'medium';
        if (str_contains($name, 'scout') || str_contains($name, 'light') || str_contains($name, 'lite') || str_contains($name, 'litel') || str_contains($name, 'little')) return 'litle';
        if (str_contains($name, 'defense')) return 'medium';

        return ['litle', 'medium', 'heavy'][$index % 3] ?? 'litle';
    }

    private function fleetVariantFromName(string $name): string
    {
        $name = mb_strtolower($name);

        if (str_contains($name, 'heavy')) {
            return 'heavy';
        }

        if (str_contains($name, 'medium') || str_contains($name, 'defense')) {
            return 'medium';
        }

        if (
            str_contains($name, 'scout')
            || str_contains($name, 'light')
            || str_contains($name, 'lite')
            || str_contains($name, 'litel')
            || str_contains($name, 'little')
        ) {
            return 'lite';
        }

        return 'lite';
    }

    private function summarizeSystemResources(GameSession $session, Player $player, int $systemId): array
    {
        return app(PlanetFactoryService::class)->summarizeSystemResources($session, $player, $systemId);
    }

    private function defaultPlanetIdInSystem(int $systemId): ?int
    {
        return Planet::where('star_system_id', $systemId)
            ->orderByDesc('is_capital')
            ->orderBy('orbit_radius')
            ->value('id');
    }

    public function galaxy(Request $request, GameSession $session)
    {
        $player = $this->playerOrFail($session, (int)$request->query('player'));

        $galaxyId = $session->galaxy_id;

        $visMap = SystemVisibility::where('player_id', $player->id)->pluck('status', 'star_system_id')->all();

        $systems = StarSystem::where('galaxy_id', $galaxyId)->get()->map(function ($s) use ($visMap, $player, $session) {
            $status = $visMap[$s->id] ?? 'unknown';
            $total_yields = null;
            if (in_array($status, ['discovered', 'surveyed'], true)) {
                $total_yields = $this->summarizeSystemResources($session, $player, (int)$s->id);
            }
            return [
                'id' => $s->id,
                'name' => $s->name,
                'x' => $s->x,
                'y' => $s->y,
                'z' => $s->z,
                'color' => $s->color_hex,
                'scale' => $s->base_scale,
                'temp' => $s->temperature,
                'visibility' => $status,
                'owner_player_id' => $s->owner_player_id,
                'threat' => $s->threat_level,
                'total_yields' => $total_yields,
            ];
        })->values();

        $systemLookup = $systems->keyBy('id');
        $lanesRaw = Hyperlane::where('galaxy_id', $galaxyId)
            ->get()
            ->sortBy(function ($lane) use ($systemLookup) {
                $from = $systemLookup->get((int) $lane->from_star_system_id);
                $to = $systemLookup->get((int) $lane->to_star_system_id);
                if (!$from || !$to) {
                    return PHP_INT_MAX;
                }
                $dx = ((float) $from['x']) - ((float) $to['x']);
                $dy = ((float) $from['y']) - ((float) $to['y']);
                $dz = ((float) $from['z']) - ((float) $to['z']);
                return ($dx * $dx) + ($dy * $dy) + ($dz * $dz);
            })
            ->values();

        $laneDegrees = [];
        $lanes = [];
        foreach ($lanesRaw as $l) {
            $fromId = (int) $l->from_star_system_id;
            $toId = (int) $l->to_star_system_id;

            if (($laneDegrees[$fromId] ?? 0) >= 4 || ($laneDegrees[$toId] ?? 0) >= 4) {
                continue;
            }

            $laneDegrees[$fromId] = ($laneDegrees[$fromId] ?? 0) + 1;
            $laneDegrees[$toId] = ($laneDegrees[$toId] ?? 0) + 1;
            $lanes[] = [
                'from' => $fromId,
                'to' => $toId,
            ];
        }

        $raceMap = config('game.races_by_key');
        $ownerColors = [];
        $playersMeta = [];
        foreach ($session->players()->get() as $pl) {
            $color = $raceMap[$pl->race_key]['color'] ?? '#4cc3ff';
            $ownerColors[$pl->id] = $color;
            $playersMeta[$pl->id] = [
                'id' => (int)$pl->id,
                'name' => (string)$pl->name,
                'race_key' => (string)$pl->race_key,
                'color' => (string)$color,
                'home_star_system_id' => $pl->home_star_system_id ? (int)$pl->home_star_system_id : null,
                'is_ai' => (bool)$pl->is_ai,
            ];
        }

        $fleets = Fleet::whereIn('player_id', $session->players()->pluck('id')->all())
            ->get()
            ->map(function ($f) use ($playersMeta) {
                $raceKey = $playersMeta[$f->player_id]['race_key'] ?? 'humans';
                return [
                    'id' => $f->id,
                    'player_id' => $f->player_id,
                    'system_id' => $f->star_system_id,
                    'power' => $f->power,
                    'mission' => $f->mission,
                    'race_key' => $raceKey,
                    'ship_variant' => $this->fleetVariantFromName($f->name),
                ];
            })->values();

        $rels = DiplomaticRelation::where('game_session_id', $session->id)->get();
        $relMap = [];
        foreach ($rels as $r) {
            if ((int)$r->a_player_id === (int)$player->id) $relMap[(int)$r->b_player_id] = $r->status;
            if ((int)$r->b_player_id === (int)$player->id) $relMap[(int)$r->a_player_id] = $r->status;
        }

        return response()->json([
            'session' => ['id' => $session->id, 'turn' => $session->turn],
            'player' => ['id' => $player->id, 'race_key' => $player->race_key],
            'relations' => $relMap,
            'ownerColors' => $ownerColors,
            'playersMeta' => $playersMeta,
            'systems' => $systems,
            'hyperlanes' => $lanes,
            'fleets' => $fleets,
        ]);
    }



 public function system(Request $request, GameSession $session, StarSystem $system)
{
    $player = $this->playerOrFail($session, (int) $request->query('player'));

    if ((int) $system->galaxy_id !== (int) $session->galaxy_id) {
        abort(404);
    }

    $vis = SystemVisibility::where('player_id', $player->id)
        ->where('star_system_id', $system->id)
        ->first();

    $status = $vis ? $vis->status : 'unknown';

    $isKnownSystem = in_array($status, ['discovered', 'surveyed'], true);
    $revealedByInfluence = !$isKnownSystem
        && $this->isSystemInsidePlayerInfluence($session, $player, $system);

    $playersById = Player::whereIn('id', $session->players()->pluck('id')->all())
        ->get()
        ->keyBy('id');

    $systemOwner = $system->owner_player_id
        ? $playersById->get((int) $system->owner_player_id)
        : null;

    if ($player->home_star_system_id && (int) $player->home_star_system_id === (int) $system->id) {
        app(PlanetFactoryService::class)->ensureCapitalFactories($session, $player, $system);
    }

    $factoryService = app(PlanetFactoryService::class);

    $planets = Planet::where('star_system_id', $system->id)
        ->orderByDesc('is_capital')
        ->orderBy('orbit_radius')
        ->get()
        ->map(function ($p) use ($status, $systemOwner, $player, $session, $factoryService, $revealedByInfluence) {
            $known = in_array($status, ['discovered', 'surveyed'], true);
            $showIdentity = $known || $revealedByInfluence;
            $showResources = $known;

            $factoryStatus = $factoryService->factoryStatusForPlanet($session, $player, $p);
            $yields = $showResources
                ? $factoryService->calculatePlanetYields($session, $player, $p)
                : null;

            return [
                'id' => $p->id,
                'name' => $showIdentity ? $p->name : 'Unknown',
                'type' => $showIdentity ? $p->type : 'unknown',
                'orbit' => (float) $p->orbit_radius,
                'radius' => (float) $p->radius,
                'rotation' => (float) $p->rotation_speed,
                'axial_tilt' => (float) ($p->axial_tilt ?? 0),
                'has_rings' => (bool) $p->has_rings,
                'slots' => $showIdentity ? $p->size_slots : null,
                'population' => $showIdentity ? $p->population : null,
                'happiness' => $showIdentity ? $p->happiness : null,
                'specialization' => $showIdentity ? $p->specialization : null,
                'is_capital' => $showIdentity ? (bool) $p->is_capital : false,
                'capital_race_key' => $showIdentity && $p->is_capital ? ($systemOwner?->race_key) : null,
                'yields' => $yields,
                'factory' => $known ? ($factoryStatus['current_factory'] ?? null) : null,
                'factory_allowed_key' => $known ? ($factoryStatus['allowed_key'] ?? null) : null,
                'factory_unlock_turns_remaining' => $known ? ($factoryStatus['unlock_turns_remaining'] ?? null) : null,
            ];
        })
        ->values();

    $rows = DB::table('hyperlanes')
        ->where('galaxy_id', $session->galaxy_id)
        ->where(function ($q) use ($system) {
            $q->where('from_star_system_id', $system->id)
              ->orWhere('to_star_system_id', $system->id);
        })
        ->get();

    $neighbors = [];
    foreach ($rows as $r) {
        $nid = ((int) $r->from_star_system_id === (int) $system->id)
            ? (int) $r->to_star_system_id
            : (int) $r->from_star_system_id;

        $s = StarSystem::find($nid);
        if (!$s) {
            continue;
        }

        $v = SystemVisibility::where('player_id', $player->id)
            ->where('star_system_id', $nid)
            ->first();

        $neighbors[] = [
            'id' => $s->id,
            'name' => $s->name,
            'visibility' => $v ? $v->status : 'unknown',
            'x' => (float) $s->x,
            'y' => (float) $s->y,
            'z' => (float) $s->z,
            'color' => $s->color_hex,
        ];
    }

    $neighbors = collect($neighbors)
        ->sortBy(function (array $neighbor) use ($system) {
            $dx = ((float) $neighbor['x']) - (float) $system->x;
            $dy = ((float) $neighbor['y']) - (float) $system->y;
            $dz = ((float) $neighbor['z']) - (float) $system->z;

            return ($dx * $dx) + ($dy * $dy) + ($dz * $dz);
        })
        ->take(4)
        ->values()
        ->all();

    $fleets = Fleet::whereIn('player_id', $playersById->keys()->all())
        ->where('star_system_id', $system->id)
        ->orderBy('id')
        ->get()
        ->values()
        ->map(function ($f, $index) use ($playersById) {
            $fleetPlayer = $playersById->get((int) $f->player_id);

            return [
                'id' => $f->id,
                'player_id' => (int) $f->player_id,
                'planet_id' => $f->planet_id ? (int) $f->planet_id : null,
                'name' => $f->name,
                'mission' => $f->mission,
                'power' => (int) $f->power,
                'race_key' => $fleetPlayer?->race_key,
                'ship_variant' => $this->fleetVariant($f, $index),
            ];
        })
        ->values();

    $encounter = SystemEncounter::with('enemyPlayer')
        ->where('game_session_id', $session->id)
        ->where('player_id', $player->id)
        ->where('star_system_id', $system->id)
        ->where('status', '!=', 'resolved')
        ->latest('id')
        ->first();

    return response()->json([
        'visibility' => $status,
        'revealed_by_influence' => $revealedByInfluence,
        'system' => [
            'id' => (int) $system->id,
            'name' => $system->name,
            'x' => (float) $system->x,
            'y' => (float) $system->y,
            'z' => (float) $system->z,
            'color' => $system->color_hex,
            'scale' => (float) $system->base_scale,
            'temp' => (int) $system->temperature,
            'owner_player_id' => $system->owner_player_id ? (int) $system->owner_player_id : null,
        ],
        'system_owner_race_key' => $systemOwner?->race_key,
        'planets' => $planets,
        'neighbors' => $neighbors,
        'fleets' => $fleets,
        'encounter' => $encounter ? [
            'id' => (int) $encounter->id,
            'status' => (string) $encounter->status,
            'enemy_player_id' => (int) $encounter->enemy_player_id,
            'enemy_race_key' => (string) ($encounter->enemyPlayer?->race_key ?? 'humans'),
            'enemy_name' => (string) ($encounter->enemyPlayer?->name ?? 'Enemy'),
            'enemy_ship_type' => (string) ($encounter->enemy_ship_type ?? 'medium'),
            'turns_remaining' => $encounter->turns_remaining === null ? null : (int) $encounter->turns_remaining,
        ] : null,
    ]);
}

public function planet(Request $request, GameSession $session, Planet $planet)
{
    $player = $this->playerOrFail($session, (int)$request->query('player'));
    $system = $planet->system;
    if ((int)$system->galaxy_id !== (int)$session->galaxy_id) abort(404);

    $vis = SystemVisibility::where('player_id', $player->id)->where('star_system_id', $system->id)->first();
    $known = $vis && in_array($vis->status, ['discovered', 'surveyed'], true);
$revealedByInfluence = !$known && $this->isSystemInsidePlayerInfluence($session, $player, $system);

if (!$known && !$revealedByInfluence) {
    return response()->json(['error' => 'not known'], 403);
}

    if ($player->home_star_system_id && (int) $player->home_star_system_id === (int) $system->id) {
        app(PlanetFactoryService::class)->ensureCapitalFactories($session, $player, $system);
    }

    $factoryService = app(PlanetFactoryService::class);
    $factoryStatus = $factoryService->factoryStatusForPlanet($session, $player, $planet);

    $buildings = collect();
    if (!empty($factoryStatus['current_factory'])) {
        $buildings->push([
            'slot' => $factoryStatus['current_factory']['slot'],
            'key' => $factoryStatus['current_factory']['key'],
        ]);
    }

    $playersById = Player::where('game_session_id', $session->id)->get()->keyBy('id');

    $systemOwner = $system->owner_player_id
        ? $playersById->get((int) $system->owner_player_id)
        : null;

    $stationedFleet = Fleet::whereIn('player_id', $playersById->keys()->all())
        ->where('star_system_id', $system->id)
        ->where('planet_id', $planet->id)
        ->orderBy('id')
        ->first();

    $stationedFleetPlayer = $stationedFleet
        ? $playersById->get((int) $stationedFleet->player_id)
        : null;

    return response()->json([
        'planet' => [
            'id' => $planet->id,
            'name' => $planet->name,
            'type' => $planet->type,
            'slots' => $planet->size_slots,
            'population' => $planet->population,
            'happiness' => $planet->happiness,
            'specialization' => $planet->specialization,
            'is_capital' => (bool)$planet->is_capital,
            'base_yields' => $planet->base_yields,
            'yields' => $factoryService->calculatePlanetYields($session, $player, $planet),
            'factory_status' => $factoryStatus,
            'owner_race_key' => $systemOwner?->race_key,
            'stationed_fleet' => $stationedFleet ? [
                'id' => $stationedFleet->id,
                'name' => $stationedFleet->name,
                'mission' => $stationedFleet->mission,
                'ship_variant' => $this->fleetVariant($stationedFleet, 0),
                'race_key' => $stationedFleetPlayer?->race_key ?? 'humans',
            ] : null,
        ],
        'buildings' => $buildings->values(),
        'build_options' => $factoryService->buildOptionsForPlanet($planet),
    ]);
}      
    public function moveFleets(Request $request, GameSession $session)
    {
        $player = $this->playerOrFail($session, (int) $request->input('player'));

        $fleetIds = collect($request->input('fleet_ids', []))
            ->map(fn($id) => (int) $id)
            ->filter()
            ->values();

        $targetSystemId = (int) $request->input('target_star_system_id', 0);

        if ($fleetIds->isEmpty() || $targetSystemId <= 0) {
            return response()->json([
                'ok' => false,
                'message' => 'Invalid fleet selection or target system.',
            ], 422);
        }

        $targetSystem = \App\Models\StarSystem::where('galaxy_id', $session->galaxy_id)
            ->where('id', $targetSystemId)
            ->first();

        if (!$targetSystem) {
            return response()->json([
                'ok' => false,
                'message' => 'Target system not found.',
            ], 404);
        }

        $moved = [];
        $errors = [];

        foreach ($fleetIds as $fleetId) {
            $fleet = Fleet::where('id', $fleetId)
                ->where('player_id', $player->id)
                ->first();

            if (!$fleet) {
                $errors[] = "Fleet {$fleetId} not found.";
                continue;
            }

            $currentSystemId = (int) $fleet->star_system_id;

            if ($currentSystemId === $targetSystemId) {
                continue;
            }

            $isNeighbor = DB::table('hyperlanes')
                ->where('galaxy_id', $session->galaxy_id)
                ->where(function ($q) use ($currentSystemId, $targetSystemId) {
                    $q->where(function ($q2) use ($currentSystemId, $targetSystemId) {
                        $q2->where('from_star_system_id', $currentSystemId)
                            ->where('to_star_system_id', $targetSystemId);
                    })->orWhere(function ($q2) use ($currentSystemId, $targetSystemId) {
                        $q2->where('from_star_system_id', $targetSystemId)
                            ->where('to_star_system_id', $currentSystemId);
                    });
                })
                ->exists();

            if (!$isNeighbor) {
                $errors[] = "Fleet {$fleetId}: target system is not adjacent.";
                continue;
            }

            $existingTargetVisibility = SystemVisibility::where('player_id', $player->id)
                ->where('star_system_id', $targetSystemId)
                ->first();

            $wasUnknown = !$existingTargetVisibility || $existingTargetVisibility->status === 'unknown';

            $fleet->star_system_id = $targetSystemId;
            $fleet->planet_id = $this->defaultPlanetIdInSystem($targetSystemId);
            $fleet->mission = 'idle';
            $fleet->target_star_system_id = null;
            $fleet->mission_progress = 0;
            $fleet->save();

            if ($player->home_star_system_id && (int) $player->home_star_system_id === $currentSystemId) {
                app(PlanetFactoryService::class)->setVisibilityForPlayer($player, $currentSystemId, 'surveyed', (int) $session->turn);
            }

            app(PlanetFactoryService::class)->setVisibilityForPlayer($player, $targetSystemId, 'discovered', (int) $session->turn);

            if ($wasUnknown) {
                // optional: aici poți adăuga mai târziu logica de encounter
            }

            $moved[] = $fleetId;
        }

        return response()->json([
            'ok' => true,
            'moved' => $moved,
            'errors' => $errors,
        ]);
    }
    private function isSystemInsidePlayerInfluence(GameSession $session, Player $player, StarSystem $targetSystem): bool
{
    $ownedSystems = StarSystem::query()
        ->where('galaxy_id', $session->galaxy_id)
        ->where('owner_player_id', $player->id)
        ->get(['id', 'x', 'z']);

    if ($ownedSystems->isEmpty() && $player->home_star_system_id) {
        $homeSystem = StarSystem::query()
            ->where('galaxy_id', $session->galaxy_id)
            ->where('id', $player->home_star_system_id)
            ->first(['id', 'x', 'z']);

        if ($homeSystem) {
            $ownedSystems = collect([$homeSystem]);
        }
    }

    if ($ownedSystems->isEmpty()) {
        return false;
    }

    $centerSystem = $ownedSystems->firstWhere('id', (int) $player->home_star_system_id)
        ?: $ownedSystems->first();

    if (!$centerSystem) {
        return false;
    }

    $radius = 95.0;

    foreach ($ownedSystems as $owned) {
        $dx = (float) $owned->x - (float) $centerSystem->x;
        $dz = (float) $owned->z - (float) $centerSystem->z;
        $dist = sqrt(($dx * $dx) + ($dz * $dz));

        $radius = max($radius, $dist + 55.0);
    }

    $targetDx = (float) $targetSystem->x - (float) $centerSystem->x;
    $targetDz = (float) $targetSystem->z - (float) $centerSystem->z;
    $targetDist = sqrt(($targetDx * $targetDx) + ($targetDz * $targetDz));

    return $targetDist <= $radius;
}
}
