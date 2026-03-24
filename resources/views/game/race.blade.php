@extends('layouts.game')

@php
$hideGameNav = true;

$raceMeta = [
'humans' => [
'government' => [
'title' => 'Parliamentary Federation',
'ethics' => ['Egalitarian', 'Xenophile'],
],
'traits' => ['Adaptive', 'Diplomatic Corps', 'Research Driven', 'Balanced Growth'],
'homeworld' => [
'name' => 'Terra Prime',
'type' => 'Continental World',
],
],
'lorians' => [
'government' => [
'title' => 'Restoration Directorate',
'ethics' => ['Militarist', 'Materialist'],
],
'traits' => ['Cybernetic Survivors', 'Armored Colonists', 'Rapid Repairs', 'Harsh Environment'],
'homeworld' => [
'name' => 'Loria',
'type' => 'Ruined Industrial World',
],
],
'zeth' => [
'government' => [
'title' => 'Collective Hive',
'ethics' => ['Gestalt Consciousness', 'Expansionist Swarm'],
],
'traits' => ['Hive Synapse', 'Rapid Breeders', 'Swarm Coordination', 'Limited Individualism'],
'homeworld' => [
'name' => 'Zeth-Nest',
'type' => 'Hive World',
],
],
];

$raceKey = $race['key'] ?? 'humans';
$raceDetails = $raceMeta[$raceKey] ?? $raceMeta['humans'];
@endphp

