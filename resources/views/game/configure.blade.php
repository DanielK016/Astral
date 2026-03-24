@extends('layouts.game')

@php
    $iconMap = [
        'econ_boost' => 'assets/img_model_main/configure/icon_1.png',
        'science_boost' => 'assets/img_model_main/configure/icon_2.png',
        'unity_boost' => 'assets/img_model_main/configure/icon_3.png',
        'influence_boost' => 'assets/img_model_main/configure/icon_4.png',
        'growth_boost' => 'assets/img_model_main/configure/icon_5.png',
        'deep_scan' => 'assets/img_model_main/configure/icon_6.png',
        'emergency_power' => 'assets/img_model_main/configure/icon_7.png',
        'war_protocol' => 'assets/img_model_main/configure/icon_8.png',
    ];
@endphp

@push('head')
<style>
    .game-root {
        background:
            linear-gradient(180deg, rgba(2, 8, 20, .45), rgba(2, 8, 20, .9)),
            radial-gradient(1200px 800px at 50% 10%, rgba(0, 165, 255, .18), transparent 58%),
            url('{{ asset('assets/img_model_main/configure/img_fon/fon.png') }}') center / cover no-repeat fixed;
    }

    .configure-page {
        min-height: calc(100vh - 72px);
        display: flex;
        align-items: center;
        padding: 1.5rem 0;
    }

    .configure-card {
        backdrop-filter: blur(14px);
        background: rgba(1, 9, 20, .52);
        border: 1px solid rgba(103, 227, 255, .18);
        border-radius: 1.25rem;
        box-shadow: 0 20px 44px rgba(0,0,0,.28);
        height: 100%;
    }

    .bonus-row {
        display: flex;
        align-items: flex-start;
        gap: .75rem;
    }

    .bonus-icon {
        width: 40px;
        height: 40px;
        object-fit: contain;
        flex: 0 0 40px;
        border-radius: .65rem;
        filter: drop-shadow(0 8px 15px rgba(0,0,0,.35));
    }

    .bonus-text {
        line-height: 1.25;
    }

    .form-check-input {
        margin-top: .45rem;
    }
</style>
@endpush

@section('content')
<div class="configure-page">
    <div class="container">
        <div class="glass rounded-4 p-4 p-md-5">
            <h2 class="text-info neon mb-4">{{ __('ui.newgame.configure.title') }}</h2>

            <form method="POST" action="{{ route('newgame.configure.store') }}">
                @csrf

                <div class="row g-4">
                    <div class="col-12 col-lg-6">
                        <div class="configure-card p-3 p-md-4">
                            <h5 class="text-warning mb-3">{{ __('ui.newgame.configure.passives') }}</h5>

                            @foreach($passives as $p)
                                @php $icon = $iconMap[$p['key']] ?? null; @endphp
                                <div class="form-check text-light mb-3">
                                    <div class="bonus-row">
                                        <input class="form-check-input" type="checkbox" name="passives[]" value="{{ $p['key'] }}" id="p_{{ $p['key'] }}" {{ in_array($p['key'], $selectedPassives) ? 'checked' : '' }}>
                                        <label class="form-check-label d-flex align-items-start gap-3 flex-grow-1" for="p_{{ $p['key'] }}">
                                            @if($icon)
                                                <img src="{{ asset($icon) }}" class="bonus-icon" alt="{{ $p['name'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $p['name'] }}">
                                            @endif
                                            <div class="bonus-text">
                                                <span class="fw-bold">{{ $p['name'] }}</span>
                                                <span class="text-secondary small">— {{ $p['desc'] }}</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            @endforeach

                            <div class="text-secondary small mt-2">Choose up to 2.</div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="configure-card p-3 p-md-4">
                            <h5 class="text-warning mb-3">{{ __('ui.newgame.configure.actives') }}</h5>

                            @foreach($actives as $a)
                                @php $icon = $iconMap[$a['key']] ?? null; @endphp
                                <div class="form-check text-light mb-3">
                                    <div class="bonus-row">
                                        <input class="form-check-input" type="radio" name="active" value="{{ $a['key'] }}" id="a_{{ $a['key'] }}" {{ $selectedActive === $a['key'] ? 'checked' : '' }}>
                                        <label class="form-check-label d-flex align-items-start gap-3 flex-grow-1" for="a_{{ $a['key'] }}">
                                            @if($icon)
                                                <img src="{{ asset($icon) }}" class="bonus-icon" alt="{{ $a['name'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $a['name'] }}">
                                            @endif
                                            <div class="bonus-text">
                                                <span class="fw-bold">{{ $a['name'] }}</span>
                                                <span class="text-secondary small">— {{ $a['desc'] }}</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            @endforeach

                            <div class="text-secondary small mt-2">Choose 1.</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="configure-card p-3 p-md-4">
                            <h5 class="text-warning mb-3">{{ __('ui.newgame.configure.galaxy') }}</h5>

                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label text-light">{{ __('ui.newgame.configure.size') }}</label>
                                    <select class="form-select bg-dark text-light border border-info border-opacity-25" name="galaxy_size">
                                        @foreach(['small'=>'Small','medium'=>'Medium','large'=>'Large'] as $k=>$v)
                                            <option value="{{ $k }}" {{ $galaxySize===$k?'selected':'' }}>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label text-light">{{ __('ui.newgame.configure.ai') }}</label>
                                    <select class="form-select bg-dark text-light border border-info border-opacity-25" name="ai_count">
                                        @for($i=1;$i<=3;$i++)
                                            <option value="{{ $i }}" {{ (int)$aiCount===$i?'selected':'' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a class="btn btn-outline-light" href="{{ route('newgame.race') }}">← {{ __('ui.common.back') }}</a>
                    <button class="btn btn-outline-info btn-neon ms-auto">{{ __('ui.menu.continue') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
