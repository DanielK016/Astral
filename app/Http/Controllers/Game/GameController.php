<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\DiplomaticRelation;
use App\Models\Fleet;
use App\Models\GameSession;
use App\Models\Planet;
use App\Models\PlanetBuilding;
use App\Models\Player;
use App\Models\StarSystem;
use App\Models\SystemEncounter;
use App\Services\GameTurnService;
use App\Services\PlanetFactoryService;

class GameController extends Controller
{
    private function currentPlayerOrFail(GameSession $session): Player
    {
        $playerId = Session::get('game.player_id');
        return Player::where('id', $playerId)->where('game_session_id', $session->id)->firstOrFail();
    }

    private function fleetVariant(Fleet $fleet, int $index = 0): string
    {
        $name = mb_strtolower((string) $fleet->name);

        if (str_contains($name, 'heavy')) {
            return 'heavy';
        }

        if (str_contains($name, 'medium')) {
            return 'medium';
        }

        if (
            str_contains($name, 'scout')
            || str_contains($name, 'light')
            || str_contains($name, 'lite')
            || str_contains($name, 'litel')
            || str_contains($name, 'little')
        ) {
            return 'litle';
        }

        if (str_contains($name, 'defense')) {
            return 'medium';
        }

        return ['litle', 'medium', 'heavy'][$index % 3] ?? 'litle';
    }

    private function calculatePlanetYields(GameSession $session, Player $player, Planet $planet): array
    {
        return app(PlanetFactoryService::class)->calculatePlanetYields($session, $player, $planet);
    }
    private function defaultPlanetIdInSystem(int $systemId): ?int
    {
        return Planet::where('star_system_id', $systemId)
            ->orderByDesc('is_capital')
            ->orderBy('orbit_radius')
            ->value('id');
    }

    private function ensureFleetRoster(Player $player): void
    {
        if (!$player->home_star_system_id) {
            return;
        }

        $existing = Fleet::where('player_id', $player->id)->orderBy('id')->get();
        if ($existing->count() >= 3) {
            return;
        }

        $existingVariants = [];
        $homePlanetId = $this->defaultPlanetIdInSystem((int) $player->home_star_system_id);
        foreach ($existing->values() as $index => $fleet) {
            $existingVariants[$this->fleetVariant($fleet, $index)] = true;
        }

        $defaults = [
            ['variant' => 'litle', 'name' => 'Scout Fleet', 'power' => 10],
            ['variant' => 'medium', 'name' => 'Defense Fleet', 'power' => 18],
            ['variant' => 'heavy', 'name' => 'Heavy Fleet', 'power' => 26],
        ];

        foreach ($defaults as $fleetDef) {
            if (!empty($existingVariants[$fleetDef['variant']])) {
                continue;
            }

            Fleet::create([
                'player_id' => $player->id,
                'star_system_id' => $player->home_star_system_id,
                'planet_id' => $homePlanetId,
                'name' => $fleetDef['name'],
                'mission' => 'idle',
                'target_star_system_id' => null,
                'mission_progress' => 0,
                'speed' => 1,
                'power' => $fleetDef['power'],
            ]);
        }
    }

    private function raceUi(?string $raceKey): array
    {
        $map = [
            'humans' => [
                'short_name' => __('dialogues.race_names.humans'),
                'empire_name' => 'Human',
                'icon' => asset('assets/img_model_main/human/RASA/human_icon.png'),
                'avatar' => asset('assets/img_model_main/human/RASA/human_avatar.png'),
                'planet' => asset('assets/img_model_main/human/RASA/human_planet.png'),
            ],
            'lorians' => [
                'short_name' => __('dialogues.race_names.lorians'),
                'empire_name' => 'Lorian Remnant',
                'icon' => asset('assets/img_model_main/zab_human/RASA/zab_human_icon.png'),
                'avatar' => asset('assets/img_model_main/zab_human/RASA/zab_human_avatar.png'),
                'planet' => asset('assets/img_model_main/zab_human/RASA/zab_human_planet.png'),
            ],
            'zeth' => [
                'short_name' => __('dialogues.race_names.zeth'),
                'empire_name' => 'Roi',
                'icon' => asset('assets/img_model_main/roi/RASA/roi_icon.png'),
                'avatar' => asset('assets/img_model_main/roi/RASA/roi_avatar.png'),
                'planet' => asset('assets/img_model_main/roi/RASA/roi_planet.png'),
            ],
        ];

        $base = $map[$raceKey ?? 'humans'] ?? $map['humans'];
        $base['key'] = $raceKey ?? 'humans';

        return $base;
    }

