<?php

namespace App\Services;

use App\Models\Fleet;
use App\Models\GameSession;
use App\Models\Planet;
use App\Models\PlanetBuilding;
use App\Models\Player;
use App\Models\StarSystem;
use App\Models\SystemVisibility;

class PlanetFactoryService
{
    public function factoryDefinitions(): array
    {
        return config('game.factory_buildings', []);
    }

    public function factoryKeys(): array
    {
        return array_keys($this->factoryDefinitions());
    }

    public function isFactoryBuildingKey(?string $buildingKey): bool
    {
        return is_string($buildingKey) && array_key_exists($buildingKey, $this->factoryDefinitions());
    }

    public function normalizePlanetType(?string $type): string
    {
        $type = mb_strtolower((string) $type);

        return match ($type) {
            'vulcan', 'vulcanic' => 'volcanic',
            default => $type,
        };
    }

    public function allowedFactoryKeyForPlanetType(?string $planetType): ?string
    {
        $planetType = $this->normalizePlanetType($planetType);

        foreach ($this->factoryDefinitions() as $key => $def) {
            $allowedTypes = array_map(fn ($value) => $this->normalizePlanetType((string) $value), $def['planet_types'] ?? []);
            if (in_array($planetType, $allowedTypes, true)) {
                return $key;
            }
        }

        return null;
    }

    public function buildOptionsForPlanet(Planet $planet): array
    {
        $key = $this->allowedFactoryKeyForPlanetType($planet->type);
        if (!$key) {
            return [];
        }

        $defs = $this->factoryDefinitions();

        return isset($defs[$key]) ? [$key => $defs[$key]] : [];
    }

    public function resourceSkeleton(): array
    {
        return [
            'energy' => 0,
            'minerals' => 0,
            'science' => 0,
            'rare_metals' => 0,
            'exotic_gases' => 0,
            'xenocultures' => 0,
            'influence' => 0,
            'unity' => 0,
        ];
    }

    public function isCapitalSystemForPlayer(Player $player, StarSystem $system): bool
    {
        return (int) ($player->home_star_system_id ?? 0) === (int) $system->id
            && Planet::where('star_system_id', $system->id)->where('is_capital', 1)->exists();
    }

    public function turnsUntilFactoriesUnlock(GameSession $session, Player $player, StarSystem $system): int
    {
        if ($this->isCapitalSystemForPlayer($player, $system)) {
            return 0;
        }

        $visibility = SystemVisibility::where('player_id', $player->id)
            ->where('star_system_id', $system->id)
            ->first();

        if (!$visibility || !in_array((string) $visibility->status, ['discovered', 'surveyed'], true)) {
            return PHP_INT_MAX;
        }

        $discoveredTurn = $visibility->discovered_turn ?? $session->turn;
        $remaining = ((int) $discoveredTurn + 2) - (int) $session->turn;

        return max(0, $remaining);
    }

    public function canConstructFactories(GameSession $session, Player $player, StarSystem $system): bool
    {
        return $this->turnsUntilFactoriesUnlock($session, $player, $system) === 0;
    }

    public function hasPlayerFleetOnPlanet(Player $player, Planet $planet): bool
    {
        return Fleet::where('player_id', $player->id)
            ->where('star_system_id', $planet->star_system_id)
            ->where('planet_id', $planet->id)
            ->exists();
    }

    public function firstFreeSlot(Planet $planet): ?int
    {
        $occupied = PlanetBuilding::where('planet_id', $planet->id)->pluck('slot_index')->all();

        for ($slot = 0; $slot < (int) $planet->size_slots; $slot++) {
            if (!in_array($slot, $occupied, true)) {
                return $slot;
            }
        }

        return null;
    }

    public function factoryOnPlanet(Planet $planet): ?PlanetBuilding
    {
        return PlanetBuilding::where('planet_id', $planet->id)
            ->whereIn('building_key', $this->factoryKeys())
            ->orderBy('id')
            ->first();
    }

    public function factoryForPlayer(Planet $planet, int $playerId): ?PlanetBuilding
    {
        return PlanetBuilding::where('planet_id', $planet->id)
            ->where('player_id', $playerId)
            ->whereIn('building_key', $this->factoryKeys())
            ->orderBy('id')
            ->first();
    }

    public function factoryYieldForBuildingKey(?string $buildingKey): array
    {
        $defs = $this->factoryDefinitions();
        $yield = $defs[(string) $buildingKey]['yield'] ?? [];
        $totals = $this->resourceSkeleton();

        foreach ($yield as $key => $value) {
            if (array_key_exists($key, $totals)) {
                $totals[$key] += (int) $value;
            }
        }

        return $totals;
    }

    public function calculatePlanetYields(GameSession $session, Player $player, Planet $planet): array
    {
        $factory = $this->factoryForPlayer($planet, (int) $player->id);
        if (!$factory) {
            return $this->resourceSkeleton();
        }

        if (!$this->canConstructFactories($session, $player, $planet->system)) {
            return $this->resourceSkeleton();
        }

        return $this->factoryYieldForBuildingKey($factory->building_key);
    }

