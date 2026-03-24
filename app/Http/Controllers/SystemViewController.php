<?php

namespace App\Http\Controllers;

use App\Models\StarSystem;
use App\Models\Hyperlane;

class SystemViewController extends Controller
{
    public function show(StarSystem $starSystem)
    {
        $starSystem->load(['galaxy', 'planets']);

        $galaxy = $starSystem->galaxy;

        
        $lanes = Hyperlane::query()
            ->where('galaxy_id', $galaxy->id)
            ->where(function($q) use ($starSystem) {
                $q->where('from_star_system_id', $starSystem->id)
                  ->orWhere('to_star_system_id', $starSystem->id);
            })
            ->get();

        $neighborIds = $lanes->flatMap(function($l) use ($starSystem) {
            return [
                $l->from_star_system_id == $starSystem->id ? $l->to_star_system_id : $l->from_star_system_id,
            ];
        })->unique()->values()->all();

        $neighbors = StarSystem::query()
            ->whereIn('id', $neighborIds)
            ->orderBy('id')
            ->get();

        $payload = [
            'star' => [
                'id' => $starSystem->id,
                'name' => $starSystem->name,
                'position' => [(float)$starSystem->x, (float)$starSystem->y, (float)$starSystem->z],
                'color' => $starSystem->color_hex,
                'temperature' => (int)$starSystem->temperature,
            ],
            'galaxy' => [
                'id' => $galaxy->id,
                'name' => $galaxy->name,
            ],
            'neighbors' => $neighbors->map(fn($s) => [
                'id' => $s->id,
                'name' => $s->name,
                'position' => [(float)$s->x, (float)$s->y, (float)$s->z],
                'color' => $s->color_hex,
            ])->values(),
            'planets' => $starSystem->planets->sortBy('orbit_radius')->map(fn($p) => [
                'id' => $p->id,
                'name' => $p->name,
                'type' => $p->type,
                'orbit_radius' => (float)$p->orbit_radius,
                'radius' => (float)$p->radius,
                'rotation_speed' => (float)$p->rotation_speed,
                'has_rings' => (bool)$p->has_rings,
                'meta' => $p->meta_json ?? [],
            ])->values(),
        ];

        return view('game.system', [
            'starSystem' => $starSystem,
            'payload' => $payload,
        ]);
    }
}