    private function baseDiplomacyScore(string $firstRaceKey, string $secondRaceKey): int
    {
        $pair = [$firstRaceKey, $secondRaceKey];
        sort($pair);
        $joined = implode(':', $pair);

        return match ($joined) {
            'humans:lorians' => -30,
            'humans:zeth', 'lorians:zeth' => -80,
            default => 0,
        };
    }

    private function clampDiplomacy(int $score): int
    {
        return max(-100, min(100, $score));
    }

    private function diplomacyBand(int $score): array
    {
        if ($score <= -80) {
            return ['key' => 'hostility', 'label' => __('dialogues.diplomacy_bands.hostility')];
        }
        if ($score <= -31) {
            return ['key' => 'antipathy', 'label' => __('dialogues.diplomacy_bands.antipathy')];
        }
        if ($score <= -6) {
            return ['key' => 'suspicion', 'label' => __('dialogues.diplomacy_bands.suspicion')];
        }
        if ($score <= 30) {
            return ['key' => 'neutral', 'label' => __('dialogues.diplomacy_bands.neutral')];
        }
        if ($score <= 79) {
            return ['key' => 'sympathy', 'label' => __('dialogues.diplomacy_bands.sympathy')];
        }
        if ($score <= 95) {
            return ['key' => 'friends', 'label' => __('dialogues.diplomacy_bands.friends')];
        }

        return ['key' => 'allies', 'label' => __('dialogues.diplomacy_bands.allies')];
    }

    private function syncRelationStatus(DiplomaticRelation $relation): void
    {
        if ($relation->status === 'war') {
            return;
        }

        $score = (int) ($relation->score ?? 0);
        $relation->status = $score >= 80 ? 'friendly' : 'neutral';
    }

    private function relationForPlayers(GameSession $session, Player $player, Player $other): DiplomaticRelation
    {
        [$a, $b] = DiplomaticRelation::key($player->id, $other->id);

        $relation = DiplomaticRelation::firstOrCreate(
            ['game_session_id' => $session->id, 'a_player_id' => $a, 'b_player_id' => $b],
            [
                'status' => 'neutral',
                'score' => $this->baseDiplomacyScore($player->race_key, $other->race_key),
            ]
        );

        if ($relation->score === null) {
            $relation->score = $this->baseDiplomacyScore($player->race_key, $other->race_key);
            $this->syncRelationStatus($relation);
            $relation->save();
        }

        return $relation;
    }

    private function applyDiplomacyDelta(GameSession $session, Player $player, Player $other, int $delta): DiplomaticRelation
    {
        $relation = $this->relationForPlayers($session, $player, $other);
        $relation->score = $this->clampDiplomacy((int) ($relation->score ?? 0) + $delta);
        $this->syncRelationStatus($relation);
        $relation->save();

        return $relation;
    }

    private function buildDiplomacyRows(GameSession $session, Player $player): array
    {
        $rows = [];
        $others = $session->players()->where('id', '!=', $player->id)->orderBy('id')->get();

        foreach ($others as $other) {
            $relation = $this->relationForPlayers($session, $player, $other);
            $score = (int) ($relation->score ?? 0);
            $band = $this->diplomacyBand($score);
            $ui = $this->raceUi($other->race_key);

            $rows[] = [
                'player_id' => $other->id,
                'race_key' => $other->race_key,
                'name' => $ui['empire_name'],
                'short_name' => $ui['short_name'],
                'icon' => $ui['icon'],
                'avatar' => $ui['avatar'],
                'score' => $score,
                'score_label' => sprintf('%+d', $score),
                'band_key' => $band['key'],
                'band_label' => $band['label'],
                'bar_percent' => (int) round((($score + 100) / 200) * 100),
                'status' => $relation->status,
            ];
        }

        return $rows;
    }

