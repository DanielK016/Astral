<?php

return [


    'races' => [
        [
            'key' => 'humans',
            'name' => 'United Terran Federation',
            'image' => 'assets/humanRace.jpg',
            'lore' => 'Diplomacy & sensors. Balanced economy and research.',
            'color' => '#4cc3ff',
        ],
        [
            'key' => 'lorians',
            'name' => 'Lorian Remnant',
            'image' => 'assets/forgottenColony.png',
            'lore' => 'Cybernetic colony. Heavy armor and fast repairs.',
            'color' => '#ffaa55',
        ],
        [
            'key' => 'zeth',
            'name' => 'Zeth Hive',
            'image' => 'assets/ZethRaceRoi.png',
            'lore' => 'Collective hive mind. Rapid growth and swarm tactics.',
            'color' => '#9152f7',
        ],
    ],

    'races_by_key' => [
        'humans' => ['key'=>'humans','name'=>'United Terran Federation','color'=>'#4cc3ff'],
        'lorians' => ['key'=>'lorians','name'=>'Lorian Remnant','color'=>'#ffaa55'],
        'zeth'   => ['key'=>'zeth','name'=>'Zeth Hive','color'=>'#ff7a00'],
    ],

    'passives' => [
        ['key'=>'econ_boost', 'name'=>'Efficient Economy', 'desc'=>'+10% Energy & Minerals income.'],
        ['key'=>'science_boost', 'name'=>'Research Focus', 'desc'=>'+15% Science income.'],
        ['key'=>'unity_boost', 'name'=>'Cultural Cohesion', 'desc'=>'+2 Unity income.'],
        ['key'=>'influence_boost', 'name'=>'Political Leverage', 'desc'=>'+1 Influence income.'],
        ['key'=>'growth_boost', 'name'=>'Population Growth', 'desc'=>'+10% population growth (prototype: +happiness).'],
    ],

    'actives' => [
        ['key'=>'deep_scan', 'name'=>'Deep Scan', 'desc'=>'Instantly discover all adjacent systems (cost: 10 Energy).'],
        ['key'=>'emergency_power', 'name'=>'Emergency Power', 'desc'=>'Gain +30 Energy (cooldown 3 turns).'],
        ['key'=>'war_protocol', 'name'=>'War Protocol', 'desc'=>'+15% combat power for next battle this turn.'],
    ],

    'planet_types' => [
        'terran' => ['yields'=>['energy'=>4,'minerals'=>3,'science'=>3,'unity'=>1]],
        'desert' => ['yields'=>['energy'=>3,'minerals'=>5,'science'=>1,'unity'=>0]],
        'ice'    => ['yields'=>['energy'=>2,'minerals'=>3,'science'=>2,'unity'=>0]],
        'gas'    => ['yields'=>['energy'=>5,'minerals'=>1,'science'=>1,'exotic_gases'=>2]],
        'volcanic' => ['yields'=>['energy'=>2,'minerals'=>5,'science'=>1,'rare_metals'=>2]],
        'biolum' => ['yields'=>['energy'=>2,'minerals'=>2,'science'=>2,'xenocultures'=>2,'unity'=>1]],
    ],

    'buildings' => [
        'mine' => ['name'=>'Mine','cost'=>['minerals'=>60],'yield'=>['minerals'=>6]],
        'power' => ['name'=>'Power Plant','cost'=>['minerals'=>60],'yield'=>['energy'=>6]],
        'lab' => ['name'=>'Research Lab','cost'=>['minerals'=>80],'yield'=>['science'=>5]],
        'farm' => ['name'=>'Agro Farm','cost'=>['minerals'=>60],'yield'=>['happiness'=>0.03,'population'=>1]],
        'culture' => ['name'=>'Cultural Center','cost'=>['minerals'=>70],'yield'=>['unity'=>2]],
        'fortress' => ['name'=>'Fortress','cost'=>['minerals'=>120],'yield'=>['defense'=>1]],
        'shipyard' => ['name'=>'Shipyard','cost'=>['minerals'=>150],'yield'=>['shipyard'=>1]],

        'rare_metal' => ['name'=>'Rare Metals Plant','cost'=>['minerals'=>120],'yield'=>['rare_metals'=>2],'requires'=>'metallurgy_1'],
        'gas_refinery' => ['name'=>'Gas Refinery','cost'=>['minerals'=>120],'yield'=>['exotic_gases'=>2],'requires'=>'gases_1'],
        'xeno_farm' => ['name'=>'Xenoculture Farm','cost'=>['minerals'=>120],'yield'=>['xenocultures'=>2],'requires'=>'xeno_1'],
    ],

    'factory_buildings' => [
        'zavod_planet' => [
            'name' => 'Planet Factory',
            'model' => 'zavod_planet',
            'planet_types' => ['biolum', 'terran', 'ice', 'desert', 'volcanic', 'vulcan', 'vulcanic'],
            'cost' => ['minerals' => 70],
            'yield' => ['science' => 4, 'energy' => 4, 'unity' => 4, 'xenocultures' => 2],
        ],
        'zavod_gas' => [
            'name' => 'Gas Factory',
            'model' => 'zavod_gas',
            'planet_types' => ['gas'],
            'cost' => ['minerals' => 70],
            'yield' => ['energy' => 4, 'science' => 4, 'rare_metals' => 2],
        ],
    ],

    'tech' => [
        'military' => [
            ['key'=>'laser_1','name'=>'Lasers I','cost'=>40,'unlocks'=>[]],
            ['key'=>'laser_2','name'=>'Lasers II + Missiles','cost'=>80,'unlocks'=>[]],
            ['key'=>'plasma_1','name'=>'Lasers III + Plasma','cost'=>140,'requires'=>['metallurgy_1'],'unlocks'=>[]],
            ['key'=>'shields_1','name'=>'Shields + Regen','cost'=>180,'requires'=>['gases_1'],'unlocks'=>[]],
            ['key'=>'drones_1','name'=>'Drones / Fighters','cost'=>240,'requires'=>['xeno_1'],'unlocks'=>[]],
        ],
        'industry' => [
            ['key'=>'mining_1','name'=>'Mining Efficiency','cost'=>50,'unlocks'=>[]],
            ['key'=>'reactor_1','name'=>'Advanced Reactors','cost'=>70,'unlocks'=>[]],
            ['key'=>'colonize_1','name'=>'Colonization Modules','cost'=>110,'unlocks'=>[]],
            ['key'=>'hyperdrive_1','name'=>'Hyperdrives','cost'=>150,'unlocks'=>[]],
            ['key'=>'factories_1','name'=>'Automated Factories','cost'=>210,'requires'=>['metallurgy_1'],'unlocks'=>[]],
        ],
        'science' => [
            ['key'=>'sensors_1','name'=>'Sensors Range','cost'=>40,'unlocks'=>[]],
            ['key'=>'combat_ai_1','name'=>'Combat AI','cost'=>90,'unlocks'=>[]],
            ['key'=>'artifacts_1','name'=>'Ancient Artifacts','cost'=>130,'requires'=>['xeno_1'],'unlocks'=>[]],
            ['key'=>'unique_1','name'=>'Psionics / Cybernetics','cost'=>180,'unlocks'=>[]],
            ['key'=>'final_1','name'=>'Final Technologies','cost'=>260,'unlocks'=>[]],
        ],

        'strategic' => [
            ['key'=>'metallurgy_1','name'=>'Rare Metallurgy','cost'=>100,'unlocks'=>['rare_metal']],
            ['key'=>'gases_1','name'=>'Exotic Gas Processing','cost'=>100,'unlocks'=>['gas_refinery']],
            ['key'=>'xeno_1','name'=>'Xenoculture Studies','cost'=>100,'unlocks'=>['xeno_farm']],
        ],
    ],
];
