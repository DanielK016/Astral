<?php

namespace App\Services;

use App\Models\GameSession;
use App\Models\Player;
use App\Models\StarSystem;
use App\Models\Planet;
use App\Models\PlanetBuilding;
use App\Models\Fleet;
use App\Models\SystemVisibility;
use App\Models\PlayerTechnology;
use App\Models\GameEvent;
use App\Models\DiplomaticRelation;
use App\Models\SystemEncounter;
use Illuminate\Support\Facades\DB;
use App\Services\PlanetFactoryService;

class GameTurnService
{
    public function endHumanTurnFullRound(GameSession $session, Player $human): void
    {
        $session->current_player_id = $human->id;
        $session->save();


        $aiPlayers = $session->players()->where('is_ai', 1)->orderBy('id')->get();
        foreach ($aiPlayers as $ai) {
            $this->aiTakeTurn($session, $ai);
        }


        $this->processEndOfRound($session);

        $session->turn = $session->turn + 1;
        $session->current_player_id = $human->id;
        $session->save();
    }
    public function progressSurvey($system)
    {
        if (!$system->surveying) {
            return;
        }

        $system->survey_progress += 1;

        if ($system->survey_progress >= count($system->planets)) {
            $system->visibility = 'surveyed';
            $system->surveying = false;
        }

        $system->save();
    }

    public function endHumanTurn(GameSession $session, Player $human): void
    {
        if ((int)$session->current_player_id !== (int)$human->id) {
            return;
        }

        $this->advanceToNextPlayer($session);

        $guard = 0;
        while ($session->current_player_id && $session->current_player_id !== $human->id && $guard < 20) {
            $ai = Player::find($session->current_player_id);
            if (!$ai) break;

            if ($ai->is_ai) {
                $this->aiTakeTurn($session, $ai);
            }

            $this->advanceToNextPlayer($session);
            $guard++;
        }
    }
    private function processSystemClaims(GameSession $session): void
    {
        $systems = StarSystem::where('galaxy_id', $session->galaxy_id)
            ->whereNull('owner_player_id')
            ->whereNotNull('claim_player_id')
            ->get();

        foreach ($systems as $system) {
            $player = Player::find($system->claim_player_id);

            if (!$player) {
                $system->claim_player_id = null;
                $system->claim_progress = 0;
                $system->save();
                continue;
            }

            $vis = SystemVisibility::where('player_id', $player->id)
                ->where('star_system_id', $system->id)
                ->first();

            if (!$vis || !in_array($vis->status, ['discovered', 'surveyed'], true)) {
                continue;
            }

            $system->claim_progress = (int)$system->claim_progress + 1;

            if ((int)$system->claim_progress >= (int)$system->claim_required_turns) {
                $system->owner_player_id = $player->id;
                $system->claim_player_id = null;
                $system->claim_progress = 0;
                $system->claim_required_turns = 5;
                $system->save();

                $this->setVis($player, $system->id, 'surveyed');

                GameEvent::create([
                    'game_session_id' => $session->id,
                    'title' => 'System secured',
                    'message' => $player->name . ' secured ' . $system->name . '.',
                ]);

                continue;
            }

            $system->save();
        }
    }
    private function defaultPlanetIdInSystem(int $systemId): ?int
    {
        return Planet::where('star_system_id', $systemId)
            ->orderByDesc('is_capital')
            ->orderBy('orbit_radius')
            ->value('id');
    }
    private function advanceToNextPlayer(GameSession $session): void
    {
        $players = $session->players()->orderBy('id')->get();
        if ($players->isEmpty()) return;

        $currentId = $session->current_player_id;
        $idx = $players->search(fn($p) => (int)$p->id === (int)$currentId);
        if ($idx === false) {
            $session->current_player_id = $players->first()->id;
            $session->save();
            return;
        }

        $nextIdx = $idx + 1;
        if ($nextIdx >= $players->count()) {
            $this->processEndOfRound($session);

            $session->turn = $session->turn + 1;
            $session->current_player_id = $players->first()->id;
            $session->save();
            return;
        }

        $session->current_player_id = $players[$nextIdx]->id;
        $session->save();
    }

