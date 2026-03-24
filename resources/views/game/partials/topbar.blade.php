@php
    $showGalaxyButton = $showGalaxyButton ?? true;
@endphp

<div class="game-topbar glass rounded-pill px-3 py-2 d-flex align-items-center gap-3 flex-wrap">
    <div class="text-light small">
        <span class="text-secondary">{{ __('ui.game.turn') }}:</span>
        <span class="fw-bold text-warning">{{ $session->turn }}</span>
    </div>

    <span class="text-light small" data-bs-toggle="tooltip" title="Energy — upkeep, abilities, buildings">
        <i class="bi bi-lightning-charge-fill text-info"></i>
        <span class="ms-1">{{ $player->energy }}</span>
        <span class="text-secondary">(+{{ $player->energy_income }})</span>
    </span>
    <span class="text-light small" data-bs-toggle="tooltip" title="Minerals — ships, buildings, upgrades">
        <i class="bi bi-gem text-info"></i>
        <span class="ms-1">{{ $player->minerals }}</span>
        <span class="text-secondary">(+{{ $player->minerals_income }})</span>
    </span>
    <span class="text-light small" data-bs-toggle="tooltip" title="Science — unlock technologies">
        <i class="bi bi-beaker-fill text-info"></i>
        <span class="ms-1">{{ $player->science }}</span>
        <span class="text-secondary">(+{{ $player->science_income }})</span>
    </span>
    <span class="text-light small" data-bs-toggle="tooltip" title="Rare Metals — elite ships/modules">
        <i class="bi bi-hexagon-fill text-warning"></i>
        <span class="ms-1">{{ $player->rare_metals }}</span>
        <span class="text-secondary">(+{{ $player->rare_metals_income }})</span>
    </span>
    <span class="text-light small" data-bs-toggle="tooltip" title="Exotic Gases — shields & advanced tech">
        <i class="bi bi-cloud-haze2-fill text-primary"></i>
        <span class="ms-1">{{ $player->exotic_gases }}</span>
        <span class="text-secondary">(+{{ $player->exotic_gases_income }})</span>
    </span>
    <span class="text-light small" data-bs-toggle="tooltip" title="Xenocultures — growth & genetics">
        <i class="bi bi-flower2 text-success"></i>
        <span class="ms-1">{{ $player->xenocultures }}</span>
        <span class="text-secondary">(+{{ $player->xenocultures_income }})</span>
    </span>
    <span class="text-light small" data-bs-toggle="tooltip" title="Influence — claim systems & diplomacy">
        <i class="bi bi-star-fill text-warning"></i>
        <span class="ms-1">{{ $player->influence }}</span>
        <span class="text-secondary">(+{{ $player->influence_income }})</span>
    </span>
    <span class="text-light small" data-bs-toggle="tooltip" title="Unity — traditions & bonuses">
        <i class="bi bi-yin-yang text-warning"></i>
        <span class="ms-1">{{ $player->unity }}</span>
        <span class="text-secondary">(+{{ $player->unity_income }})</span>
    </span>

    <div class="ms-auto d-flex align-items-center gap-2">
        @if($showGalaxyButton)
            <a class="btn btn-sm btn-outline-light" href="{{ route('game.galaxy', ['session' => $session->id]) }}">← Galaxy</a>
        @endif
        <form method="POST" action="{{ route('game.endTurn', ['session' => $session->id]) }}" class="m-0">
            @csrf
            <button class="btn btn-sm btn-outline-warning">{{ __('ui.game.end_turn') }}</button>
        </form>
    </div>
</div>