    private function buildEncounterSummaries(GameSession $session, Player $player): array
    {
        $encounters = SystemEncounter::with(['enemyPlayer', 'system'])
            ->where('game_session_id', $session->id)
            ->where('player_id', $player->id)
            ->where('status', '!=', 'resolved')
            ->orderByDesc('id')
            ->get();

        $rows = [];
        foreach ($encounters as $encounter) {
            $enemy = $encounter->enemyPlayer;
            if (!$enemy || !$encounter->system) {
                continue;
            }

            $relation = $this->relationForPlayers($session, $player, $enemy);
            $score = (int) ($relation->score ?? 0);
            $band = $this->diplomacyBand($score);
            $ui = $this->raceUi($enemy->race_key);

            $statusLabel = match ($encounter->status) {
                'battle' => __('dialogues.war.battle_in_progress', ['turns' => max(1, (int) $encounter->turns_remaining)]),
                'retreat' => __('dialogues.war.retreat_in_progress'),
                default => __('dialogues.war.hostile_contact'),
            };

            $rows[] = [
                'id' => $encounter->id,
                'system_id' => $encounter->star_system_id,
                'system_name' => $encounter->system->name,
                'enemy_player_id' => $enemy->id,
                'enemy_race_key' => $enemy->race_key,
                'enemy_name' => $ui['empire_name'],
                'enemy_short_name' => $ui['short_name'],
                'enemy_avatar' => $ui['avatar'],
                'enemy_icon' => $ui['icon'],
                'enemy_ship_type' => $encounter->enemy_ship_type,
                'score' => $score,
                'score_label' => sprintf('%+d', $score),
                'band_label' => $band['label'],
                'bar_percent' => (int) round((($score + 100) / 200) * 100),
                'status' => $encounter->status,
                'status_label' => $statusLabel,
                'turns_remaining' => (int) ($encounter->turns_remaining ?? 0),
                'can_contact' => $encounter->status === 'contact',
                'can_war' => in_array($encounter->status, ['contact', 'battle'], true),
            ];
        }

        return $rows;
    }

    private function playerHasFleetInSystem(Player $player, int $systemId): bool
    {
        return Fleet::where('player_id', $player->id)
            ->where('star_system_id', $systemId)
            ->exists();
    }

    private function createEncounterIfNeeded(GameSession $session, Player $player, int $systemId): ?SystemEncounter
    {
        $existing = SystemEncounter::where('game_session_id', $session->id)
            ->where('player_id', $player->id)
            ->where('star_system_id', $systemId)
            ->where('status', '!=', 'resolved')
            ->first();

        if ($existing) {
            return $existing;
        }

        $system = StarSystem::find($systemId);
        $enemies = $session->players()->where('id', '!=', $player->id)->orderBy('id')->get();
        if ($enemies->isEmpty()) {
            if ($system) {
                \App\Models\GameEvent::create([
                    'game_session_id' => $session->id,
                    'title' => 'System explored',
                    'message' => $system->name . ' appears to be empty. No hostile contact was detected.',
                ]);
            }

            return null;
        }

        $encounterRoll = random_int(1, 100);
        if ($encounterRoll > 60) {
            if ($system) {
                \App\Models\GameEvent::create([
                    'game_session_id' => $session->id,
                    'title' => 'System explored',
                    'message' => $system->name . ' appears to be empty. No hostile contact was detected.',
                ]);
            }

            return null;
        }

        $enemy = $enemies->shuffle()->first();
        if (!$enemy) {
            return null;
        }

        $encounter = SystemEncounter::create([
            'game_session_id' => $session->id,
            'player_id' => $player->id,
            'star_system_id' => $systemId,
            'enemy_player_id' => $enemy->id,
            'enemy_ship_type' => collect(['heavy', 'medium', 'litle'])->random(),
            'status' => 'contact',
            'turns_remaining' => null,
            'outcome' => null,
        ]);

        if ($system) {
            $ui = $this->raceUi($enemy->race_key);
            \App\Models\GameEvent::create([
                'game_session_id' => $session->id,
                'title' => 'Hostile contact',
                'message' => 'A ' . ucfirst($encounter->enemy_ship_type) . ' enemy ship from ' . $ui['empire_name'] . ' was detected in ' . $system->name . '.',
            ]);
        }

        $this->relationForPlayers($session, $player, $enemy);

        return $encounter;
    }