    private function processEndOfRound(GameSession $session): void
    {
        DB::transaction(function () use ($session) {
            $players = $session->players()->get();
            foreach ($players as $p) {
                if ($p->home_star_system_id) {
                    $homeSystem = StarSystem::find($p->home_star_system_id);
                    if ($homeSystem) {
                        app(PlanetFactoryService::class)->ensureCapitalFactories($session, $p, $homeSystem);
                    }
                }
            }

            foreach ($players as $p) {
                $income = $this->computeIncome($session, $p);
                $p->energy_income = $income['energy'];
                $p->minerals_income = $income['minerals'];
                $p->science_income = $income['science'];
                $p->rare_metals_income = $income['rare_metals'];
                $p->exotic_gases_income = $income['exotic_gases'];
                $p->xenocultures_income = $income['xenocultures'];
                $p->unity_income = $income['unity'];
                $p->influence_income = $income['influence'];
                $p->save();
            }

            foreach ($players as $p) {
                $this->applyIncomeAndGrowth($p);
            }

            foreach ($players as $p) {
                $this->processResearch($p);
            }

            foreach ($players as $p) {
                $this->processFleetsAndVisibility($session, $p);
            }

            $this->processSystemClaims($session);

            $this->resolveCombats($session);

            $this->processSystemEncounters($session);

            $this->maybeRandomEvent($session);
        });
    }

    private function computeIncome(GameSession $session, Player $p): array
    {
        $income = app(PlanetFactoryService::class)->computePlayerIncome($session, $p);

        $ownedSystems = StarSystem::where('galaxy_id', $session->galaxy_id)
            ->where('owner_player_id', $p->id)
            ->count();

        $income['influence'] = 1 + (int) floor($ownedSystems / 3);

        $passives = $p->passives();
        if (in_array('econ_boost', $passives, true)) {
            $income['energy'] = (int) round($income['energy'] * 1.10);
            $income['minerals'] = (int) round($income['minerals'] * 1.10);
        }
        if (in_array('science_boost', $passives, true)) {
            $income['science'] = (int) round($income['science'] * 1.15);
        }
        if (in_array('unity_boost', $passives, true)) {
            $income['unity'] += 2;
        }
        if (in_array('influence_boost', $passives, true)) {
            $income['influence'] += 1;
        }

        return $income;
    }

    private function applyIncomeAndGrowth(Player $p): void
    {
        $p->energy += $p->energy_income;
        $p->minerals += $p->minerals_income;
        $p->science += $p->science_income;
        $p->rare_metals += $p->rare_metals_income;
        $p->exotic_gases += $p->exotic_gases_income;
        $p->xenocultures += $p->xenocultures_income;
        $p->unity += $p->unity_income;
        $p->influence += $p->influence_income;

        $p->save();

        $homeSysId = $p->home_star_system_id;
        if ($homeSysId) {
            $pl = Planet::where('star_system_id', $homeSysId)->where('is_capital', 1)->first();
            if ($pl) {
                $pl->population += 1;

                if (in_array('growth_boost', $p->passives(), true)) {
                    $pl->happiness = min(0.9, $pl->happiness + 0.01);
                }
                $pl->save();
            }
        }
    }

    private function processResearch(Player $p): void
    {
        if (!$p->current_research_key) return;

        $tech = $this->findTech($p->current_research_key);
        if (!$tech) {
            $p->current_research_key = null;
            $p->research_progress = 0;
            $p->save();
            return;
        }

        $p->research_progress += (int)$p->science_income;

        if ($p->research_progress >= (int)$tech['cost']) {
            PlayerTechnology::firstOrCreate(['player_id' => $p->id, 'tech_key' => $p->current_research_key]);
            $p->current_research_key = null;
            $p->research_progress = 0;
        }

        $p->save();
    }

    private function findTech(string $key): ?array
    {
        $tree = config('game.tech');
        foreach ($tree as $branch => $items) {
            foreach ($items as $t) {
                if (($t['key'] ?? null) === $key) return $t;
            }
        }
        return null;
    }

    private function processFleetsAndVisibility(GameSession $session, Player $p): void
    {
        $galaxyId = $session->galaxy_id;
        if (!$galaxyId) return;

        $fleets = Fleet::where('player_id', $p->id)->get();
        foreach ($fleets as $f) {
            if ($f->mission === 'move' && $f->target_star_system_id) {

                if ($this->isNeighbor($galaxyId, $f->star_system_id, $f->target_star_system_id)) {
                    $f->star_system_id = $f->target_star_system_id;
                    $f->planet_id = $this->defaultPlanetIdInSystem((int) $f->target_star_system_id);
                    $f->mission = 'idle';
                    $f->target_star_system_id = null;
                    $f->mission_progress = 0;
                    $f->save();

                    $this->setVis($p, $f->star_system_id, 'discovered');
                    foreach ($this->neighbors($galaxyId, $f->star_system_id) as $nid) {
                        $this->setVis($p, $nid, 'discovered');
                    }
                } else {
                    $f->mission = 'idle';
                    $f->target_star_system_id = null;
                    $f->save();
                }
            }

            if ($f->mission === 'survey') {
                $f->mission_progress += 1;
                if ($f->mission_progress >= 1) {
                    $this->setVis($p, $f->star_system_id, 'surveyed');
                    $f->mission = 'idle';
                    $f->mission_progress = 0;
                }
                $f->save();
            }
        }
    }