@push('head')
<style>
    .race-screen {
        min-height: 100vh;
        position: relative;
        padding: 1.5rem;
        background:
            radial-gradient(circle at 15% 15%, rgba(0, 180, 255, .14), transparent 28%),
            radial-gradient(circle at 85% 10%, rgba(19, 126, 255, .12), transparent 26%),
            linear-gradient(180deg, rgba(0, 16, 24, .92), rgba(0, 10, 18, .98));
        overflow: hidden;
    }

    .race-screen::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(98, 227, 255, .05), transparent 15%, transparent 85%, rgba(98, 227, 255, .05)),
            radial-gradient(circle at 50% 30%, rgba(0, 180, 255, .08), transparent 42%);
        pointer-events: none;
    }

    .race-topbar {
        position: relative;
        z-index: 3;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        max-width: 1460px;
        margin: 0 auto 1rem;
    }

    .race-chip,
    .race-lang .btn,
    .race-nav-btn {
        backdrop-filter: blur(12px);
        background: rgba(3, 16, 28, .58);
        border: 1px solid rgba(98, 227, 255, .22);
        box-shadow: 0 0 24px rgba(0, 180, 255, .12);
        color: #d9fbff;
    }

    .race-chip {
        border-radius: 999px;
        padding: .7rem 1.05rem;
        text-decoration: none;
        font-weight: 700;
    }

    .race-lang .btn.active {
        background: rgba(0, 170, 255, .2);
        box-shadow: inset 0 0 0 1px rgba(120, 235, 255, .3), 0 0 18px rgba(0, 200, 255, .18);
    }

    .race-frame {
        position: relative;
        z-index: 2;
        max-width: 1460px;
        margin: 0 auto;
        padding: 1.15rem;
        border-radius: 24px;
        border: 1px solid rgba(111, 222, 255, .18);
        background: linear-gradient(180deg, rgba(5, 18, 28, .84), rgba(3, 11, 19, .94));
        box-shadow: 0 24px 60px rgba(0, 0, 0, .36), inset 0 0 0 1px rgba(145, 240, 255, .05);
    }

    .race-title {
        margin: 0 0 1rem;
        text-align: center;
        color: #effcff;
        font-size: clamp(1.8rem, 2.6vw, 2.8rem);
        font-weight: 700;
        letter-spacing: .04em;
        text-shadow: 0 0 22px rgba(86, 228, 255, .3);
    }

    .race-header-grid {
        display: grid;
        grid-template-columns: minmax(0, 2.45fr) minmax(260px, .85fr);
        gap: 1rem;
        align-items: stretch;
    }

    .hud-panel {
        position: relative;
        overflow: hidden;
        border-radius: 18px;
        background: linear-gradient(180deg, rgba(9, 28, 42, .68), rgba(5, 16, 25, .92));
        border: 1px solid rgba(98, 227, 255, .22);
        box-shadow: inset 0 0 0 1px rgba(128, 235, 255, .04), 0 14px 34px rgba(0, 0, 0, .3);
    }

    .hud-panel::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(123, 239, 255, .08), transparent 28%);
        pointer-events: none;
    }

    .race-banner-panel {
        display: grid;
        grid-template-columns: 160px minmax(0, 1fr);
        min-height: 290px;
    }

    .race-banner-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        border-right: 1px solid rgba(98, 227, 255, .14);
        background: linear-gradient(180deg, rgba(16, 40, 59, .78), rgba(8, 23, 34, .95));
    }

    .race-banner-icon img {
        width: min(100%, 132px);
        max-height: 132px;
        object-fit: contain;
        filter: drop-shadow(0 12px 20px rgba(0, 0, 0, .35));
    }

    .race-banner-main {
        position: relative;
        min-width: 0;
    }

    .race-banner-main img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .race-banner-overlay {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(3, 12, 18, .3), rgba(3, 12, 18, .02) 40%, rgba(3, 12, 18, .42)),
            linear-gradient(180deg, rgba(132, 236, 255, .08), transparent 35%, rgba(0, 0, 0, .28));
    }

    .race-banner-copy {
        position: absolute;
        left: 1.15rem;
        right: 1.15rem;
        bottom: 1rem;
        display: flex;
        align-items: end;
        justify-content: space-between;
        gap: 1rem;
        z-index: 2;
    }

    .race-banner-copy h2 {
        margin: 0;
        color: #f0fdff;
        font-size: clamp(1.3rem, 2vw, 2rem);
        font-weight: 700;
        text-shadow: 0 0 16px rgba(0, 0, 0, .45);
    }

    .race-banner-copy p {
        margin: .35rem 0 0;
        color: #a6f0ff;
        font-size: .95rem;
        max-width: 700px;
    }

    .race-homeworld-panel {
        display: flex;
        flex-direction: column;
        padding: 1rem;
        text-align: center;
    }

    .race-homeworld-name {
        color: #ffb449;
        font-size: 1.4rem;
        margin-bottom: .2rem;
    }

    .race-homeworld-type {
        color: #ecf9ff;
        font-size: 1.05rem;
        margin-bottom: .85rem;
    }

    .race-homeworld-panel img {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid rgba(93, 225, 255, .18);
        box-shadow: 0 0 28px rgba(0, 170, 255, .16);
        background: rgba(0, 0, 0, .35);
    }

    .race-main-grid {
        display: grid;
        grid-template-columns: minmax(240px, .95fr) minmax(260px, .8fr) minmax(320px, 1.35fr);
        gap: 1rem;
        margin-top: 1rem;
        align-items: stretch;
    }

    .race-panel-title {
        margin: 0 0 .9rem;
        font-size: .88rem;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: #89e8ff;
    }

    .race-info-panel,
    .race-avatar-panel,
    .race-description-panel {
        padding: 1rem;
    }

    .race-info-block+.race-info-block {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(98, 227, 255, .12);
    }

    .race-info-lead {
        color: #fff3d3;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: .8rem;
    }

    .race-bullet-list {
        display: grid;
        gap: .7rem;
    }

    .race-bullet-item {
        display: flex;
        gap: .75rem;
        align-items: start;
        color: #dff8ff;
        line-height: 1.35;
    }

    .race-bullet-item i {
        color: #28d7ff;
        text-shadow: 0 0 10px rgba(40, 215, 255, .4);
    }

    .race-avatar-label {
        color: #d8fcff;
        font-size: .95rem;
        margin-bottom: .7rem;
        font-weight: 600;
    }

    .race-avatar-box {
        overflow: hidden;
        border-radius: 14px;
        border: 1px solid rgba(98, 227, 255, .18);
        background: rgba(4, 14, 24, .85);
        aspect-ratio: 1 / 1;
        box-shadow: inset 0 0 0 1px rgba(145, 240, 255, .04);
    }

    .race-avatar-box img,
    .race-ship-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .race-select-wrap {
        margin-top: 1rem;
        display: flex;
        flex-direction: column;
        gap: .8rem;
    }

    .race-nav-row {
        display: flex;
        gap: .65rem;
        flex-wrap: wrap;
    }

    .race-nav-btn,
    .race-select-btn {
        border-radius: 10px;
        border: 1px solid rgba(98, 227, 255, .22);
        text-decoration: none;
        transition: .2s ease;
    }

    .race-nav-btn {
        padding: .75rem 1rem;
        font-weight: 700;
    }

    .race-select-btn {
        width: 100%;
        padding: 16px 40px;
        font-size: 20px;
        font-weight: 800;
        letter-spacing: .05em;
        text-transform: uppercase;
        color: #e7fdff;
        background: linear-gradient(180deg, rgba(6, 121, 152, .78), rgba(4, 66, 88, .92));
        box-shadow: inset 0 0 0 1px rgba(170, 244, 255, .08), 0 0 18px rgba(0, 200, 255, .18);
    }

    .race-nav-btn:hover,
    .race-select-btn:hover {
        transform: translateY(-1px);
        background: rgba(0, 255, 255, 0.15);
        box-shadow: 0 0 25px rgba(0, 200, 255, 0.5);
        color: #fff;
    }

    .race-description-panel {
        display: grid;
        grid-template-rows: auto auto;
        gap: 1rem;
    }

    .race-ship-box {
        overflow: hidden;
        border-radius: 14px;
        border: 1px solid rgba(98, 227, 255, .14);
        background: radial-gradient(circle at 30% 30%, rgba(0, 170, 255, .08), rgba(2, 8, 16, .92));
        min-height: 215px;
    }

    .race-ship-box img {
        object-fit: contain;
        padding: .5rem;
    }

    .race-lore {
        margin: 0;
        color: #d9f7ff;
        line-height: 1.5;
        white-space: pre-line;
    }

    @media (max-width: 1200px) {
        .race-main-grid {
            grid-template-columns: 1fr 1fr;
        }

        .race-description-panel {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 991.98px) {
        .race-screen {
            padding: 1rem;
        }

        .race-header-grid,
        .race-main-grid {
            grid-template-columns: 1fr;
        }

        .race-banner-panel {
            grid-template-columns: 120px minmax(0, 1fr);
            min-height: 260px;
        }
    }

    @media (max-width: 767.98px) {
        .race-topbar {
            flex-direction: column;
            align-items: stretch;
        }

        .race-frame {
            padding: .8rem;
            border-radius: 18px;
        }

        .race-title {
            font-size: clamp(1.35rem, 6vw, 2rem);
        }

        .race-banner-panel {
            grid-template-columns: 1fr;
            min-height: 340px;
        }

        .race-banner-icon {
            min-height: 120px;
            border-right: 0;
            border-bottom: 1px solid rgba(98, 227, 255, .14);
        }

        .race-banner-copy {
            left: .85rem;
            right: .85rem;
            bottom: .85rem;
            flex-direction: column;
            align-items: start;
        }
    }
</style>
@endpush

@section('content')
<div class="race-screen">
    <div class="race-topbar">
        <a class="race-chip" href="{{ route('newgame.difficulty') }}">← {{ __('ui.common.back') }}</a>

        <div class="btn-group race-lang" role="group" aria-label="Language">
            <a class="btn btn-sm btn-outline-info {{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}">EN</a>
            <a class="btn btn-sm btn-outline-info {{ app()->getLocale() === 'ro' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['lang' => 'ro']) }}">RO</a>
            <a class="btn btn-sm btn-outline-info {{ app()->getLocale() === 'ru' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['lang' => 'ru']) }}">RU</a>
        </div>
    </div>

    <div class="race-frame">
        <h1 class="race-title">{{ $race['name'] ?? 'Race' }}</h1>

        <div class="race-header-grid">
            <section class="hud-panel race-banner-panel">
                <div class="race-banner-icon">
                    <img src="{{ asset($assets['icon']) }}" alt="{{ $race['name'] ?? 'Race' }} icon">
                </div>

                <div class="race-banner-main">
                    <img src="{{ asset($assets['banner']) }}" alt="{{ $race['name'] ?? 'Race' }} banner">
                    <div class="race-banner-overlay"></div>

                    <div class="race-banner-copy">
                        <div>
                            <h2>{{ __('ui.newgame.race.title') }}</h2>
                            <p>{{ $race['lore'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="hud-panel race-homeworld-panel">
                <div class="race-panel-title">{{ __('ui.newgame.race.homeworld') }}</div>
                <div class="race-homeworld-name">{{ $raceDetails['homeworld']['name'] }}</div>
                <div class="race-homeworld-type">{{ $raceDetails['homeworld']['type'] }}</div>
                <img src="{{ asset($assets['planet']) }}" alt="{{ $race['name'] ?? 'Race' }} planet">
            </section>
        </div>

        <div class="race-main-grid">
            <section class="hud-panel race-info-panel">
                <div class="race-info-block">
                    <h3 class="race-panel-title">{{ __('ui.newgame.race.government') }}</h3>
                    <div class="race-info-lead">{{ $raceDetails['government']['title'] }}</div>

                    <div class="race-bullet-list">
                        @foreach($raceDetails['government']['ethics'] as $ethic)
                        <div class="race-bullet-item">
                            <i class="bi bi-stars"></i>
                            <span>{{ $ethic }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="race-info-block">
                    <h3 class="race-panel-title">{{ __('ui.newgame.race.traits') }}</h3>

                    <div class="race-bullet-list">
                        @foreach($raceDetails['traits'] as $trait)
                        <div class="race-bullet-item">
                            <i class="bi bi-hexagon-fill"></i>
                            <span>{{ $trait }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="hud-panel race-avatar-panel">
                <div class="race-avatar-label">{{ __('ui.newgame.race.avatar') }}</div>

                <div class="race-avatar-box">
                    <img src="{{ asset($assets['avatar']) }}" alt="{{ $race['name'] ?? 'Race' }} avatar">
                </div>

                <div class="race-select-wrap">
                    <div class="race-nav-row">
                        <a class="race-nav-btn" href="{{ request()->fullUrlWithQuery(['i' => $prevIndex]) }}">← {{ __('ui.common.back') }}</a>
                        <a class="race-nav-btn" href="{{ request()->fullUrlWithQuery(['i' => $nextIndex]) }}">{{ __('ui.common.next') }} →</a>
                    </div>

                    <form method="POST" action="{{ route('newgame.race.store') }}">
                        @csrf
                        <input type="hidden" name="race_key" value="{{ $raceKey }}">
                        <button class="race-select-btn" type="submit">{{ __('ui.common.select') }}</button>
                    </form>
                </div>
            </section>

            <section class="hud-panel race-description-panel">
                <div>
                    <h3 class="race-panel-title">{{ __('ui.newgame.race.ship') }}</h3>
                    <div class="race-ship-box">
                        <img src="{{ asset($assets['ship']) }}" alt="{{ $race['name'] ?? 'Race' }} ship">
                    </div>
                </div>

                <div>
                    <h3 class="race-panel-title">{{ __('ui.newgame.race.description') }}</h3>
                    <p class="race-lore">{{ $assets['history'] ?? '' }}</p>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection