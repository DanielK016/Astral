<?php

namespace App\Services;

use App\Models\Galaxy;
use App\Models\StarSystem;
use App\Models\Planet;
use App\Models\Hyperlane;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class GalaxyGenerator
{
    /**
     * 
     *
     * @return array{galaxy:Galaxy, homeSystem:StarSystem}
     */
    public function generate(Galaxy $galaxy, int $seed, int $size, int $arms = 4): array
    {
        $size = max(50, min(1200, $size));
        $arms = max(2, min(8, $arms));

        $galaxy->seed = $seed;
        $galaxy->size = $size;
        $galaxy->arms = $arms;
        $galaxy->save();

        mt_srand($seed);

        return DB::transaction(function () use ($galaxy, $size, $arms) {

            $systems = $this->generateSystems($galaxy, $size, $arms);

            $this->generateHyperlanes($galaxy, $systems);


            $this->generatePlanetsForAllSystems($systems);

   
            $home = $systems->sortBy(fn($s) => $s->x*$s->x + $s->y*$s->y + $s->z*$s->z)->first();

            return ['galaxy' => $galaxy, 'homeSystem' => $home];
        });
    }

    private function rf(float $min = 0.0, float $max = 1.0): float
    {
        return $min + (mt_rand() / mt_getrandmax()) * ($max - $min);
    }

    private function pickStarName(int $i): string
    {
        $base = [
            "Sirius","Vega","Altair","Rigel","Deneb","Spica","Capella","Arcturus","Antares","Procyon",
            "Bellatrix","Aldebaran","Regulus","Fomalhaut","Mimosa","Castor","Pollux","Alnitak","Saiph","Merak",
            "Hadar","Wezen","Alphard","Markab","Algol","Mira","Nashira","Zuben","Caph","Zaniah"
        ];
        $n = $base[array_rand($base)];
        return $n.'-'.(100 + ($i % 900));
    }

    private function starColorByTemperature(int $t): string
    {
        if ($t > 12000) return '#8fb6ff'; 
        if ($t > 8000)  return '#b7ccff';
        if ($t > 5200)  return '#ffd8a8';
        return '#ffb36b'; 
    }

    /**
     * @return \Illuminate\Support\Collection<int, StarSystem>
     */
    private function generateSystems(Galaxy $galaxy, int $count, int $arms)
    {
        $coreRadius = 55.0;
        $armLength  = 520.0;
        $systems = collect();
        $placed = [];
        $minDistance = max(30.0, min(56.0, 900.0 / max(1.0, sqrt((float) $count))));

        for ($i=0; $i<$count; $i++) {
            $bestCandidate = null;
            $bestScore = -INF;

            for ($attempt = 0; $attempt < 50; $attempt++) {
                $typeRand = $this->rf(0,1);
                if ($typeRand < 0.18) {
                    $r = pow($this->rf(0,1), 1.35) * $coreRadius * 2.4;
                    $angle = $this->rf(0, 2*pi());
                } elseif ($typeRand < 0.9) {
                    $armIndex = (int) floor($this->rf(0,$arms));
                    $baseAngle = ($armIndex / $arms) * 2*pi();
                    $progress = pow($this->rf(0,1), 1.25);
                    $r = $coreRadius + $progress * $armLength;
                    $spiralAngle = $progress * pi() * 8.2;
                    $angle = $baseAngle + $spiralAngle + ($this->rf(0,1)-0.5) * 0.75;
                } else {
                    $r = $coreRadius + $this->rf(0,1) * $armLength * 1.45;
                    $angle = $this->rf(0, 2*pi());
                }

                $x = cos($angle) * $r;
                $z = sin($angle) * $r;

                $nearest = INF;
                foreach ($placed as [$px, $pz]) {
                    $dx = $x - $px;
                    $dz = $z - $pz;
                    $d = sqrt($dx*$dx + $dz*$dz);
                    if ($d < $nearest) $nearest = $d;
                    if ($nearest < $minDistance) break;
                }

                if ($nearest > $bestScore) {
                    $bestScore = $nearest;
                    $bestCandidate = [$x, $z];
                }

                if ($nearest >= $minDistance || empty($placed)) {
                    $bestCandidate = [$x, $z];
                    break;
                }
            }

            [$x, $z] = $bestCandidate;
            $placed[] = [$x, $z];
            $y = 0.0;

            $temperature = (int) round(3200 + $this->rf(0,1)*18000);
            $color = $this->starColorByTemperature($temperature);
            $baseScale = 0.55 + $this->rf(0,1)*1.05;

            $systems->push(StarSystem::query()->create([
                'galaxy_id' => $galaxy->id,
                'name' => $this->pickStarName($i),
                'x' => $x,
                'y' => $y,
                'z' => $z,
                'color_hex' => $color,
                'temperature' => $temperature,
                'base_scale' => $baseScale,
            ]));
        }

        return $systems;
    }

    private function generateHyperlanes(Galaxy $galaxy, $systems): void
    {
        $maxDegree = 4;
        $maxDist = 190.0;
        $softMaxDist = 240.0;
        $targetAverageDegree = 3.1;

        $n = $systems->count();
        if ($n <= 1) {
            return;
        }

        $positions = [];
        foreach ($systems as $s) {
            $positions[] = [$s->x, $s->y, $s->z];
        }

        $edges = [];
        for ($i = 0; $i < $n; $i++) {
            for ($j = $i + 1; $j < $n; $j++) {
                $dx = $positions[$i][0] - $positions[$j][0];
                $dy = $positions[$i][1] - $positions[$j][1];
                $dz = $positions[$i][2] - $positions[$j][2];
                $d = sqrt($dx * $dx + $dy * $dy + $dz * $dz);
                $edges[] = ['a' => $i, 'b' => $j, 'd' => $d];
            }
        }

        usort($edges, fn ($left, $right) => $left['d'] <=> $right['d']);

        $parent = range(0, $n - 1);
        $degree = array_fill(0, $n, 0);
        $selected = [];
        $selectedKeys = [];

        $find = function (int $node) use (&$parent, &$find): int {
            if ($parent[$node] !== $node) {
                $parent[$node] = $find($parent[$node]);
            }

            return $parent[$node];
        };

        $union = function (int $a, int $b) use (&$parent, $find): void {
            $ra = $find($a);
            $rb = $find($b);
            if ($ra !== $rb) {
                $parent[$rb] = $ra;
            }
        };

        $addEdge = function (array $edge) use (&$degree, &$selected, &$selectedKeys, $galaxy, $systems): void {
            $a = min($edge['a'], $edge['b']);
            $b = max($edge['a'], $edge['b']);
            $key = $a . '-' . $b;
            if (isset($selectedKeys[$key])) {
                return;
            }

            $selectedKeys[$key] = true;
            $degree[$a]++;
            $degree[$b]++;
            $selected[] = $edge;

            Hyperlane::query()->create([
                'galaxy_id' => $galaxy->id,
                'from_star_system_id' => $systems[$a]->id,
                'to_star_system_id' => $systems[$b]->id,
            ]);
        };

        foreach ($edges as $edge) {
            if ($edge['d'] > $softMaxDist) {
                break;
            }

            $a = $edge['a'];
            $b = $edge['b'];
            if ($find($a) === $find($b)) {
                continue;
            }
            if ($degree[$a] >= $maxDegree || $degree[$b] >= $maxDegree) {
                continue;
            }

            $addEdge($edge);
            $union($a, $b);
        }

        $components = [];
        for ($i = 0; $i < $n; $i++) {
            $components[$find($i)][] = $i;
        }

        while (count($components) > 1) {
            $bridge = null;

            foreach ($edges as $edge) {
                $a = $edge['a'];
                $b = $edge['b'];
                if ($find($a) === $find($b)) {
                    continue;
                }
                if ($degree[$a] >= $maxDegree || $degree[$b] >= $maxDegree) {
                    continue;
                }

                $bridge = $edge;
                break;
            }

            if (!$bridge) {
                break;
            }

            $addEdge($bridge);
            $union($bridge['a'], $bridge['b']);

            $components = [];
            for ($i = 0; $i < $n; $i++) {
                $components[$find($i)][] = $i;
            }
        }

        foreach ($edges as $edge) {
            $a = $edge['a'];
            $b = $edge['b'];
            $key = min($a, $b) . '-' . max($a, $b);

            if (isset($selectedKeys[$key])) {
                continue;
            }
            if ($edge['d'] > $maxDist) {
                continue;
            }
            if ($degree[$a] >= $maxDegree || $degree[$b] >= $maxDegree) {
                continue;
            }

            $currentAverageDegree = array_sum($degree) / max(1, $n);
            if ($currentAverageDegree >= $targetAverageDegree && $degree[$a] >= 2 && $degree[$b] >= 2) {
                continue;
            }

            $addEdge($edge);
        }
    }

    private function generatePlanetsForAllSystems($systems): void
    {
        foreach ($systems as $sys) {
            $count = 4 + (int) floor($this->rf(0,1) * 6); // 4..9
            $baseOrbit = 7.5;
            $step = 4.2;

            for ($i=0; $i<$count; $i++) {
                $orbitR = $baseOrbit + $i*$step + ($this->rf(0,1)-0.5)*0.35;
                $type = $this->pickPlanetType($i);
                $isGas = $type === 'gas';
                $radius = $isGas ? (1.35 + $this->rf(0,1)*1.35) : (0.55 + $this->rf(0,1)*0.55);

                $hasRings = $isGas && ($this->rf(0,1) > 0.55);

                Planet::query()->create([
                    'star_system_id' => $sys->id,
                    'name' => $this->pickPlanetName($i),
                    'type' => $type,
                    'orbit_radius' => $orbitR,
                    'radius' => $radius,
                    'axial_tilt' => ($this->rf(0,1)-0.5) * 0.6,
                    'rotation_speed' => 0.002 + $this->rf(0,1)*0.01,
                    'has_rings' => $hasRings,
                    'meta_json' => [
                        'generated' => true,
                    ],
                ]);
            }
        }
    }

    private function pickPlanetType(int $i): string
    {
        $r = $this->rf(0,1);

        if ($i === 0 && $r < 0.60) return 'terran';

        if ($r < 0.18) return 'ice';
        if ($r < 0.40) return 'desert';
        if ($r < 0.58) return 'terran';
        if ($r < 0.75) return 'gas';
        if ($r < 0.88) return 'volcanic';
        return 'biolum';
    }

    private function pickPlanetName(int $i): string
    {
        $pool = ["Mercury","Venus","Terra","Mars","Juno","Ceres","Pallas","Vesta","Io","Europa","Ganymede","Callisto","Titan","Enceladus","Triton","Nyx","Aether","Ignis","Arcadia","Glacies"];
        $name = $pool[($i + array_rand($pool)) % count($pool)];
        if ($this->rf(0,1) > 0.75) $name .= ' '.($i+1);
        return $name;
    }
}