    private function autoClaim(GameSession $session, Player $p): void
    {
        $galaxyId = $session->galaxy_id;
        $owned = StarSystem::where('galaxy_id', $galaxyId)->where('owner_player_id', $p->id)->pluck('id')->all();
        if (!$owned) return;

        $cand = [];
        foreach ($owned as $sid) {
            foreach ($this->neighbors($galaxyId, $sid) as $nid) $cand[$nid] = true;
        }
        $candIds = array_keys($cand);

        $surveyed = SystemVisibility::where('player_id', $p->id)->whereIn('star_system_id', $candIds)->where('status', 'surveyed')->pluck('star_system_id')->all();
        if (!$surveyed) return;

        $cost = 10;
        foreach ($surveyed as $sid) {
            if ($p->influence < $cost) break;

            $sys = StarSystem::where('id', $sid)->whereNull('owner_player_id')->first();
            if (!$sys) continue;

            $sys->owner_player_id = $p->id;
            $sys->save();

            $p->influence -= $cost;
            $p->save();
        }
    }

    private function maybeRandomEvent(GameSession $session): void
    {

        if (random_int(1, 6) !== 1) return;

        $events = [
            ['title' => 'Ancient Ruins', 'message' => 'Your scientists found ancient ruins: +40 Science.', 'apply' => function (Player $p) {
                $p->science += 40;
            }],
            ['title' => 'Population Unrest', 'message' => 'Unrest on a planet: -20 Minerals.', 'apply' => function (Player $p) {
                $p->minerals = max(0, $p->minerals - 20);
            }],
            ['title' => 'Meteor Shower', 'message' => 'Meteor shower damaged infrastructure: -15 Energy.', 'apply' => function (Player $p) {
                $p->energy = max(0, $p->energy - 15);
            }],
            ['title' => 'Pirate Raid', 'message' => 'Pirates stole supplies: -10 Minerals, -10 Energy.', 'apply' => function (Player $p) {
                $p->minerals = max(0, $p->minerals - 10);
                $p->energy = max(0, $p->energy - 10);
            }],
            ['title' => 'Space Storm', 'message' => 'A space storm disrupts hyperlanes (visual only this prototype).', 'apply' => function (Player $p) { /* placeholder */
            }],
        ];

        $pick = $events[array_rand($events)];
        $human = $session->players()->where('is_ai', 0)->first();
        if (!$human) return;

        ($pick['apply'])($human);
        $human->save();

        GameEvent::create([
            'game_session_id' => $session->id,
            'title' => $pick['title'],
            'message' => $pick['message'],
        ]);
    }

    private function aiTakeTurn(GameSession $session, Player $ai): void
    {

        if (!$ai->current_research_key) {
            $choice = $this->pickAiResearch($ai);
            if ($choice) {
                $ai->current_research_key = $choice;
                $ai->research_progress = 0;
                $ai->save();
            }
        }

        $this->aiBuildEconomy($session, $ai);

        $this->aiExplore($session, $ai);
    }

    private function pickAiResearch(Player $ai): ?string
    {
        $tree = config('game.tech');

        $priority = array_merge($tree['strategic'] ?? [], $tree['science'] ?? [], $tree['industry'] ?? [], $tree['military'] ?? []);
        foreach ($priority as $t) {
            $k = $t['key'];
            if ($ai->hasTech($k)) continue;

            $req = $t['requires'] ?? [];
            $ok = true;
            foreach ($req as $r) if (!$ai->hasTech($r)) {
                $ok = false;
                break;
            }
            if ($ok) return $k;
        }
        return null;
    }

    private function aiBuildEconomy(GameSession $session, Player $ai): void
    {
        if (!$ai->home_star_system_id) {
            return;
        }

        $homeSystem = StarSystem::find($ai->home_star_system_id);
        if (!$homeSystem) {
            return;
        }

        app(PlanetFactoryService::class)->ensureCapitalFactories($session, $ai, $homeSystem);
    }

