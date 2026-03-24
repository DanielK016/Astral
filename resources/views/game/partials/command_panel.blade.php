@php
    $commandIcons = [
        'research' => asset('assets/img_model_main/icon_bar/icon_research.png'),
        'diplomacy' => asset('assets/img_model_main/icon_bar/icon_diplomatie.png'),
        'war' => asset('assets/img_model_main/icon_bar/icon_war.png'),
    ];
    $racePlanetIconMap = [
    'humans' => asset('assets/img_model_main/human/RASA/human_planet.png'),
    'lorians' => asset('assets/img_model_main/zab_human/RASA/zab_human_planet.png'),
    'zeth' => asset('assets/img_model_main/roi/RASA/roi_planet.png'),
    ];

$capitalPlanetIcon = $racePlanetIconMap[$player->race_key] ?? $racePlanetIconMap['humans'];

    $currentTech = null;
    foreach ($researchTree as $branchItems) {
        foreach ($branchItems as $item) {
            if (($item['key'] ?? null) === $player->current_research_key) {
                $currentTech = $item;
                break 2;
            }
        }
    }

    $selectedDiplomacy = $diplomacyRows[0] ?? null;
    $dialogueLines = [
        'greeting_player' => __('dialogues.contact.greeting_player', ['player_race' => ':player_race', 'enemy_race' => ':enemy_race']),
        'greeting_enemy' => __('dialogues.contact.greeting_enemy', ['player_race' => ':player_race', 'enemy_race' => ':enemy_race']),
        'question_player' => __('dialogues.contact.question_player', ['player_race' => ':player_race', 'enemy_race' => ':enemy_race']),
        'question_enemy' => __('dialogues.contact.question_enemy', ['player_race' => ':player_race', 'enemy_race' => ':enemy_race']),
        'threat_player' => __('dialogues.contact.threat_player', ['player_race' => ':player_race', 'enemy_race' => ':enemy_race']),
        'threat_enemy' => __('dialogues.contact.threat_enemy', ['player_race' => ':player_race', 'enemy_race' => ':enemy_race']),
        'peace_player' => __('dialogues.contact.peace_player', ['player_race' => ':player_race', 'enemy_race' => ':enemy_race']),
        'peace_enemy' => __('dialogues.contact.peace_enemy', ['player_race' => ':player_race', 'enemy_race' => ':enemy_race']),
        'war_player' => __('dialogues.contact.war_player', ['player_race' => ':player_race', 'enemy_race' => ':enemy_race']),
        'war_enemy' => __('dialogues.contact.war_enemy', ['player_race' => ':player_race', 'enemy_race' => ':enemy_race']),
        'final_player' => __('dialogues.contact.final_player', ['player_race' => ':player_race', 'enemy_race' => ':enemy_race']),
        'final_enemy' => __('dialogues.contact.final_enemy', ['player_race' => ':player_race', 'enemy_race' => ':enemy_race']),
    ];

    $defaultCommandPanel = !empty($currentEncounter) ? 'war' : null;
@endphp

