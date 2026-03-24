@extends('layouts.game')

@section('title', 'Choose Difficulty')

@php
$hideGameNav = true;

$difficultyCards = [
'easy' => [
'name' => 'Easy',
'eyebrow' => 'First Deployment',
'description' => 'A gentle starting point for players entering Astral Empires for the first time.',
'summary' => 'Best for learning exploration, expansion, claims, and planet management without constant pressure.',
'skulls' => 1,
'parameters' => [
'Enemy empires expand slower and react less aggressively.',
'Your economy stabilizes faster in the early game.',
'Early mistakes are easier to recover from.',
],
],
'normal' => [
'name' => 'Normal',
'eyebrow' => 'Core Experience',
'description' => 'The standard balance intended as the default campaign experience.',
'summary' => 'A balanced match between growth, threat, diplomacy, and decision pressure.',
'skulls' => 2,
'parameters' => [
'Enemy empires use the intended default progression.',
'Economic pressure and expansion competition stay balanced.',
'Recommended for most players.',
],
],
'hard' => [
'name' => 'Hard',
'eyebrow' => 'Trial by Void',
'description' => 'Designed for players who want to test their planning, tempo, and strategic discipline.',
'summary' => 'Hostile empires capitalize on openings faster and poor decisions are much more punishing.',
'skulls' => 3,
'parameters' => [
'Enemies are more aggressive and reach power spikes sooner.',
'Territorial competition becomes harsher.',
'Optimization matters from the opening turns.',
],
],
];

$defaultDifficulty = old('difficulty', 'normal');

if (!array_key_exists($defaultDifficulty, $difficultyCards)) {
$defaultDifficulty = 'normal';
}
@endphp

