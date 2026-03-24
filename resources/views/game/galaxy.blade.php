@php
$hideGameNav = true;
$resourceTopbarMap = [
    ['field' => 'science',      'income' => 'science_income',      'label' => 'Energy Credits', 'icon' => asset('assets/resources64x64/Energy_Credits.png')],
    ['field' => 'energy',       'income' => 'energy_income',       'label' => 'Biomass',        'icon' => asset('assets/resources64x64/Biomass.png')],
    ['field' => 'unity',        'income' => 'unity_income',        'label' => 'Raw Minerals',   'icon' => asset('assets/resources64x64/Raw_Minerals.png')],
    ['field' => 'minerals',     'income' => 'minerals_income',     'label' => 'Dark Matter',    'icon' => asset('assets/resources64x64/Dark_Matter.png')],
    ['field' => 'rare_metals',  'income' => 'rare_metals_income',  'label' => 'Ethereal Dust',  'icon' => asset('assets/resources64x64/Ethereal_Dust.png')],
    ['field' => 'exotic_gases', 'income' => 'exotic_gases_income', 'label' => 'Living Crystal', 'icon' => asset('assets/resources64x64/Living_Crystal.png')],
    ['field' => 'xenocultures', 'income' => 'xenocultures_income', 'label' => 'Nano Alloys',    'icon' => asset('assets/resources64x64/Nano-Alloys.png')],
    ['field' => 'influence',    'income' => 'influence_income',    'label' => 'Neural Chips',   'icon' => asset('assets/resources64x64/Neural_Chips.png')],
];
@endphp
@extends('layouts.game')

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    :root {
        --game-topbar-height: 92px;
        --hud-border: rgba(143, 215, 255, .16);
        --hud-border-strong: rgba(143, 215, 255, .28);
        --hud-bg: rgba(5, 11, 22, .72);
        --hud-soft: rgba(255, 255, 255, .03);
        --hud-text: #eef7ff;
        --hud-muted: rgba(220, 235, 255, .62);
        --hud-accent: #8fd7ff;
        --hud-gold: #ffd38a;
    }

    .galaxy-view {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        background: #030711;
    }

    .galaxy-view::before {
        content: '';
        position: fixed;
        inset: 0;
        pointer-events: none;
        background:
            radial-gradient(circle at 18% 20%, rgba(90, 176, 255, .12), transparent 24%),
            radial-gradient(circle at 84% 18%, rgba(255, 193, 119, .08), transparent 20%),
            linear-gradient(180deg, rgba(4, 9, 18, .14), rgba(3, 5, 11, .62));
        z-index: 0;
    }

    .map-frame {
        position: fixed;
        inset: 0;
        border: 0;
        width: 100vw;
        height: 100vh;
        z-index: 1;
        opacity: 0;
        transition: opacity .55s ease;
    }

    .map-frame.is-ready {
        opacity: 1;
    }

    .galaxy-overlay-layer {
        position: fixed;
        inset: 0;
        z-index: 20;
        pointer-events: none;
    }

    .hud-panel {
        background: linear-gradient(180deg, rgba(255,255,255,.046), rgba(255,255,255,.02)), var(--hud-bg);
        border: 1px solid var(--hud-border);
        border-radius: 24px;
        box-shadow: 0 18px 42px rgba(0, 0, 0, .26);
        backdrop-filter: blur(16px);
    }

    .galaxy-topbar {
        position: fixed;
        top: 12px;
        left: 12px;
        right: 12px;
        z-index: 120;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 12px 14px;
        pointer-events: auto;
    }

    .galaxy-brand {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    .galaxy-brand__eyebrow {
        color: var(--hud-accent);
        font-size: .72rem;
        font-weight: 800;
        letter-spacing: .18em;
        text-transform: uppercase;
    }

    .galaxy-brand__title {
        color: var(--hud-text);
        font-weight: 800;
        letter-spacing: .14em;
        text-transform: uppercase;
        font-size: clamp(1rem, 1.5vw, 1.2rem);
    }

    .galaxy-brand__copy {
        color: var(--hud-muted);
        font-size: .86rem;
        margin-top: 4px;
    }

    .galaxy-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .galaxy-pill,
    .galaxy-endturn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        min-height: 36px;
        padding: 0 10px;
        border-radius: 10px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: rgba(255, 255, 255, .03);
        color: var(--hud-text);
        font-weight: 700;
    }

    .galaxy-pill img {
        width: 18px;
        height: 18px;
        object-fit: contain;
        filter: drop-shadow(0 0 6px rgba(85,210,255,.35));
    }

    .galaxy-pill__income {
        color: var(--hud-muted);
        font-size: .84rem;
    }

    .galaxy-endturn {
        border-color: rgba(255, 211, 138, .26);
        background: rgba(255, 211, 138, .06);
        color: #fff3d8;
        transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .galaxy-endturn:hover {
        transform: translateY(-1px);
        border-color: rgba(255, 211, 138, .48);
        background: rgba(255, 211, 138, .12);
        box-shadow: 0 0 20px rgba(255, 211, 138, .10);
    }
    .galaxy-status-card {
        position: fixed;
        top: 112px;
        right: 12px;
        width: min(420px, calc(100vw - 128px));
        z-index: 90;
        padding: 16px 18px;
        pointer-events: auto;
    }

    .galaxy-status-card__eyebrow {
        color: var(--hud-gold);
        font-size: .72rem;
        font-weight: 800;
        letter-spacing: .18em;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .galaxy-status-card__message {
        color: var(--hud-text);
        line-height: 1.66;
        font-size: .92rem;
    }

    .galaxy-status-card__message span {
        color: var(--hud-muted);
    }

.mode-dock {
    position: fixed;
    left: 12px;
    bottom: 12px;
    right: auto;
    z-index: 95;
    width: min(430px, calc(100vw - 24px));
    padding: 10px;
    pointer-events: auto;
}

    .mode-dock__title {
        color: var(--hud-gold);
        font-size: .60rem;
        font-weight: 800;
        letter-spacing: .18em;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .mode-dock__grid {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 5px;
    }

    .mode-dock .mode-btn {
        min-height: 35px;
        border-radius: 10px;
        font-size: 0.8rem;
        border: 1px solid rgba(143, 215, 255, .14);
        background: rgba(255, 255, 255, .03);
        color: #eef7ff;
        font-weight: 800;
        letter-spacing: .08em;
        transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .mode-dock .mode-btn:hover,
    .mode-dock .mode-btn.is-active {
        transform: translateY(-1px);
        border-color: var(--hud-border-strong);
        background: rgba(96, 187, 255, .10);
        box-shadow: 0 0 18px rgba(97, 188, 255, .14);
    }

    .galaxy-loader,
    .galaxy-transition {
        position: fixed;
        inset: 0;
        z-index: 160;
        display: grid;
        place-items: center;
        transition: opacity .46s ease, visibility .46s ease;
    }

    .galaxy-loader {
        background: radial-gradient(circle at 50% 40%, rgba(20, 48, 84, .34), rgba(1, 4, 10, .94));
        opacity: 1;
        visibility: visible;
    }

    .galaxy-loader.is-hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    .galaxy-loader__box {
        text-align: center;
        padding: 26px 30px;
        border-radius: 24px;
        border: 1px solid rgba(143, 215, 255, .16);
        background: rgba(6, 12, 24, .68);
        backdrop-filter: blur(16px);
        box-shadow: 0 18px 42px rgba(0, 0, 0, .26);
    }

    .galaxy-loader__title {
        color: #eff7ff;
        font-size: .92rem;
        font-weight: 800;
        letter-spacing: .28em;
        text-transform: uppercase;
    }

    .galaxy-loader__copy {
        margin-top: 10px;
        color: var(--hud-muted);
        font-size: .9rem;
    }

    .galaxy-transition {
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        background: radial-gradient(circle at 50% 36%, rgba(24, 58, 99, .24), rgba(1, 4, 10, .96));
    }

    .galaxy-transition.is-visible {
        opacity: 1;
        visibility: visible;
        pointer-events: none;
    }

    @media (max-width: 1200px) {
        .galaxy-topbar {
            flex-direction: column;
            align-items: stretch;
        }
    }

    @media (max-width: 991px) {
        .galaxy-status-card {
            top: 132px;
        }

        .mode-dock__grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 760px) {
        .galaxy-status-card,
        .mode-dock {
            width: calc(100vw - 24px);
        }

        .galaxy-status-card {
            top: auto;
            bottom: 208px;
        }

        .galaxy-title-card {
            bottom: 314px;
        }
    }
</style>
@endpush

@section('content')
<div class="galaxy-view">
    <iframe
        class="map-frame"
        src="{{ asset('legacy/index.html') }}?embed=1&session={{ $session->id }}&player={{ $player->id }}"
        data-galaxy-frame></iframe>

    <div class="galaxy-overlay-layer">
        <div class="galaxy-topbar hud-panel">
            <div class="galaxy-brand">
                <div>
                    <div class="galaxy-brand__eyebrow">Starmap Command</div>
                    <div class="galaxy-brand__title">Galaxy Map · Turn {{ $session->turn }}</div>
                    
                </div>
            </div>

            <div class="galaxy-actions">
                @foreach($resourceTopbarMap as $resource)
                    <span class="galaxy-pill" title="{{ $resource['label'] }}">
                        <img src="{{ $resource['icon'] }}" alt="{{ $resource['label'] }}">
                        <span>{{ $player->{$resource['field']} }}</span>
                        <span class="galaxy-pill__income">(+{{ $player->{$resource['income']} }})</span>
                    </span>
                @endforeach

                <form method="POST" action="{{ route('game.endTurn', ['session' => $session->id]) }}" class="m-0">
                    @csrf
                    <input type="hidden" name="return_to" value="{{ request()->url() }}">
                    <button class="galaxy-endturn" type="submit">{{ __('ui.game.end_turn') }}</button>
                </form>
            </div>
        </div>

        @include('game.partials.command_panel')
        @if($lastEvent)
            <div class="galaxy-status-card hud-panel">
                <div class="galaxy-status-card__eyebrow">Recent Event</div>
                <div class="galaxy-status-card__message">
                    {{ $lastEvent->title }}
                    <span>· {{ $lastEvent->message }}</span>
                </div>
            </div>
        @endif

        <div class="mode-dock hud-panel">
            <div class="mode-dock__title">View Modes</div>
            <div class="mode-dock__grid" data-mode-dock>
                @for($mode = 1; $mode <= 6; $mode++)
                    <button type="button" class="mode-btn {{ $mode === 1 ? 'is-active' : '' }}" data-mode="{{ $mode }}">{{ $mode }}</button>
                @endfor
            </div>
        </div>
    </div>

    <div class="galaxy-loader" data-galaxy-loader>
        <div class="galaxy-loader__box">
            <div class="galaxy-loader__title">Initializing Starmap</div>
            <div class="galaxy-loader__copy">Loading systems, borders, fleets, and hyperlanes.</div>
        </div>
    </div>

    <div class="galaxy-transition" data-galaxy-transition></div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const galaxyFrame = document.querySelector('[data-galaxy-frame]');
        const loader = document.querySelector('[data-galaxy-loader]');
        const transition = document.querySelector('[data-galaxy-transition]');
        const modeButtons = Array.from(document.querySelectorAll('[data-mode-dock] [data-mode]'));

        
        const showSceneTransition = () => {
    transition?.classList.add('is-visible');
    window.AstralPageTransition?.show?.();

    setTimeout(() => {
        transition?.classList.remove('is-visible');
        window.AstralPageTransition?.hide?.();
    }, 5000);
};

        const hideLoader = () => {
    loader?.classList.add('is-hidden');
    galaxyFrame?.classList.add('is-ready');
};

setTimeout(hideLoader, 5000);

        galaxyFrame?.addEventListener('load', () => {
            setTimeout(hideLoader, 220);
        });

       const activateModeButton = (mode) => {
    const normalizedMode = String(mode);

    modeButtons.forEach((button) => {
        button.classList.toggle('is-active', String(button.dataset.mode) === normalizedMode);
    });
};

const setGalaxyMode = (mode) => {
    const normalizedMode = Number(mode);
    if (!normalizedMode || normalizedMode < 1 || normalizedMode > 6) return;

    galaxyFrame?.contentWindow?.postMessage({ type: 'setMode', mode: normalizedMode }, '*');
    activateModeButton(normalizedMode);
};

modeButtons.forEach((button) => {
    button.addEventListener('click', () => {
        setGalaxyMode(button.dataset.mode);
    });
});

window.addEventListener('keydown', (e) => {
    const tag = (document.activeElement?.tagName || '').toLowerCase();
    const isTyping =
        tag === 'input' ||
        tag === 'textarea' ||
        tag === 'select' ||
        document.activeElement?.isContentEditable;

    if (isTyping) return;

    const n = Number(e.key);
    if (n >= 1 && n <= 6) {
        setGalaxyMode(n);
    }
});
        window.addEventListener('message', (e) => {
            if (!e.data || typeof e.data !== 'object') return;

          if (e.data.type === 'goSystem' && e.data.systemId) {
    const url = "{{ route('game.system', ['session' => $session->id, 'system' => '__SYSTEM__']) }}".replace('__SYSTEM__', String(e.data.systemId));
    window.location.href = url;
}
        });

        window.addEventListener('keydown', (e) => {
            const n = parseInt(e.key, 10);
            if (n >= 1 && n <= 6) {
                setGalaxyMode(n);
            }
        });
    });
</script>
@endpush
@endsection