    public function galaxy(GameSession $session)
    {
        $player = $this->currentPlayerOrFail($session);
        $this->ensureFleetRoster($player);

        $events = $session->events()->orderByDesc('id')->limit(1)->get();
        $lastEvent = $events->first();
        $researchTree = config('game.tech');
        $unlocked = $player->technologies()->pluck('tech_key')->all();
        $diplomacyRows = $this->buildDiplomacyRows($session, $player);
        $activeEncounters = $this->buildEncounterSummaries($session, $player);
        $playerRaceUi = $this->raceUi($player->race_key);

        return view('game.galaxy', compact(
            'session',
            'player',
            'lastEvent',
            'researchTree',
            'unlocked',
            'diplomacyRows',
            'activeEncounters',
            'playerRaceUi'
        ));
    }
    public function moveFleet(Request $request)
    {

        $fleet = Fleet::findOrFail($request->fleet_id);

        $fleet->target_system_id = $request->system_id;

        // ajunge peste 1 turn
        $fleet->arrives_in_turn = 1;

        $fleet->save();

        return response()->json([
            'status' => 'moving'
        ]);
    }

    public function system(GameSession $session, StarSystem $system)
    {
        $player = $this->currentPlayerOrFail($session);
        $this->ensureFleetRoster($player);

        if ((int) $system->galaxy_id !== (int) $session->galaxy_id) {
            abort(404);
        }

        $vis = \App\Models\SystemVisibility::where('player_id', $player->id)
            ->where('star_system_id', $system->id)
            ->first();
        $visStatus = $vis ? $vis->status : 'unknown';



        $systemOwner = $system->owner_player_id ? Player::find($system->owner_player_id) : null;
        $systemOwnerRaceKey = $systemOwner?->race_key;

        $planets = Planet::where('star_system_id', $system->id)
            ->orderByDesc('is_capital')
            ->orderBy('orbit_radius')
            ->get();

        if ($player->home_star_system_id && (int) $player->home_star_system_id === (int) $system->id) {
            app(PlanetFactoryService::class)->ensureCapitalFactories($session, $player, $system);
        }

        foreach ($planets as $planet) {
            $planet->factory_status = app(PlanetFactoryService::class)->factoryStatusForPlanet($session, $player, $planet);
            $planet->ui_yields = in_array($visStatus, ['discovered', 'surveyed'], true)
                ? $this->calculatePlanetYields($session, $player, $planet)
                : [];
        }

        $fleets = Fleet::where('player_id', $player->id)
            ->where('star_system_id', $system->id)
            ->orderBy('id')
            ->get();

        foreach ($fleets->values() as $index => $fleet) {
            $fleet->ship_variant = $this->fleetVariant($fleet, $index);
        }

        $neighborLaneRows = \DB::table('hyperlanes')
            ->where('galaxy_id', $session->galaxy_id)
            ->where(function ($q) use ($system) {
                $q->where('from_star_system_id', $system->id)
                    ->orWhere('to_star_system_id', $system->id);
            })
            ->get();

        $neighborIds = [];
        foreach ($neighborLaneRows as $row) {
            $neighborIds[] = ((int) $row->from_star_system_id === (int) $system->id)
                ? (int) $row->to_star_system_id
                : (int) $row->from_star_system_id;
        }

        $neighbors = StarSystem::whereIn('id', array_values(array_unique($neighborIds)))
            ->get()
            ->sortBy(function ($neighbor) use ($system) {
                $dx = (float) $neighbor->x - (float) $system->x;
                $dy = (float) $neighbor->y - (float) $system->y;
                $dz = (float) $neighbor->z - (float) $system->z;

                return ($dx * $dx) + ($dy * $dy) + ($dz * $dz);
            })
            ->take(4)
            ->values();

        $researchTree = config('game.tech');
        $unlocked = $player->technologies()->pluck('tech_key')->all();
        $diplomacyRows = $this->buildDiplomacyRows($session, $player);
        $activeEncounters = $this->buildEncounterSummaries($session, $player);
        $currentEncounter = collect($activeEncounters)->firstWhere('system_id', $system->id);
        $playerRaceUi = $this->raceUi($player->race_key);

        return view('game.system', compact(
            'session',
            'player',
            'system',
            'planets',
            'fleets',
            'visStatus',
            'researchTree',
            'unlocked',
            'neighbors',
            'systemOwnerRaceKey',
            'diplomacyRows',
            'activeEncounters',
            'currentEncounter',
            'playerRaceUi'
        ));
    }

