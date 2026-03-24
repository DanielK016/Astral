<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Race;

class RaceSeeder extends Seeder
{
    public function run(): void
    {
        if (Race::query()->count() > 0) {
            return;
        }

        Race::query()->create([
            'name' => 'Люди (Терраны)',
            'description' => 'Сбалансированная стартовая раса.',
            'color_hex' => '#55ddff',
            'traits_json' => ['balanced' => true],
        ]);

        Race::query()->create([
            'name' => 'Синтетики',
            'description' => 'Рациональные машины с холодным расчетом.',
            'color_hex' => '#ffcc55',
            'traits_json' => ['machine' => true],
        ]);

        Race::query()->create([
            'name' => 'Авииды',
            'description' => 'Быстрые и хитрые, любят маневры.',
            'color_hex' => '#88ff88',
            'traits_json' => ['agile' => true],
        ]);
    }
}