    public function summarizeSystemResources(GameSession $session, Player $player, int $systemId): array
    {
        $totals = $this->resourceSkeleton();

        $planets = Planet::where('star_system_id', $systemId)->get();
        foreach ($planets as $planet) {
            $planetYields = $this->calculatePlanetYields($session, $player, $planet);
            foreach ($planetYields as $key => $value) {
                $totals[$key] += (int) $value;
            }
        }

        return array_filter($totals, fn ($value) => (int) $value > 0);
    }

    public function computePlayerIncome(GameSession $session, Player $player): array
    {
        $income = $this->resourceSkeleton();
        $income['influence'] = 1;

        $factoryBuildings = PlanetBuilding::where('player_id', $player->id)
            ->whereIn('building_key', $this->factoryKeys())
            ->get();

        foreach ($factoryBuildings as $building) {
            $planet = Planet::find($building->planet_id);
            if (!$planet) {
                continue;
            }

            if (!$this->canConstructFactories($session, $player, $planet->system)) {
                continue;
            }

            foreach ($this->factoryYieldForBuildingKey($building->building_key) as $key => $value) {
                $income[$key] += (int) $value;
            }
        }

        return $income;
    }

    public function ensureCapitalFactories(GameSession $session, Player $player, StarSystem $system): void
    {
        if (!$this->isCapitalSystemForPlayer($player, $system)) {
            return;
        }

        $planets = Planet::where('star_system_id', $system->id)->orderBy('id')->get();
        foreach ($planets as $planet) {
            $factoryKey = $this->allowedFactoryKeyForPlanetType($planet->type);
            if (!$factoryKey) {
                continue;
            }

            if ($this->factoryOnPlanet($planet)) {
                continue;
            }

            $slot = $this->firstFreeSlot($planet);
            if ($slot === null) {
                continue;
            }

            PlanetBuilding::create([
                'planet_id' => $planet->id,
                'player_id' => $player->id,
                'slot_index' => $slot,
                'building_key' => $factoryKey,
            ]);
        }
    }

    public function factoryStatusForPlanet(GameSession $session, Player $player, Planet $planet): array
    {
        $system = $planet->system;
        $factory = $this->factoryForPlayer($planet, (int) $player->id);
        $existingFactory = $this->factoryOnPlanet($planet);
        $allowedFactoryKey = $this->allowedFactoryKeyForPlanetType($planet->type);
        $unlockTurnsRemaining = $this->turnsUntilFactoriesUnlock($session, $player, $system);
        $hasFleet = $this->hasPlayerFleetOnPlanet($player, $planet);

        $canBuild = $allowedFactoryKey !== null
            && !$existingFactory
            && $unlockTurnsRemaining === 0
            && $hasFleet
            && $this->firstFreeSlot($planet) !== null;

        $reason = null;
        if ($allowedFactoryKey === null) {
            $reason = 'This planet type does not support factories.';
        } elseif ($existingFactory) {
            $reason = $factory
                ? 'Factory already built on this planet.'
                : 'Another empire already has a factory on this planet.';
        } elseif ($unlockTurnsRemaining === PHP_INT_MAX) {
            $reason = 'Unknown systems do not allow factory construction.';
        } elseif ($unlockTurnsRemaining > 0) {
            $reason = 'Factory construction unlocks after 2 EndTurn.';
        } elseif (!$hasFleet) {
            $reason = 'A fleet must be stationed on this planet to build the factory.';
        } elseif ($this->firstFreeSlot($planet) === null) {
            $reason = 'No free building slot is available on this planet.';
        }

        return [
            'allowed_key' => $allowedFactoryKey,
            'can_build' => $canBuild,
            'unlock_turns_remaining' => $unlockTurnsRemaining === PHP_INT_MAX ? null : $unlockTurnsRemaining,
            'has_player_fleet' => $hasFleet,
            'current_factory' => $factory ? [
                'id' => (int) $factory->id,
                'key' => (string) $factory->building_key,
                'player_id' => (int) ($factory->player_id ?? 0),
                'slot' => (int) $factory->slot_index,
                'active' => $this->canConstructFactories($session, $player, $system),
                'yield' => $this->factoryYieldForBuildingKey($factory->building_key),
            ] : null,
            'reason' => $reason,
        ];
    }

    public function setVisibilityForPlayer(Player $player, int $systemId, string $status, ?int $turn = null): void
    {
        $order = ['unknown' => 0, 'discovered' => 1, 'surveyed' => 2];

        $existing = SystemVisibility::where('player_id', $player->id)
            ->where('star_system_id', $systemId)
            ->first();

        if (!$existing) {
            SystemVisibility::create([
                'player_id' => $player->id,
                'star_system_id' => $systemId,
                'status' => $status,
                'discovered_turn' => in_array($status, ['discovered', 'surveyed'], true) ? $turn : null,
            ]);
            return;
        }

        if (($order[$status] ?? 0) > ($order[$existing->status] ?? 0)) {
            $existing->status = $status;
        }

        if ($existing->discovered_turn === null && in_array($status, ['discovered', 'surveyed'], true)) {
            $existing->discovered_turn = $turn;
        }

        $existing->save();
    }
}