    public function endTurn(Request $request, GameSession $session, GameTurnService $turnService)
    {
        $player = $this->currentPlayerOrFail($session);
        $turnService->endHumanTurnFullRound($session, $player);

        $returnTo = (string) $request->input('return_to', '');

        if ($returnTo !== '') {
            return redirect()->to($returnTo);
        }

        return back();
    }

    public function selectResearch(Request $request, GameSession $session)
    {
        $player = $this->currentPlayerOrFail($session);

        $key = (string) $request->input('tech_key', '');
        if (!$key) {
            return back();
        }

        if ($player->technologies()->where('tech_key', $key)->exists()) {
            return back();
        }

        $player->current_research_key = $key;
        $player->research_progress = 0;
        $player->save();

        return back();
    }

    public function build(Request $request, GameSession $session, Planet $planet)
    {
        $player = $this->currentPlayerOrFail($session);

        $system = $planet->system;
        if ((int) $system->galaxy_id !== (int) $session->galaxy_id) {
            abort(404);
        }

        $factoryService = app(PlanetFactoryService::class);
        $factoryStatus = $factoryService->factoryStatusForPlanet($session, $player, $planet);
        $key = (string) $request->input('building_key', ($factoryStatus['allowed_key'] ?? ''));

        if (!$factoryService->isFactoryBuildingKey($key)) {
            return back()->with('error', 'Only factory buildings are available on planets.');
        }

        if (($factoryStatus['allowed_key'] ?? null) !== $key) {
            return back()->with('error', 'This factory is not allowed on this planet type.');
        }

        if (!($factoryStatus['can_build'] ?? false)) {
            return back()->with('error', $factoryStatus['reason'] ?? 'Factory construction is not available right now.');
        }

        $factoryDefs = config('game.factory_buildings');
        $cost = (int) ($factoryDefs[$key]['cost']['minerals'] ?? 0);
        if ($player->minerals < $cost) {
            return back()->with('error', 'Not enough minerals.');
        }

        $slot = $factoryService->firstFreeSlot($planet);
        if ($slot === null) {
            return back()->with('error', 'No free building slot is available on this planet.');
        }

        PlanetBuilding::create([
            'planet_id' => $planet->id,
            'player_id' => $player->id,
            'slot_index' => $slot,
            'building_key' => $key,
        ]);

        $player->minerals -= $cost;
        $player->save();

        return back()->with('status', 'Factory constructed successfully.');
    }

    public function orderFleetSurvey(Request $request, GameSession $session, Fleet $fleet)
    {
        $player = $this->currentPlayerOrFail($session);
        if ((int) $fleet->player_id !== (int) $player->id) {
            abort(403);
        }

        $hasEncounter = SystemEncounter::where('game_session_id', $session->id)
            ->where('player_id', $player->id)
            ->where('star_system_id', $fleet->star_system_id)
            ->where('status', '!=', 'resolved')
            ->exists();

        if ($hasEncounter) {
            return back()->with('error', 'Resolve the hostile contact before surveying this system.');
        }

        $fleet->mission = 'survey';
        $fleet->target_star_system_id = null;
        $fleet->mission_progress = 0;
        $fleet->save();



        return back()->with('status', 'Fleet ordered to survey this system.');
    }

