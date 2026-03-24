<?php

namespace App\Http\Controllers;

use App\Models\Galaxy;
use Illuminate\Http\Request;

class GalaxyMapController extends Controller
{
    public function show(Request $request, Galaxy $galaxy)
    {
        $systems = $galaxy->starSystems()->orderBy('id')->get();
        $lanes = $galaxy->hyperlanes()->get();

        $stars = $systems->map(fn($s) => [
            'id' => $s->id,
            'name' => $s->name,
            'position' => [(float)$s->x, (float)$s->y, (float)$s->z],
            'color' => $s->color_hex,
            'temperature' => (int)$s->temperature,
            'baseScale' => (float)$s->base_scale,
        ])->values();

        $links = $lanes->map(fn($l) => [
            'a' => (int)$l->from_star_system_id,
            'b' => (int)$l->to_star_system_id,
        ])->values();

        $payload = [
            'version' => 1,
            'seed' => (int)($galaxy->seed ?? 1),
            'stars' => $stars,
            'links' => $links,
        ];

        $focusId = $request->query('focusId');

        return view('game.galaxy-map', [
            'galaxy' => $galaxy,
            'payload' => $payload,
            'focusId' => $focusId,
        ]);
    }
}