    private function aiExplore(GameSession $session, Player $ai): void
    {
        $galaxyId = $session->galaxy_id;
        if (!$galaxyId) return;

        $scout = $ai->fleets()->orderBy('id')->first();
        if (!$scout) return;

        $vis = SystemVisibility::where('player_id', $ai->id)->where('star_system_id', $scout->star_system_id)->first();
        if (!$vis || $vis->status !== 'surveyed') {
            $scout->mission = 'survey';
            $scout->mission_progress = 0;
            $scout->save();
            return;
        }

        $n = $this->neighbors($galaxyId, $scout->star_system_id);
        $target = null;
        foreach ($n as $nid) {
            $v = SystemVisibility::where('player_id', $ai->id)->where('star_system_id', $nid)->first();
            if ($v && $v->status === 'discovered') {
                $target = $nid;
                break;
            }
        }
        if (!$target && $n) $target = $n[array_rand($n)];

        if ($target) {
            $scout->mission = 'move';
            $scout->target_star_system_id = $target;
            $scout->mission_progress = 0;
            $scout->save();
        }
    }

    private function neighbors(int $galaxyId, int $systemId): array
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

    private function isNeighbor(int $galaxyId, int $a, int $b): bool
    {
        return in_array($b, $this->neighbors($galaxyId, $a), true);
    }

    private function setVis(Player $p, int $systemId, string $status): void
    {
        app(PlanetFactoryService::class)->setVisibilityForPlayer($p, $systemId, $status, (int) ($p->session->turn ?? 1));

        $sys = StarSystem::find($systemId);
        if ($sys && $sys->owner_player_id && (int)$sys->owner_player_id !== (int)$p->id) {
            $this->ensureRelation($p->session, (int)$p->id, (int)$sys->owner_player_id);
        }
    }

    private function ensureRelation(GameSession $session, int $aPlayerId, int $bPlayerId): void
    {
        if ($aPlayerId === $bPlayerId) {
            return;
        }

        [$a, $b] = DiplomaticRelation::key($aPlayerId, $bPlayerId);

        DiplomaticRelation::firstOrCreate(
            [
                'game_session_id' => $session->id,
                'a_player_id' => $a,
                'b_player_id' => $b,
            ],
            [
                'status' => 'unknown',
            ]
        );
    }

    private function clampDiplomacy(int $score): int
    {
        return max(-100, min(100, $score));
    }

    private function adjustEncounterDiplomacy(GameSession $session, Player $player, Player $enemy, int $delta): void
    {
        [$a, $b] = DiplomaticRelation::key($player->id, $enemy->id);

        $relation = DiplomaticRelation::firstOrCreate(
            [
                'game_session_id' => $session->id,
                'a_player_id' => $a,
                'b_player_id' => $b,
            ],
            [
                'status' => 'neutral',
                'score' => 0,
            ]
        );

        $relation->score = $this->clampDiplomacy((int) ($relation->score ?? 0) + $delta);
        if ($relation->status !== 'war') {
            $relation->status = ((int) $relation->score >= 80) ? 'friendly' : 'neutral';
        }
        $relation->save();
    }

    private function rewardForEncounterShip(string $shipType): array
    {
        return match ($shipType) {
            'heavy' => ['energy' => 80, 'minerals' => 70, 'science' => 18, 'rare_metals' => 10],
            'medium' => ['energy' => 55, 'minerals' => 50, 'science' => 12, 'rare_metals' => 6],
            default => ['energy' => 35, 'minerals' => 30, 'science' => 8, 'rare_metals' => 3],
        };
    }