    public function orderFleetMove(Request $request, GameSession $session, Fleet $fleet)
    {
        $player = $this->currentPlayerOrFail($session);
        if ((int) $fleet->player_id !== (int) $player->id) {
            abort(403);
        }

        $target = (int) $request->input('target_star_system_id', 0);
        if ($target <= 0) {
            return back()->with('error', 'Choose a target system.');
        }

        if ((int) $fleet->star_system_id === $target) {
            return back();
        }

        $isNeighbor = \DB::table('hyperlanes')
            ->where('galaxy_id', $session->galaxy_id)
            ->where(function ($q) use ($fleet, $target) {
                $q->where(function ($q2) use ($fleet, $target) {
                    $q2->where('from_star_system_id', $fleet->star_system_id)
                        ->where('to_star_system_id', $target);
                })->orWhere(function ($q2) use ($fleet, $target) {
                    $q2->where('from_star_system_id', $target)
                        ->where('to_star_system_id', $fleet->star_system_id);
                });
            })
            ->exists();

        if (!$isNeighbor) {
            return back()->with('error', 'Target system is not adjacent.');
        }

        $existingTargetVisibility = \App\Models\SystemVisibility::where('player_id', $player->id)
            ->where('star_system_id', $target)
            ->first();
        $wasUnknown = !$existingTargetVisibility || $existingTargetVisibility->status === 'unknown';

        $oldSystemId = $fleet->star_system_id;

        $fleet->star_system_id = $target;
        $fleet->planet_id = $this->defaultPlanetIdInSystem($target);
        $fleet->mission = 'idle';
        $fleet->target_star_system_id = null;
        $fleet->mission_progress = 0;
        $fleet->save();

        if ($player->home_star_system_id && (int)$player->home_star_system_id === (int)$oldSystemId) {
            app(PlanetFactoryService::class)->setVisibilityForPlayer($player, $oldSystemId, 'surveyed', (int) $session->turn);
        }

        app(PlanetFactoryService::class)->setVisibilityForPlayer($player, $target, 'discovered', (int) $session->turn);

        $moveStatus = null;
        if ($wasUnknown) {
            $encounter = $this->createEncounterIfNeeded($session, $player, $target);
            $moveStatus = $encounter
                ? 'Hostile contact detected. The WAR panel is now active in this system.'
                : 'System scanned. No hostile ships were detected.';
        }

        return redirect()->route('game.system', [
            'session' => $session->id,
            'system' => $target,
        ])->with('status', $moveStatus ?? 'Fleet arrived in the target system.');
    }
    public function moveFleetToPlanet(Request $request, GameSession $session, Fleet $fleet)
    {
        $player = $this->currentPlayerOrFail($session);

        if ((int) $fleet->player_id !== (int) $player->id) {
            abort(403);
        }

        $targetPlanetId = (int) $request->input('target_planet_id', 0);

        if ($targetPlanetId <= 0) {
            return back()->with('error', 'Choose a target planet.');
        }

        $planet = Planet::where('id', $targetPlanetId)
            ->where('star_system_id', $fleet->star_system_id)
            ->first();

        if (!$planet) {
            return back()->with('error', 'Target planet is not in the same system.');
        }

        $fleet->planet_id = $planet->id;
        $fleet->mission = 'idle';
        $fleet->target_star_system_id = null;
        $fleet->mission_progress = 0;
        $fleet->save();

        return redirect()->route('game.system', [
            'session' => $session->id,
            'system' => $fleet->star_system_id,
        ])->with('status', 'Fleet moved to ' . $planet->name . '.');
    }
    public function claimSystem(Request $request, GameSession $session, StarSystem $system)
    {
        $player = $this->currentPlayerOrFail($session);

        if ((int) $system->galaxy_id !== (int) $session->galaxy_id) {
            abort(404);
        }

        $hasEncounter = SystemEncounter::where('game_session_id', $session->id)
            ->where('player_id', $player->id)
            ->where('star_system_id', $system->id)
            ->where('status', '!=', 'resolved')
            ->exists();
        if ($hasEncounter) {
            return back()->with('error', 'Resolve the hostile contact before claiming this system.');
        }

        if ($system->owner_player_id) {
            return back()->with('error', 'Already claimed.');
        }

        if ($system->claim_player_id && (int) $system->claim_player_id !== (int) $player->id) {
            return back()->with('error', 'Another empire is already claiming this system.');
        }

        $vis = \App\Models\SystemVisibility::where('player_id', $player->id)
            ->where('star_system_id', $system->id)
            ->first();

        if (!$vis || !in_array($vis->status, ['discovered', 'surveyed'], true)) {
            return back()->with('error', 'System must be discovered first.');
        }

        if (!$this->playerHasFleetInSystem($player, $system->id)) {
            return back()->with('error', 'Move one of your ships into this system before starting the claim.');
        }

        if ((int) ($system->claim_player_id ?? 0) === (int) $player->id) {
            return back()->with('status', 'Claim already in progress: ' . $system->claim_progress . '/' . $system->claim_required_turns);
        }

        $cost = 10;
        if ($player->influence < $cost) {
            return back()->with('error', 'Not enough influence.');
        }

        $player->influence -= $cost;
        $player->save();

        $system->claim_player_id = $player->id;
        $system->claim_progress = 0;
        $system->claim_required_turns = 5;
        $system->save();

        return back()->with('status', 'Claim started. Complete 5 End Turns to secure this system.');
    }