@push('head')
<style>
    .difficulty-scene {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        isolation: isolate;
        background: linear-gradient(180deg, rgba(4, 8, 16, .12), rgba(4, 8, 16, .76)),
        url("{{ asset('assets/img_model_main/main_menu/mainMenu1.jpg') }}") center center / cover no-repeat fixed;
    }

    .difficulty-scene::before,
    .difficulty-scene::after {
        content: '';
        position: fixed;
        inset: 0;
        pointer-events: none;
    }

    .difficulty-scene::before {
        background:
            radial-gradient(circle at 18% 20%, rgba(112, 201, 255, .16), transparent 24%),
            radial-gradient(circle at 84% 26%, rgba(255, 193, 119, .10), transparent 22%),
            linear-gradient(180deg, rgba(4, 10, 18, .24), rgba(3, 5, 11, .84));
        z-index: 1;
    }

    .difficulty-scene::after {
        background-image:
            linear-gradient(rgba(255, 255, 255, .026) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, .02) 1px, transparent 1px);
        background-size: 64px 64px;
        mask-image: linear-gradient(180deg, transparent 0%, #000 20%, #000 84%, transparent 100%);
        opacity: .28;
        z-index: 2;
    }

    .difficulty-shell {
        position: relative;
        z-index: 3;
        min-height: 100vh;
        padding: clamp(22px, 3vw, 42px);
        display: grid;
        grid-template-columns: minmax(360px, 1.1fr) minmax(260px, .72fr);
        gap: clamp(20px, 2vw, 30px);
        align-items: stretch;
    }

    .difficulty-copy,
    .difficulty-nav {
        opacity: 0;
        transform: translateY(22px);
        transition: opacity .85s ease, transform .85s ease;
    }

    .difficulty-scene.is-ready .difficulty-copy,
    .difficulty-scene.is-ready .difficulty-nav {
        opacity: 1;
        transform: translateY(0);
    }

    .difficulty-copy {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-width: 0;
    }

    .difficulty-header {
        max-width: min(820px, 100%);
    }

    .difficulty-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 8px 14px;
        border-radius: 999px;
        border: 1px solid rgba(144, 206, 255, .24);
        background: rgba(5, 12, 24, .34);
        backdrop-filter: blur(14px);
        font-size: .76rem;
        font-weight: 700;
        letter-spacing: .20em;
        text-transform: uppercase;
        color: #8fd7ff;
    }

    .difficulty-eyebrow::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #90d9ff;
        box-shadow: 0 0 18px rgba(144, 217, 255, .78);
    }

    .difficulty-heading {
        margin: 18px 0 14px;
        font-size: clamp(2.6rem, 5.2vw, 5rem);
        font-weight: 800;
        letter-spacing: .14em;
        line-height: .92;
        text-transform: uppercase;
        text-shadow: 0 0 36px rgba(59, 170, 255, .18);
        color: #f6fbff;

    }

    .difficulty-lead {
        max-width: 720px;
        margin: 0;
        color: rgba(236, 244, 255, .74);
        font-size: clamp(1rem, 1.28vw, 1.14rem);
        line-height: 1.78;
    }

    .difficulty-panel {
        margin-top: 26px;
        max-width: min(780px, 100%);
        padding: clamp(22px, 2.3vw, 30px);
        border-radius: 30px;
        background: linear-gradient(180deg, rgba(255, 255, 255, .048), rgba(255, 255, 255, .02)), rgba(5, 11, 22, .54);
        border: 1px solid rgba(150, 216, 255, .16);
        backdrop-filter: blur(18px);
        box-shadow: 0 24px 80px rgba(0, 0, 0, .34);
    }

    .difficulty-panel-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 18px;
    }

    .difficulty-selected-eyebrow {
        color: #8fd7ff;
        font-size: .76rem;
        font-weight: 700;
        letter-spacing: .18em;
        text-transform: uppercase;
    }


    .difficulty-selected-name {
        margin: 10px 0 8px;
        font-size: clamp(1.85rem, 3vw, 2.5rem);
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #f6fbff;
    }

    .difficulty-selected-description,
    .difficulty-selected-summary,
    .difficulty-note {
        color: rgba(232, 241, 255, .76);
        line-height: 1.72;
    }

    .difficulty-skulls {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        min-width: 122px;
        justify-content: center;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, .08);
        background: rgba(255, 255, 255, .04);
    }

    .difficulty-skull {
        font-size: 1.16rem;
        opacity: .22;
        transition: opacity .22s ease, transform .22s ease, text-shadow .22s ease;
    }

    .difficulty-skull.is-active {
        opacity: 1;
        transform: translateY(-1px);
        text-shadow: 0 0 14px rgba(255, 208, 124, .48);
    }

    .difficulty-meta-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        margin-top: 22px;
    }

    .difficulty-meta-card {
        padding: 16px 18px;
        border-radius: 20px;
        background: rgba(255, 255, 255, .035);
        border: 1px solid rgba(255, 255, 255, .07);
    }

    .difficulty-meta-title {
        color: #ffd694;
        font-size: .78rem;
        font-weight: 800;
        letter-spacing: .16em;
        text-transform: uppercase;
    }

    .difficulty-meta-card ul {
        margin: 12px 0 0;
        padding-left: 18px;
        color: rgba(228, 238, 255, .82);
    }

    .difficulty-meta-card li+li {
        margin-top: 10px;
    }

    .difficulty-confirm {
        margin-top: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
    }

    .difficulty-submit {
        min-width: 268px;
        padding: 15px 24px;
        border-radius: 18px;
        border: 1px solid rgba(143, 215, 255, .34);
        background: linear-gradient(180deg, rgba(120, 205, 255, .16), rgba(255, 255, 255, .04));
        color: #f6fbff;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
        transition: transform .24s ease, box-shadow .24s ease, border-color .24s ease, background .24s ease;
    }

    .difficulty-submit:hover,
    .difficulty-submit:focus-visible {
        transform: translateY(-2px);
        border-color: rgba(143, 215, 255, .58);
        box-shadow: 0 20px 46px rgba(0, 0, 0, .30), 0 0 24px rgba(96, 186, 255, .14);
        outline: none;
    }

    .difficulty-nav {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .difficulty-nav-panel {
        width: min(360px, 100%);
        padding: 20px;
        border-radius: 30px;
        background: linear-gradient(180deg, rgba(255, 255, 255, .05), rgba(255, 255, 255, .02)), rgba(4, 10, 22, .54);
        border: 1px solid rgba(150, 216, 255, .14);
        backdrop-filter: blur(18px);
        box-shadow: 0 24px 80px rgba(0, 0, 0, .34);
    }

    .difficulty-nav-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 16px;
    }

    .difficulty-back,
    .difficulty-lang a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        min-height: 44px;
        padding: 0 14px;
        border-radius: 14px;
        border: 1px solid rgba(143, 215, 255, .16);
        background: rgba(255, 255, 255, .03);
        color: #eef8ff;
        text-decoration: none;
        transition: transform .2s ease, border-color .2s ease, background .2s ease, box-shadow .2s ease;
    }

    .difficulty-back:hover,
    .difficulty-lang a:hover,
    .difficulty-lang a.active {
        transform: translateY(-1px);
        border-color: rgba(143, 215, 255, .4);
        background: rgba(96, 187, 255, .10);
        box-shadow: 0 0 18px rgba(97, 188, 255, .16);
    }

    .difficulty-lang {
        display: inline-flex;
        gap: 8px;
    }

    .difficulty-nav-title {
        color: rgba(232, 241, 255, .62);
        font-size: .76rem;
        font-weight: 800;
        letter-spacing: .18em;
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    .difficulty-option {
        position: relative;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
        padding: 18px 18px 16px;
        border-radius: 22px;
        border: 1px solid rgba(163, 219, 255, .14);
        background: rgba(255, 255, 255, .03);
        color: #f1f7ff;
        text-align: left;
        transition: transform .26s ease, border-color .26s ease, background .26s ease, box-shadow .26s ease;
        box-shadow: 0 18px 40px rgba(0, 0, 0, .20);
    }

    .difficulty-option+.difficulty-option {
        margin-top: 12px;
    }

    .difficulty-option::after {
        content: '';
        position: absolute;
        inset: 1px;
        border-radius: inherit;
        border: 1px solid rgba(255, 255, 255, .04);
        pointer-events: none;
    }

    .difficulty-option:hover,
    .difficulty-option:focus-visible,
    .difficulty-option.is-active {
        transform: translateX(-4px);
        border-color: rgba(144, 217, 255, .34);
        background: rgba(95, 174, 255, .08);
        box-shadow: 0 22px 48px rgba(0, 0, 0, .26), 0 0 24px rgba(96, 186, 255, .12);
        outline: none;
    }

    .difficulty-option--easy.is-active {
        border-color: rgba(118, 255, 173, .34);
        background: rgba(40, 162, 98, .10);
    }

    .difficulty-option--hard.is-active {
        border-color: rgba(255, 139, 139, .34);
        background: rgba(160, 54, 54, .12);
    }

    .difficulty-option-eyebrow {
        color: rgba(232, 241, 255, .56);
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .18em;
        text-transform: uppercase;
    }

    .difficulty-option-name {
        font-size: 1.08rem;
        font-weight: 800;
        letter-spacing: .10em;
        text-transform: uppercase;
    }

    .difficulty-option-copy {
        color: rgba(232, 241, 255, .72);
        font-size: .92rem;
        line-height: 1.65;
    }

    @media (max-width: 1080px) {
        .difficulty-shell {
            grid-template-columns: 1fr;
        }

        .difficulty-nav {
            justify-content: stretch;
        }

        .difficulty-nav-panel,
        .difficulty-panel {
            width: 100%;
            max-width: none;
        }
    }

    @media (max-width: 720px) {
        .difficulty-shell {
            padding: 18px;
        }

        .difficulty-panel-top,
        .difficulty-confirm {
            flex-direction: column;
            align-items: flex-start;
        }

        .difficulty-meta-grid {
            grid-template-columns: 1fr;
        }

        .difficulty-submit {
            width: 100%;
            min-width: 0;
        }
    }
</style>
@endpush

@section('content')
<div class="difficulty-scene" data-difficulty-scene>
    <form method="POST" action="{{ route('newgame.difficulty.store') }}" class="difficulty-shell" data-difficulty-form>
        @csrf
        <input type="hidden" name="difficulty" value="{{ $defaultDifficulty }}" data-difficulty-input>

        <section class="difficulty-copy">
            <div>
                <div class="difficulty-header">
                    <span class="difficulty-eyebrow">Campaign Setup</span>
                    <h1 class="difficulty-heading">Choose Difficulty</h1>
                    <p class="difficulty-lead">Set the tone of the campaign before creating your empire. The selected difficulty changes AI pressure, economic pacing, and the overall demand for precision. Once confirmed, difficulty cannot be changed later in the run.</p>
                </div>

                <div class="difficulty-panel">
                    <div class="difficulty-panel-top">
                        <div>
                            <div class="difficulty-selected-eyebrow" data-selected-eyebrow>{{ $difficultyCards[$defaultDifficulty]['eyebrow'] }}</div>
                            <div class="difficulty-selected-name" data-selected-name>{{ $difficultyCards[$defaultDifficulty]['name'] }}</div>
                            <p class="difficulty-selected-description mb-0" data-selected-description>{{ $difficultyCards[$defaultDifficulty]['description'] }}</p>
                        </div>
                        <div class="difficulty-skulls" aria-label="Difficulty threat level">
                            @for ($i = 1; $i <= 3; $i++)
                                <span class="difficulty-skull {{ $i <= $difficultyCards[$defaultDifficulty]['skulls'] ? 'is-active' : '' }}" data-skull="{{ $i }}">☠</span>
                                @endfor
                        </div>
                    </div>

                    <div class="difficulty-meta-grid">
                        <div class="difficulty-meta-card">
                            <div class="difficulty-meta-title">Overview</div>
                            <p class="difficulty-selected-summary mb-0 mt-3" data-selected-summary>{{ $difficultyCards[$defaultDifficulty]['summary'] }}</p>
                        </div>

                        <div class="difficulty-meta-card">
                            <div class="difficulty-meta-title">Parameters</div>
                            <ul class="mb-0" data-selected-parameters>
                                @foreach ($difficultyCards[$defaultDifficulty]['parameters'] as $parameter)
                                <li>{{ $parameter }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="difficulty-confirm">
                        <p class="difficulty-note mb-0">Confirm your choice and continue to empire setup. This selection is locked for the current campaign.</p>
                        <button type="submit" class="difficulty-submit">Confirm and Continue</button>
                    </div>
                </div>
            </div>
        </section>

        <aside class="difficulty-nav">
            <div class="difficulty-nav-panel">
                <div class="difficulty-nav-head">
                    <a class="difficulty-back" href="{{ route('menu') }}" data-page-link>←</a>
                    <div class="difficulty-lang" role="group" aria-label="Language">
                        <a href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}" data-page-link>EN</a>
                        <a href="{{ request()->fullUrlWithQuery(['lang' => 'ro']) }}" class="{{ app()->getLocale() === 'ro' ? 'active' : '' }}" data-page-link>RO</a>
                        <a href="{{ request()->fullUrlWithQuery(['lang' => 'ru']) }}" class="{{ app()->getLocale() === 'ru' ? 'active' : '' }}" data-page-link>RU</a>
                    </div>
                </div>

                <div class="difficulty-nav-title">Difficulty Selection</div>

                @foreach ($difficultyCards as $key => $card)
                <button
                    type="button"
                    class="difficulty-option difficulty-option--{{ $key }} {{ $key === $defaultDifficulty ? 'is-active' : '' }}"
                    data-difficulty-option="{{ $key }}"
                    data-eyebrow="{{ $card['eyebrow'] }}"
                    data-name="{{ $card['name'] }}"
                    data-description="{{ $card['description'] }}"
                    data-summary="{{ $card['summary'] }}"
                    data-skulls="{{ $card['skulls'] }}"
                    data-parameters='@json($card["parameters"])'>
                    <span class="difficulty-option-eyebrow">{{ $card['eyebrow'] }}</span>
                    <span class="difficulty-option-name">{{ $card['name'] }}</span>
                    <span class="difficulty-option-copy">{{ $card['description'] }}</span>
                </button>
                @endforeach
            </div>
        </aside>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const scene = document.querySelector('[data-difficulty-scene]');
        const difficultyInput = document.querySelector('[data-difficulty-input]');
        const optionButtons = Array.from(document.querySelectorAll('[data-difficulty-option]'));
        const eyebrow = document.querySelector('[data-selected-eyebrow]');
        const name = document.querySelector('[data-selected-name]');
        const description = document.querySelector('[data-selected-description]');
        const summary = document.querySelector('[data-selected-summary]');
        const parameters = document.querySelector('[data-selected-parameters]');
        const skulls = Array.from(document.querySelectorAll('[data-skull]'));

        requestAnimationFrame(() => scene?.classList.add('is-ready'));

        const applyDifficulty = (button) => {
            if (!button) return;

            optionButtons.forEach((item) => item.classList.toggle('is-active', item === button));
            difficultyInput.value = button.dataset.difficultyOption || 'normal';
            eyebrow.textContent = button.dataset.eyebrow || '';
            name.textContent = button.dataset.name || '';
            description.textContent = button.dataset.description || '';
            summary.textContent = button.dataset.summary || '';

            const parameterItems = JSON.parse(button.dataset.parameters || '[]');
            parameters.innerHTML = parameterItems.map((item) => `<li>${item}</li>`).join('');

            const level = Number(button.dataset.skulls || 0);
            skulls.forEach((skull) => {
                skull.classList.toggle('is-active', Number(skull.dataset.skull) <= level);
            });
        };

        optionButtons.forEach((button) => {
            button.addEventListener('click', () => applyDifficulty(button));
        });

        applyDifficulty(document.querySelector('[data-difficulty-option].is-active') || optionButtons[0]);
    });
</script>
@endpush