    private function processSystemEncounters(GameSession $session): void
    {
        $encounters = SystemEncounter::with(['player', 'enemyPlayer', 'system'])
            ->where('game_session_id', $session->id)
            ->where('status', '!=', 'resolved')
            ->get();

        foreach ($encounters as $encounter) {
            $player = $encounter->player;
            $enemy = $encounter->enemyPlayer;
            $system = $encounter->system;

            if (!$player || !$enemy || !$system) {
                $encounter->status = 'resolved';
                $encounter->save();
                continue;
            }

            if ($encounter->status === 'retreat') {
                $encounter->turns_remaining = max(0, (int) ($encounter->turns_remaining ?? 1) - 1);
                if ((int) $encounter->turns_remaining <= 0) {
                    $encounter->status = 'resolved';
                    $encounter->save();

                    GameEvent::create([
                        'game_session_id' => $session->id,
                        'title' => 'Fleet retreated',
                        'message' => 'The hostile fleet in ' . $system->name . ' withdrew after diplomatic pressure.',
                    ]);
                    continue;
                }

                $encounter->save();
                continue;
            }

            if ($encounter->status !== 'battle') {
                continue;
            }

            $encounter->turns_remaining = max(0, (int) ($encounter->turns_remaining ?? 2) - 1);
            if ((int) $encounter->turns_remaining > 0) {
                $encounter->save();
                continue;
            }

            $playerWon = random_int(1, 100) <= 80;

            if ($playerWon) {
                $reward = $this->rewardForEncounterShip((string) $encounter->enemy_ship_type);
                $player->energy += (int) $reward['energy'];
                $player->minerals += (int) $reward['minerals'];
                $player->science += (int) $reward['science'];
                $player->rare_metals += (int) $reward['rare_metals'];
                $player->save();

                $this->adjustEncounterDiplomacy($session, $player, $enemy, -20);

                GameEvent::create([
                    'game_session_id' => $session->id,
                    'title' => 'Encounter victory',
                    'message' => $player->name . ' defeated the hostile fleet in ' . $system->name . ' and salvaged new resources.',
                ]);

                $encounter->outcome = 'player_win';
            } else {
                foreach (['energy', 'minerals', 'science', 'rare_metals', 'exotic_gases', 'xenocultures', 'influence', 'unity'] as $resourceKey) {
                    $player->{$resourceKey} = max(0, (int) floor(((int) $player->{$resourceKey}) * 0.9));
                }
                $player->save();

                $this->adjustEncounterDiplomacy($session, $player, $enemy, -10);

                GameEvent::create([
                    'game_session_id' => $session->id,
                    'title' => 'Encounter defeat',
                    'message' => $player->name . ' lost the skirmish in ' . $system->name . ' and suffered resource losses.',
                ]);

                $encounter->outcome = 'player_loss';
            }

            $encounter->status = 'resolved';
            $encounter->turns_remaining = 0;
            $encounter->save();
        }
    }

    private function resolveCombats(GameSession $session): void
    {
        $fleets = Fleet::whereIn('player_id', $session->players()->pluck('id')->all())
            ->orderBy('id')
            ->get()
            ->groupBy('star_system_id');

        foreach ($fleets as $systemId => $systemFleets) {
            $playersInSystem = $systemFleets->groupBy('player_id');
            if ($playersInSystem->count() < 2) {
                continue;
            }

            $relations = DiplomaticRelation::where('game_session_id', $session->id)->get();
            $hasWar = false;
            foreach ($playersInSystem->keys() as $a) {
                foreach ($playersInSystem->keys() as $b) {
                    if ((int)$a >= (int)$b) {
                        continue;
                    }
                    [$ra, $rb] = DiplomaticRelation::key((int)$a, (int)$b);
                    $rel = $relations->first(function ($item) use ($ra, $rb) {
                        return (int)$item->a_player_id === $ra && (int)$item->b_player_id === $rb;
                    });
                    if (($rel->status ?? 'unknown') === 'war') {
                        $hasWar = true;
                        break 2;
                    }
                }
            }

            if (!$hasWar) {
                continue;
            }

            $powerByPlayer = [];
            foreach ($playersInSystem as $playerId => $group) {
                $powerByPlayer[(int)$playerId] = (int)$group->sum('power');
            }
            arsort($powerByPlayer);
            $ordered = array_keys($powerByPlayer);
            if (count($ordered) < 2) {
                continue;
            }

            $winnerId = (int)$ordered[0];
            $winnerPower = max(1, (int)$powerByPlayer[$winnerId]);
            $loserIds = array_slice($ordered, 1);

            foreach ($loserIds as $loserId) {
                $loserFleets = $playersInSystem[$loserId] ?? collect();
                foreach ($loserFleets as $fleet) {
                    $fleet->delete();
                }
            }

            $winnerFleets = $playersInSystem[$winnerId] ?? collect();
            foreach ($winnerFleets as $fleet) {
                $fleet->power = max(1, (int)round($fleet->power * 0.85));
                $fleet->mission = 'idle';
                $fleet->target_star_system_id = null;
                $fleet->mission_progress = 0;
                $fleet->save();
            }

            $winner = Player::find($winnerId);
            $system = StarSystem::find($systemId);
            if ($winner && $system) {
                GameEvent::create([
                    'game_session_id' => $session->id,
                    'title' => 'Battle resolved',
                    'message' => $winner->name . ' won the battle in ' . $system->name . '. Remaining fleet power: ' . $winnerPower . '.',
                ]);
            }
        }
    }
}