<style>
    :root {
        --command-rail-left: 12px;
        --command-rail-top: calc(var(--game-topbar-height) + 30px);
        --command-rail-width: 74px;
        --command-rail-panel-gap: 16px;
        --command-panel-width: 400px;
        --command-border: rgba(143, 215, 255, 0.18);
        --command-soft: rgba(143, 215, 255, 0.10);
        --command-bg: rgba(5, 11, 22, 0.88);
        --command-accent: #8fd7ff;
        --command-accent-soft: rgba(143, 215, 255, 0.14);
    }

    .command-rail {
        position: fixed;
        top: var(--command-rail-top);
        left: var(--command-rail-left);
        z-index: 95;
        width: var(--command-rail-width);
        padding: 16px 12px 20px;
        background: linear-gradient(180deg, rgba(8, 18, 34, 0.94), rgba(4, 10, 18, 0.90));
        border: 1px solid var(--command-border);
        border-radius: 26px 26px 26px 20px;
        box-shadow: inset 0 0 0 1px rgba(140, 255, 234, 0.05), 0 16px 40px rgba(0, 0, 0, 0.42), 0 0 32px rgba(80, 246, 216, 0.08);
        backdrop-filter: blur(12px);
    }

    .command-rail::after {
        content: '';
        position: absolute;
        inset: 10px auto 10px 8px;
        width: 2px;
        background: linear-gradient(180deg, rgba(95, 255, 227, 0.4), rgba(95, 255, 227, 0.04));
        border-radius: 999px;
    }

    .command-rail-hex {
        position: relative;
        width: 50px;
        height: 58px;
        margin: 0 auto 18px;
        clip-path: polygon(50% 0%, 92% 25%, 92% 75%, 50% 100%, 8% 75%, 8% 25%);
        background: linear-gradient(180deg, rgba(20, 46, 74, 0.98), rgba(9, 18, 24, 0.94));
        border: 1px solid rgba(143, 215, 255, 0.28);
        display: grid;
        place-items: center;
        box-shadow: 0 0 18px rgba(143, 215, 255, 0.18);
    }

    .command-rail-hex img {
        width: 34px;
        height: 34px;
        object-fit: contain;
        filter: drop-shadow(0 0 10px rgba(143, 215, 255, 0.22));
    }

    .command-rail-nav {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        position: relative;
        z-index: 2;
    }

    .command-rail-btn {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        border: 1px solid rgba(116, 255, 232, 0.14);
        background: rgba(255, 255, 255, 0.02);
        display: grid;
        place-items: center;
        cursor: pointer;
        transition: transform 0.16s ease, border-color 0.16s ease, background 0.16s ease, box-shadow 0.16s ease;
        position: relative;
    }

    .command-rail-btn:hover,
    .command-rail-btn.is-active {
        transform: translateY(-1px);
        border-color: rgba(116, 255, 232, 0.34);
        background: rgba(100, 255, 224, 0.10);
        box-shadow: 0 0 16px rgba(80, 246, 216, 0.12);
    }

    .command-rail-btn img {
        width: 24px;
        height: 24px;
        object-fit: contain;
    }

    .command-rail-btn::after {
        content: attr(data-tooltip);
        position: absolute;
        left: calc(100% + 10px);
        top: 50%;
        transform: translateY(-50%) translateX(-8px);
        opacity: 0;
        pointer-events: none;
        white-space: nowrap;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(2, 8, 14, 0.94);
        border: 1px solid rgba(116, 255, 232, 0.18);
        color: #effdff;
        font-size: 0.72rem;
        letter-spacing: 0.03em;
        transition: opacity 0.14s ease, transform 0.14s ease;
    }

    .command-rail-btn:hover::after {
        opacity: 1;
        transform: translateY(-50%) translateX(0);
    }

    .command-panel-shell {
        position: fixed;
        top: var(--command-rail-top);
        left: calc(var(--command-rail-left) + var(--command-rail-width) + var(--command-rail-panel-gap));
        width: min(var(--command-panel-width), calc(100vw - var(--command-rail-width) - 48px));
        max-height: calc(100vh - var(--command-rail-top) - 16px);
        z-index: 94;
        display: none;
        overflow: hidden;
        border-radius: 26px;
        background: linear-gradient(180deg, rgba(8, 18, 34, 0.96), rgba(4, 8, 16, 0.92));
        border: 1px solid var(--command-border);
        box-shadow: 0 16px 42px rgba(0, 0, 0, 0.44), 0 0 34px rgba(80, 246, 216, 0.06);
        backdrop-filter: blur(12px);
    }

    .command-panel-shell.is-open {
        display: block;
    }

    .command-panel-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 18px 20px 14px;
        border-bottom: 1px solid rgba(116, 255, 232, 0.12);
    }

    .command-panel-title {
        color: #ecffff;
        font-size: 1rem;
        font-weight: 800;
        letter-spacing: 0.18em;
        text-transform: uppercase;
    }

    .command-panel-close {
        width: 34px;
        height: 34px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(116, 255, 232, 0.14);
        color: #d9fbff;
        cursor: pointer;
    }

    .command-panel-body {
        padding: 16px 18px 20px;
        overflow: auto;
        max-height: calc(100vh - var(--command-rail-top) - 86px);
    }

    .command-pane { display: none; }
    .command-pane.is-active { display: block; }

    .command-card {
        border-radius: 18px;
        border: 1px solid rgba(116, 255, 232, 0.12);
        background: rgba(255, 255, 255, 0.03);
        padding: 14px;
    }

    .command-card + .command-card { margin-top: 14px; }

    .command-muted { color: #94aebb; font-size: 0.84rem; }
    .command-light { color: #effdff; }
    .command-accent { color: #ffd68c; }

    .research-grid {
        display: grid;
        gap: 12px;
    }

    .research-branch-title {
        font-size: 0.8rem;
        font-weight: 800;
        color: #ffd68c;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .research-tech-list {
        display: grid;
        gap: 8px;
    }

    .research-tech-item {
        padding: 10px 12px;
        border-radius: 14px;
        border: 1px solid rgba(116, 255, 232, 0.10);
        background: rgba(255, 255, 255, 0.02);
    }

    .research-tech-top,
    .diplo-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .research-select .form-select,
    .research-select .btn,
    .command-war-actions .btn {
        border-radius: 14px;
    }

    .diplo-list {
        display: grid;
        gap: 10px;
    }

    .diplo-row {
        padding: 12px 14px;
        border-radius: 16px;
        border: 1px solid rgba(116, 255, 232, 0.10);
        background: rgba(255, 255, 255, 0.02);
        cursor: pointer;
        transition: border-color 0.16s ease, background 0.16s ease, transform 0.16s ease;
    }

    .diplo-row:hover,
    .diplo-row.is-active {
        border-color: rgba(116, 255, 232, 0.26);
        background: rgba(100, 255, 224, 0.08);
        transform: translateY(-1px);
    }

    .diplo-card {
        position: relative;
        padding-top: 12px;
    }

    .diplo-avatar-wrap {
        position: relative;
        width: 116px;
        height: 116px;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(116, 255, 232, 0.16);
        background: radial-gradient(circle at center, rgba(33, 70, 76, 0.4), rgba(4, 8, 16, 0.9));
    }

    .diplo-avatar-wrap > img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .diplo-mini-icon {
        position: absolute;
        top: -8px;
        left: -8px;
        width: 38px;
        height: 44px;
        clip-path: polygon(50% 0%, 92% 25%, 92% 75%, 50% 100%, 8% 75%, 8% 25%);
        background: linear-gradient(180deg, rgba(20, 46, 74, 0.98), rgba(9, 18, 24, 0.94));
        border: 1px solid rgba(143, 215, 255, 0.28);
        display: grid;
        place-items: center;
        z-index: 2;
    }

    .diplo-mini-icon img { width: 22px; height: 22px; object-fit: contain; }

    .diplo-status-bar {
        position: relative;
        height: 14px;
        border-radius: 999px;
        overflow: hidden;
        background: linear-gradient(90deg, #8d2635 0%, #925b39 18%, #8d743d 34%, #52755f 50%, #3d8680 68%, #4496d1 84%, #6b7cff 100%);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .diplo-status-marker {
        position: absolute;
        top: -3px;
        width: 8px;
        height: 18px;
        border-radius: 999px;
        background: #ffffff;
        box-shadow: 0 0 8px rgba(255,255,255,0.4);
        transform: translateX(-50%);
    }

    .diplo-scale-grid {
        display: grid;
        gap: 6px;
        margin-top: 12px;
    }

    .diplo-scale-item {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        padding: 8px 10px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.03);
        color: #dff7fa;
        font-size: 0.78rem;
    }

    .war-encounter-card {
        border-radius: 18px;
        border: 1px solid rgba(116, 255, 232, 0.12);
        background: rgba(255, 255, 255, 0.03);
        padding: 14px;
    }

    .war-encounter-top {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .war-avatar {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        object-fit: cover;
        border: 1px solid rgba(116, 255, 232, 0.16);
    }

    .war-status-pill,
    .war-score-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 0.74rem;
        border: 1px solid rgba(116, 255, 232, 0.14);
        background: rgba(255, 255, 255, 0.04);
        color: #effdff;
    }

    .command-war-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 14px;
    }

    .encounter-list {
        display: grid;
        gap: 10px;
        margin-top: 14px;
    }

    .encounter-item-link {
        color: inherit;
        text-decoration: none;
    }

    .encounter-item {
        padding: 12px 14px;
        border-radius: 16px;
        border: 1px solid rgba(116, 255, 232, 0.10);
        background: rgba(255, 255, 255, 0.02);
    }

    .contact-dialogue-list {
        display: grid;
        gap: 10px;
    }

    .contact-line {
        display: flex;
        gap: 10px;
        align-items: flex-end;
    }

    .contact-line.is-right {
        justify-content: flex-end;
    }

    .contact-speaker {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid rgba(116, 255, 232, 0.20);
    }

    .contact-bubble {
        max-width: 78%;
        padding: 10px 12px;
        border-radius: 16px;
        border: 1px solid rgba(116, 255, 232, 0.12);
        background: rgba(255, 255, 255, 0.04);
        color: #effdff;
        font-size: 0.9rem;
    }

    .contact-line.is-right .contact-bubble {
        background: rgba(100, 255, 224, 0.12);
    }

    @media (max-width: 1100px) {
        .command-panel-shell {
            width: min(360px, calc(100vw - var(--command-rail-width) - 38px));
        }
    }

    @media (max-width: 768px) {
        .command-panel-shell {
            width: calc(100vw - 24px);
            left: 12px;
            top: auto;
            bottom: 12px;
            max-height: 58vh;
        }

        .command-rail {
            top: auto;
            bottom: 12px;
        }
    }
</style>

<div class="command-rail" data-command-rail data-default-panel="{{ $defaultCommandPanel }}">
    <div class="command-rail-hex">
        <img src="{{ $playerRaceUi['icon'] }}" alt="{{ $playerRaceUi['empire_name'] }}">
    </div>

    <div class="command-rail-nav">
        <button type="button" class="command-rail-btn" data-command-btn="research" data-tooltip="{{ __('dialogues.control.research') }}" title="{{ __('dialogues.control.research') }}">
            <img src="{{ $commandIcons['research'] }}" alt="{{ __('dialogues.control.research') }}">
        </button>
        <button type="button" class="command-rail-btn" data-command-btn="diplomacy" data-tooltip="{{ __('dialogues.control.diplomacy') }}" title="{{ __('dialogues.control.diplomacy') }}">
            <img src="{{ $commandIcons['diplomacy'] }}" alt="{{ __('dialogues.control.diplomacy') }}">
        </button>
        <button type="button" class="command-rail-btn" data-command-btn="war" data-tooltip="{{ __('dialogues.control.war') }}" title="{{ __('dialogues.control.war') }}">
            <img src="{{ $commandIcons['war'] }}" alt="{{ __('dialogues.control.war') }}">
        </button>
        <button type="button" class="command-rail-btn" id="openPlanetsPanelBtn" data-tooltip="Planets" title="Planets">
            <img src="{{ $capitalPlanetIcon }}" alt="Planets">
        </button>
    </div>
</div>

<div class="command-panel-shell" data-command-panel-shell>
    <div class="command-panel-head">
        <div class="command-panel-title" data-command-panel-title>{{ __('dialogues.control.research') }}</div>
        <button type="button" class="command-panel-close" data-command-close>&times;</button>
    </div>
    <div class="command-panel-body">
        <section class="command-pane" data-command-pane="research">
            <div class="command-card">
                <div class="command-muted text-uppercase" style="letter-spacing:.08em;">{{ __('dialogues.research.current') }}</div>
                <div class="command-light fw-bold mt-1">{{ $currentTech['name'] ?? __('dialogues.research.none') }}</div>
                @if($currentTech)
                    <div class="command-muted mt-1">{{ __('dialogues.research.cost') }}: {{ $currentTech['cost'] ?? 0 }}</div>
                @endif
            </div>

            <div class="command-card research-select mt-3">
                <form method="POST" action="{{ route('game.research.select', ['session' => $session->id]) }}">
                    @csrf
                    <select name="tech_key" class="form-select form-select-sm bg-dark text-light border border-info border-opacity-25 mb-2">
                        <option value="">{{ __('dialogues.research.available') }}</option>
                        @foreach($researchTree as $branch => $items)
                            <optgroup label="{{ ucfirst($branch) }}">
                                @foreach($items as $t)
                                    @php $k = $t['key']; @endphp
                                    @if(!in_array($k, $unlocked, true))
                                        <option value="{{ $k }}">{{ $t['name'] }} ({{ $t['cost'] }})</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    <button class="btn btn-sm btn-outline-info w-100">{{ __('dialogues.research.start') }}</button>
                </form>
            </div>

            <div class="research-grid mt-3">
                @foreach($researchTree as $branch => $items)
                    <div class="command-card">
                        <div class="research-branch-title">{{ ucfirst($branch) }}</div>
                        <div class="research-tech-list">
                            @foreach($items as $tech)
                                @php
                                    $isUnlocked = in_array($tech['key'], $unlocked, true);
                                    $isCurrent = $player->current_research_key === $tech['key'];
                                @endphp
                                <div class="research-tech-item">
                                    <div class="research-tech-top">
                                        <div>
                                            <div class="command-light fw-semibold">{{ $tech['name'] }}</div>
                                            <div class="command-muted">{{ __('dialogues.research.cost') }}: {{ $tech['cost'] }}</div>
                                        </div>
                                        <span class="badge {{ $isUnlocked ? 'text-bg-success' : ($isCurrent ? 'text-bg-warning' : 'text-bg-dark') }}">
                                            {{ $isUnlocked ? __('dialogues.research.completed') : ($isCurrent ? __('dialogues.research.in_progress') : __('ui.common.select')) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="command-pane" data-command-pane="diplomacy">
            <div class="command-card">
                <div class="diplo-row" style="cursor:default; background:transparent; border:none; padding:0; transform:none;">
                    <div class="command-muted text-uppercase" style="letter-spacing:.08em;">{{ __('dialogues.diplomacy.name') }}</div>
                    <div class="command-muted text-uppercase" style="letter-spacing:.08em;">{{ __('dialogues.diplomacy.level') }}</div>
                </div>
            </div>

            <div class="diplo-list mt-3" data-diplo-list>
                @foreach($diplomacyRows as $row)
                    <div
                        class="diplo-row {{ $loop->first ? 'is-active' : '' }}"
                        data-diplo-row
                        data-name="{{ $row['name'] }}"
                        data-avatar="{{ $row['avatar'] }}"
                        data-icon="{{ $row['icon'] }}"
                        data-score="{{ $row['score_label'] }}"
                        data-band="{{ $row['band_label'] }}"
                        data-percent="{{ $row['bar_percent'] }}"
                    >
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ $row['icon'] }}" alt="{{ $row['name'] }}" style="width:26px;height:26px;object-fit:contain;">
                            <div class="command-light fw-semibold">{{ $row['name'] }}</div>
                        </div>
                        <div class="war-score-pill">{{ $row['score_label'] }}</div>
                    </div>
                @endforeach
            </div>

            @if($selectedDiplomacy)
                <div class="command-card diplo-card mt-3" data-diplo-card>
                    <div class="d-flex gap-3 align-items-start">
                        <div class="diplo-avatar-wrap">
                            <div class="diplo-mini-icon"><img src="{{ $selectedDiplomacy['icon'] }}" alt="{{ $selectedDiplomacy['name'] }}"></div>
                            <img src="{{ $selectedDiplomacy['avatar'] }}" alt="{{ $selectedDiplomacy['name'] }}" data-diplo-avatar>
                        </div>
                        <div class="flex-grow-1">
                            <div class="command-muted text-uppercase" style="letter-spacing:.08em;">{{ __('dialogues.diplomacy.details') }}</div>
                            <div class="command-light fw-bold fs-5 mt-1" data-diplo-name>{{ $selectedDiplomacy['name'] }}</div>
                            <div class="war-score-pill mt-2" data-diplo-score>{{ $selectedDiplomacy['score_label'] }}</div>
                            <div class="command-muted mt-2" data-diplo-band>{{ $selectedDiplomacy['band_label'] }}</div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="diplo-status-bar">
                            <div class="diplo-status-marker" data-diplo-marker style="left: {{ $selectedDiplomacy['bar_percent'] }}%;"></div>
                        </div>
                    </div>

                    <div class="command-muted mt-3">{{ __('dialogues.diplomacy.scale_title') }}</div>
                    <div class="diplo-scale-grid">
                        <div class="diplo-scale-item"><span>-100 → -80</span><span>{{ __('dialogues.diplomacy_bands.hostility') }}</span></div>
                        <div class="diplo-scale-item"><span>-79 → -31</span><span>{{ __('dialogues.diplomacy_bands.antipathy') }}</span></div>
                        <div class="diplo-scale-item"><span>-30 → -6</span><span>{{ __('dialogues.diplomacy_bands.suspicion') }}</span></div>
                        <div class="diplo-scale-item"><span>-5 → +30</span><span>{{ __('dialogues.diplomacy_bands.neutral') }}</span></div>
                        <div class="diplo-scale-item"><span>+31 → +79</span><span>{{ __('dialogues.diplomacy_bands.sympathy') }}</span></div>
                        <div class="diplo-scale-item"><span>+80 → +95</span><span>{{ __('dialogues.diplomacy_bands.friends') }}</span></div>
                        <div class="diplo-scale-item"><span>+96 → +100</span><span>{{ __('dialogues.diplomacy_bands.allies') }}</span></div>
                    </div>
                </div>
            @endif
        </section>

        <section class="command-pane" data-command-pane="war">
            @if(!empty($currentEncounter))
                <div class="war-encounter-card" data-current-encounter>
                    <div class="war-encounter-top">
                        <img class="war-avatar" src="{{ $currentEncounter['enemy_avatar'] }}" alt="{{ $currentEncounter['enemy_name'] }}">
                        <div class="flex-grow-1">
                            <div class="command-light fw-bold">{{ $currentEncounter['enemy_name'] }}</div>
                            <div class="command-muted">{{ $currentEncounter['system_name'] }}</div>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <span class="war-score-pill">{{ $currentEncounter['score_label'] }}</span>
                                <span class="war-status-pill">{{ $currentEncounter['band_label'] }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="command-card mt-3">
                        <div class="command-muted">{{ __('dialogues.war.ship_class') }}</div>
                        <div class="command-light fw-semibold mt-1">{{ ucfirst($currentEncounter['enemy_ship_type']) }}</div>
                        <div class="command-muted mt-2">{{ $currentEncounter['status_label'] }}</div>
                    </div>

                    @if($currentEncounter['status'] === 'contact')
                        <div class="command-war-actions">
                            @if($player->race_key !== 'zeth')
                                <button type="button" class="btn btn-sm btn-outline-info" data-open-contact-dialogue>
                                    {{ __('dialogues.war.contact') }}
                                </button>
                            @endif
                            <form method="POST" action="{{ route('game.encounter.war', ['session' => $session->id, 'encounter' => $currentEncounter['id']]) }}">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger">{{ __('dialogues.war.direct_war') }}</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endif

            <div class="command-card mt-{{ !empty($currentEncounter) ? '3' : '0' }}">
                <div class="command-muted text-uppercase" style="letter-spacing:.08em;">{{ __('dialogues.war.active_contacts') }}</div>
                @if(empty($activeEncounters))
                    <div class="command-muted mt-2">{{ __('dialogues.war.no_contacts') }}</div>
                @else
                    <div class="encounter-list">
                        @foreach($activeEncounters as $encounterRow)
                            <a class="encounter-item-link" href="{{ route('game.system', ['session' => $session->id, 'system' => $encounterRow['system_id']]) }}">
                                <div class="encounter-item">
                                    <div class="d-flex align-items-center justify-content-between gap-2">
                                        <div>
                                            <div class="command-light fw-semibold">{{ $encounterRow['system_name'] }}</div>
                                            <div class="command-muted">{{ $encounterRow['enemy_name'] }} · {{ ucfirst($encounterRow['enemy_ship_type']) }}</div>
                                        </div>
                                        <span class="war-score-pill">{{ $encounterRow['score_label'] }}</span>
                                    </div>
                                    <div class="command-muted mt-2">{{ $encounterRow['status_label'] }}</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    </div>
</div>

@if(!empty($currentEncounter))
    <div class="modal fade" id="contactDialogueModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content bg-dark text-light border border-info border-opacity-25 rounded-4 overflow-hidden">
                <div class="modal-header border-info border-opacity-25">
                    <h5 class="modal-title text-info">{{ __('dialogues.war.dialogue_title') }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="contact-dialogue-list" data-contact-dialogue-list></div>

                    <div class="command-card mt-3">
                        <div class="command-light fw-semibold">{{ __('dialogues.war.choose_response') }}</div>
                        <div class="command-muted mt-2">{{ __('dialogues.war.option_a') }} / {{ __('dialogues.war.option_b') }}</div>
                    </div>
                </div>
                <div class="modal-footer border-info border-opacity-25 d-flex flex-wrap justify-content-between">
                    @if($player->race_key !== 'zeth')
                        <form method="POST" action="{{ route('game.encounter.peace', ['session' => $session->id, 'encounter' => $currentEncounter['id']]) }}">
                            @csrf
                            <button class="btn btn-outline-success">{{ __('dialogues.war.peace_submit') }}</button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('game.encounter.war', ['session' => $session->id, 'encounter' => $currentEncounter['id']]) }}">
                        @csrf
                        <button class="btn btn-outline-danger">{{ __('dialogues.war.war_submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', () => {
    const shell = document.querySelector('[data-command-panel-shell]');
    const buttons = Array.from(document.querySelectorAll('[data-command-btn]'));
    const panes = Array.from(document.querySelectorAll('[data-command-pane]'));
    const titleEl = document.querySelector('[data-command-panel-title]');
    const closeBtn = document.querySelector('[data-command-close]');
    const defaultPanel = document.querySelector('[data-command-rail]')?.dataset.defaultPanel || '';
    const titles = {
        research: @json(__('dialogues.control.research')),
        diplomacy: @json(__('dialogues.control.diplomacy')),
        war: @json(__('dialogues.control.war')),
    };

  function openPanel(panelKey) {
    if (!panelKey || !shell) return;

    leftPanel?.classList.remove('is-open');
    document.getElementById('openPlanetsPanelBtn')?.classList.remove('is-active');

    shell.classList.add('is-open');
    buttons.forEach((btn) => btn.classList.toggle('is-active', btn.dataset.commandBtn === panelKey));
    panes.forEach((pane) => pane.classList.toggle('is-active', pane.dataset.commandPane === panelKey));
    if (titleEl) titleEl.textContent = titles[panelKey] || panelKey.toUpperCase();
}

    function closePanel() {
    shell?.classList.remove('is-open');
    buttons.forEach((btn) => btn.classList.remove('is-active'));
    panes.forEach((pane) => pane.classList.remove('is-active'));
}

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            const panelKey = button.dataset.commandBtn;
            const isOpen = shell?.classList.contains('is-open') && button.classList.contains('is-active');
            if (isOpen) {
                closePanel();
                return;
            }
            openPanel(panelKey);
        });
    });

    closeBtn?.addEventListener('click', closePanel);

    if (defaultPanel) {
        openPanel(defaultPanel);
    }
 const openPlanetsPanelBtn = document.getElementById('openPlanetsPanelBtn');
const leftPanel = document.querySelector('.left-panel');

openPlanetsPanelBtn?.addEventListener('click', () => {
    if (!leftPanel) return;

    const isOpen = leftPanel.classList.contains('is-open');

    if (isOpen) {
        leftPanel.classList.remove('is-open');
        openPlanetsPanelBtn.classList.remove('is-active');
        return;
    }

    closePanel(); 
    leftPanel.classList.add('is-open');
    openPlanetsPanelBtn.classList.add('is-active');

    leftPanel.classList.add('flash');
    setTimeout(() => leftPanel.classList.remove('flash'), 1800);
});
    const diploRows = Array.from(document.querySelectorAll('[data-diplo-row]'));
    const diploName = document.querySelector('[data-diplo-name]');
    const diploAvatar = document.querySelector('[data-diplo-avatar]');
    const diploScore = document.querySelector('[data-diplo-score]');
    const diploBand = document.querySelector('[data-diplo-band]');
    const diploMarker = document.querySelector('[data-diplo-marker]');
    const diploMini = document.querySelector('.diplo-mini-icon img');

    diploRows.forEach((row) => {
        row.addEventListener('click', () => {
            diploRows.forEach((item) => item.classList.remove('is-active'));
            row.classList.add('is-active');
            if (diploName) diploName.textContent = row.dataset.name || '';
            if (diploAvatar) diploAvatar.src = row.dataset.avatar || '';
            if (diploScore) diploScore.textContent = row.dataset.score || '';
            if (diploBand) diploBand.textContent = row.dataset.band || '';
            if (diploMarker) diploMarker.style.left = `${row.dataset.percent || 50}%`;
            if (diploMini) diploMini.src = row.dataset.icon || '';
        });
    });

    const openDialogueBtn = document.querySelector('[data-open-contact-dialogue]');
    const dialogueList = document.querySelector('[data-contact-dialogue-list]');

    if (openDialogueBtn && dialogueList) {
        const modalEl = document.getElementById('contactDialogueModal');
        const modal = (modalEl && typeof bootstrap !== 'undefined' && bootstrap.Modal)
            ? new bootstrap.Modal(modalEl)
            : null;

        const player = {
            name: @json($playerRaceUi['empire_name']),
            avatar: @json($playerRaceUi['avatar']),
        };

        const enemy = {
            name: @json($currentEncounter['enemy_name'] ?? ''),
            avatar: @json($currentEncounter['enemy_avatar'] ?? ''),
        };

        const lines = @json($dialogueLines);

        function renderLine(side, avatar, text) {
            const row = document.createElement('div');
            row.className = `contact-line ${side === 'right' ? 'is-right' : ''}`;
            row.innerHTML = `
                ${side === 'left' ? `<img class="contact-speaker" src="${avatar}" alt="">` : ''}
                <div class="contact-bubble">${text}</div>
                ${side === 'right' ? `<img class="contact-speaker" src="${avatar}" alt="">` : ''}
            `;
            return row;
        }

        function resolveText(template) {
            return String(template || '')
                .replaceAll(':player_race', player.name)
                .replaceAll(':enemy_race', enemy.name);
        }

        openDialogueBtn.addEventListener('click', () => {
            dialogueList.innerHTML = '';

            const sequence = [
                ['left', player.avatar, resolveText(lines.greeting_player)],
                ['right', enemy.avatar, resolveText(lines.greeting_enemy)],
                ['left', player.avatar, resolveText(lines.question_player)],
                ['right', enemy.avatar, resolveText(lines.question_enemy)],
                ['left', player.avatar, resolveText(lines.threat_player)],
                ['right', enemy.avatar, resolveText(lines.threat_enemy)],
                ['left', player.avatar, resolveText(lines.peace_player)],
                ['right', enemy.avatar, resolveText(lines.peace_enemy)],
                ['left', player.avatar, resolveText(lines.war_player)],
                ['right', enemy.avatar, resolveText(lines.war_enemy)],
                ['left', player.avatar, resolveText(lines.final_player)],
                ['right', enemy.avatar, resolveText(lines.final_enemy)],
            ];

            sequence.forEach(([side, avatar, text]) => {
                dialogueList.appendChild(renderLine(side, avatar, text));
            });

            modal?.show();
        });
    }
});
</script>