    public function diplomacyContact(Request $request, GameSession $session, Player $other)
    {
        $player = $this->currentPlayerOrFail($session);
        if ((int) $other->game_session_id !== (int) $session->id) {
            abort(404);
        }

        $relation = $this->relationForPlayers($session, $player, $other);
        $relation->status = 'neutral';
        $relation->save();

        return back();
    }

    public function diplomacyWar(Request $request, GameSession $session, Player $other)
    {
        $player = $this->currentPlayerOrFail($session);
        if ((int) $other->game_session_id !== (int) $session->id) {
            abort(404);
        }

        $relation = $this->relationForPlayers($session, $player, $other);
        $relation->status = 'war';
        $relation->save();

        return back();
    }

    public function diplomacyPeace(Request $request, GameSession $session, Player $other)
    {
        $player = $this->currentPlayerOrFail($session);
        if ((int) $other->game_session_id !== (int) $session->id) {
            abort(404);
        }

        $relation = $this->relationForPlayers($session, $player, $other);
        $relation->status = 'neutral';
        $relation->save();

        return back();
    }

    public function encounterPeace(Request $request, GameSession $session, SystemEncounter $encounter)
    {
        $player = $this->currentPlayerOrFail($session);
        if ((int) $encounter->game_session_id !== (int) $session->id || (int) $encounter->player_id !== (int) $player->id) {
            abort(404);
        }

        if ($encounter->status === 'resolved') {
            return back();
        }

        $enemy = Player::findOrFail($encounter->enemy_player_id);
        $this->applyDiplomacyDelta($session, $player, $enemy, 20);

        $encounter->status = 'retreat';
        $encounter->turns_remaining = 1;
        $encounter->outcome = 'peace';
        $encounter->save();

        return back()->with('status', 'The enemy fleet accepted a tense peace and will retreat next turn.');
    }

    public function encounterWar(Request $request, GameSession $session, SystemEncounter $encounter)
    {
        $player = $this->currentPlayerOrFail($session);
        if ((int) $encounter->game_session_id !== (int) $session->id || (int) $encounter->player_id !== (int) $player->id) {
            abort(404);
        }

        if ($encounter->status === 'resolved') {
            return back();
        }

        $encounter->status = 'battle';
        $encounter->turns_remaining = 2;
        $encounter->outcome = 'war';
        $encounter->save();

        return back()->with('status', 'Battle engagement started. Resolution expected in 2 turns.');
    }
}
