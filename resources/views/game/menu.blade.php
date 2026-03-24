@extends('layouts.base')

@push('head')
<style>
    html,
    body {
        min-height: 100%;
        margin: 0;
        overflow: hidden;
        background: #03060d;
    }

    body.menu-entering {
        overflow: hidden;
    }

    .menu-scene {
        position: relative;
        min-height: 100vh;
        isolation: isolate;
        background: #03060d;
        color: #f4f7fb;
    }

    .menu-bg {
        position: fixed;
        inset: 0;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        opacity: 0;
        transform: scale(1.00);
        transition: opacity 1.4s ease, transform 1.4s ease;
        will-change: opacity;
    }

    .menu-bg.is-active {
        opacity: 1;
        transform: scale(1);
    }

    .menu-scene.is-ready .menu-bg.is-active {
        animation: menuBackgroundFloat 22s ease-in-out infinite alternate;
    }

    .menu-vignette,
    .menu-grid,
    .menu-noise,
    .menu-transition {
        position: fixed;
        inset: 0;
        pointer-events: none;
    }

    .menu-vignette {
        background:
            radial-gradient(circle at 18% 18%, rgba(94, 184, 255, .18), transparent 28%),
            radial-gradient(circle at 82% 24%, rgba(255, 184, 84, .10), transparent 24%),
            linear-gradient(180deg, rgba(4, 8, 16, .18) 0%, rgba(4, 8, 16, .44) 42%, rgba(2, 4, 10, .9) 100%),
            radial-gradient(circle at 50% 50%, transparent 48%, rgba(0, 0, 0, .46) 100%);
        z-index: 1;
    }

    .menu-grid {
        background:
            linear-gradient(rgba(255, 255, 255, .035) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, .03) 1px, transparent 1px);
        background-size: 64px 64px;
        mask-image: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, .7) 24%, #000 65%, transparent 100%);
        opacity: .24;
        z-index: 2;
    }

    .menu-noise {
        background-image:
            radial-gradient(rgba(255, 255, 255, .06) .6px, transparent .6px),
            radial-gradient(rgba(255, 255, 255, .025) .5px, transparent .5px);
        background-position: 0 0, 14px 18px;
        background-size: 26px 26px, 32px 32px;
        mix-blend-mode: soft-light;
        opacity: .16;
        z-index: 3;
    }

    .menu-shell {
        position: relative;
        z-index: 4;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        padding: clamp(24px, 3.6vw, 48px);
        opacity: 0;
        transform: translateY(24px);
        transition: opacity .8s ease .15s, transform .8s ease .15s;
    }

    .menu-scene.is-ready .menu-shell {
        opacity: 1;
        transform: translateY(0);
    }

    .menu-topbar {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
    }

    .menu-brand {
        max-width: min(720px, 100%);
    }

    .menu-brand__eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 8px 14px;
        border: 1px solid rgba(144, 206, 255, .28);
        border-radius: 999px;
        background: rgba(5, 12, 24, .34);
        backdrop-filter: blur(12px);
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .22em;
        text-transform: uppercase;
        color: #8fd7ff;
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .03);
    }

    .menu-brand__eyebrow::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #90d9ff;
        box-shadow: 0 0 18px rgba(144, 217, 255, .8);
    }

    .menu-brand__title {
        margin: 18px 0 0;
        font-size: clamp(3rem, 8vw, 6.4rem);
        font-weight: 800;
        letter-spacing: .18em;
        line-height: .92;
        text-transform: uppercase;
        text-shadow: 0 0 40px rgba(59, 170, 255, .18);
    }

    .menu-brand__subtitle {
        margin: 16px 0 0;
        max-width: 680px;
        font-size: clamp(.98rem, 1.45vw, 1.18rem);
        color: rgba(236, 244, 255, .72);
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    .menu-locale {
        min-width: 174px;
        padding: 14px;
        border: 1px solid rgba(151, 214, 255, .18);
        border-radius: 20px;
        background: rgba(4, 10, 22, .38);
        backdrop-filter: blur(16px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, .22);
    }

    .menu-locale__label {
        margin-bottom: 10px;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .16em;
        text-transform: uppercase;
        color: rgba(218, 232, 255, .62);
    }

    .menu-locale .btn-group {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
    }

    .menu-locale .btn {
        border-radius: 14px;
        border-color: rgba(143, 215, 255, .24);
        background: rgba(255, 255, 255, .10);
        color: #d7e6ff;
        font-weight: 700;
        letter-spacing: .08em;
        padding-block: .55rem;
    }

    .menu-locale .btn:hover,
    .menu-locale .btn.active {
        border-color: rgba(143, 215, 255, .62);
        background: rgba(96, 187, 255, .12);
        color: #f4fbff;
        box-shadow: 0 0 18px rgba(97, 188, 255, .16);
    }

    .menu-spacer {
        flex: 1 1 auto;
        min-height: 120px;
    }

    .menu-actions {
        display: grid;
        grid-template-columns: repeat(4, minmax(180px, 1fr));
        gap: 16px;
        align-items: stretch;
    }

    .menu-tile {
        position: relative;
        overflow: hidden;
        min-height: 172px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 18px;
        padding: 22px;
        border: 1px solid rgba(163, 219, 255, 0.15);
        border-radius: 26px;
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(1px);
        text-decoration: none;
        color: inherit;
        cursor: pointer;
        transition:
            transform .28s ease,
            border-color .28s ease,
            box-shadow .28s ease,
            background .28s ease;
        box-shadow: 0 22px 46px rgba(0, 0, 0, .26);
    }

    .menu-tile::before,
    .menu-tile::after {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
        transition: opacity .28s ease, transform .4s ease;
    }

    .menu-tile::before {
        background:
            linear-gradient(120deg, transparent 0%, rgba(255, 255, 255, .14) 48%, transparent 100%);
        transform: translateX(-135%);
        opacity: 0;
    }

    .menu-tile::after {
        border: 1px solid rgba(255, 255, 255, .04);
        border-radius: inherit;
        inset: 1px;
    }

    .menu-tile:hover,
    .menu-tile:focus-visible {
        transform: translateY(-5px);
        border-color: rgba(163, 219, 255, 0.5);
        background: rgba(163, 219, 255, 0.1);
        box-shadow: 0 28px 68px rgba(0, 0, 0, .42), 0 0 0 1px rgba(159, 224, 255, .08), 0 0 30px rgba(83, 177, 255, .16);
        outline: none;
    }

    .menu-tile:hover::before,
    .menu-tile:focus-visible::before {
        opacity: 1;
        transform: translateX(135%);
    }

    .menu-tile__icon {
        width: 54px;
        height: 54px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        border: 1px solid rgba(163, 219, 255, .18);
        background: rgba(255, 255, 255, .045);
        font-size: 1.35rem;
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .04);
        transition: transform .28s ease, border-color .28s ease, background .28s ease;
    }

    .menu-tile:hover .menu-tile__icon,
    .menu-tile:focus-visible .menu-tile__icon {
        transform: translateY(-4px) scale(1.04);
        border-color: rgba(159, 224, 255, .42);
        background: rgba(105, 196, 255, .10);
    }

    .menu-tile__body {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .menu-tile__title {
        font-size: 1rem;
        font-weight: 800;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: #f7fbff;
    }

    .menu-tile__meta {
        font-size: .78rem;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: rgba(225, 236, 255, .62);
    }

    .menu-tile--primary {
        border-color: rgba(133, 209, 255, .34);
        background:
            linear-gradient(180deg, rgba(111, 198, 255, .18) 0%, rgba(255, 255, 255, .04) 100%),
            linear-gradient(135deg, rgba(10, 18, 34, .82), rgba(6, 11, 23, .52));
    }

    .menu-tile--warning {
        border-color: rgba(255, 198, 100, .24);
    }

    .menu-footer {
        margin-top: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        color: rgba(220, 231, 248, .48);
        font-size: .78rem;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .menu-footer__line {
        flex: 1 1 auto;
        height: 1px;
        background: linear-gradient(90deg, rgba(255, 255, 255, .18), transparent);
    }

    .menu-transition {
        z-index: 7;
        opacity: 0;
        background:
            linear-gradient(180deg, rgba(4, 7, 14, 0) 0%, rgba(4, 7, 14, .38) 56%, rgba(4, 7, 14, .94) 100%),
            radial-gradient(circle at 50% 130%, rgba(114, 203, 255, .30), transparent 40%);
        transition: opacity .38s ease;
    }

    .menu-transition::before,
    .menu-transition::after {
        content: '';
        position: absolute;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(154, 228, 255, .9), transparent);
        box-shadow: 0 0 18px rgba(154, 228, 255, .75);
        opacity: 0;
    }

    .menu-transition::before {
        top: 34%;
    }

    .menu-transition::after {
        top: 66%;
    }

    body.menu-leaving .menu-transition {
        opacity: 1;
    }

    body.menu-leaving .menu-transition::before,
    body.menu-leaving .menu-transition::after {
        animation: menuScanLine .72s ease forwards;
    }

    body.menu-leaving .menu-shell {
        opacity: 0;
        transform: translateY(10px) scale(.985);
        transition-delay: 0s;
    }

    body.menu-leaving .menu-bg.is-active {
        opacity: 0;
        transform: scale(1.00);
        transition-duration: .72s;
    }

    @keyframes menuBackgroundFloat {
        0% {
            transform: scale(1);
        }

        100% {
            transform: scale(1);
        }
    }

    @keyframes menuScanLine {
        0% {
            opacity: 0;
            transform: translateY(80px);
        }

        18% {
            opacity: 1;
        }

        100% {
            opacity: 0;
            transform: translateY(-80px);
        }
    }

    @media (max-width: 1199.98px) {
        .menu-actions {
            grid-template-columns: repeat(2, minmax(220px, 1fr));
        }
    }

    @media (max-width: 767.98px) {

        html,
        body {
            overflow: auto;
        }

        .menu-shell {
            padding: 22px 16px 24px;
        }

        .menu-topbar {
            flex-direction: column;
            align-items: stretch;
        }

        .menu-locale {
            width: 100%;
            min-width: 0;
        }

        .menu-spacer {
            min-height: 42px;
        }

        .menu-actions {
            grid-template-columns: 1fr;
        }

        .menu-tile {
            min-height: 138px;
        }

        .menu-footer {
            flex-wrap: wrap;
        }
    }
</style>
@endpush

@section('body')
<div class="menu-scene menu-entering" id="menuScene">
    <div class="menu-bg" id="menuBgPrimary" aria-hidden="true"></div>
    <div class="menu-bg" id="menuBgSecondary" aria-hidden="true"></div>
    <div class="menu-vignette" aria-hidden="true"></div>
    <div class="menu-grid" aria-hidden="true"></div>
    <div class="menu-noise" aria-hidden="true"></div>
    <div class="menu-transition" id="menuTransition" aria-hidden="true"></div>

    <div class="menu-shell">
        <div class="menu-topbar">
            <div class="menu-brand">
                <div class="menu-brand__eyebrow">Astral Command</div>
                <h1 class="menu-brand__title">{{ __('ui.menu.title') }}</h1>
                <p class="menu-brand__subtitle">Strategic turn-based space campaign interface</p>
            </div>

            <div class="menu-locale">
                <div class="menu-locale__label">{{ __('ui.common.language') }}</div>
                <div class="btn-group" role="group" aria-label="Language selection">
                    <a class="btn btn-sm {{ app()->getLocale()==='en' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}">EN</a>
                    <a class="btn btn-sm {{ app()->getLocale()==='ro' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['lang' => 'ro']) }}">RO</a>
                    <a class="btn btn-sm {{ app()->getLocale()==='ru' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['lang' => 'ru']) }}">RU</a>
                </div>
            </div>
        </div>

        <div class="menu-spacer"></div>

        <nav class="menu-actions" aria-label="Main navigation">
            <a href="{{ route('newgame.difficulty') }}" class="menu-tile menu-tile--primary" data-menu-link>
                <span class="menu-tile__icon"><i class="bi bi-stars"></i></span>
                <span class="menu-tile__body">
                    <span class="menu-tile__title">{{ __('ui.menu.new_game') }}</span>
                    <span class="menu-tile__meta">Start a new campaign</span>
                </span>
            </a>

            <a href="{{ route('continue') }}" class="menu-tile" data-menu-link>
                <span class="menu-tile__icon"><i class="bi bi-play-circle"></i></span>
                <span class="menu-tile__body">
                    <span class="menu-tile__title">{{ __('ui.menu.continue') }}</span>
                    <span class="menu-tile__meta">Resume an existing session</span>
                </span>
            </a>

            <a href="{{ route('settings') }}" class="menu-tile" data-menu-link>
                <span class="menu-tile__icon"><i class="bi bi-sliders"></i></span>
                <span class="menu-tile__body">
                    <span class="menu-tile__title">{{ __('ui.menu.settings') }}</span>
                    <span class="menu-tile__meta">Adjust interface preferences</span>
                </span>
            </a>

            <a href="{{ route('admin.dashboard') }}" class="menu-tile menu-tile--warning" data-menu-link>
                <span class="menu-tile__icon"><i class="bi bi-grid"></i></span>
                <span class="menu-tile__body">
                    <span class="menu-tile__title">{{ __('ui.menu.admin') }}</span>
                    <span class="menu-tile__meta">Open control tools</span>
                </span>
            </a>
        </nav>

        <div class="menu-footer">
            <span>Command interface online</span>
            <span class="menu-footer__line"></span>
            <span>
                <p>&copy; 2026 Astral Empires. All rights reserved.</p>
            </span>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const scene = document.getElementById('menuScene');
        const layers = [
            document.getElementById('menuBgPrimary'),
            document.getElementById('menuBgSecondary')
        ];
        const links = document.querySelectorAll('[data-menu-link]');
        const candidates = [{
                primary: "{{ asset('assets/img_model_main/main_menu/forgottens_4k.png') }}",
                fallback: "{{ asset('assets/img_model_main/main_menu/mainMenu1.jpg') }}"
            },
            {
                primary: "{{ asset('assets/img_model_main/main_menu/forgottens2_4k.png') }}",
                fallback: "{{ asset('assets/img_model_main/main_menu/mainMenu2.jpg') }}"
            },
            {
                primary: "{{ asset('assets/img_model_main/main_menu/frozenMain_4k.png') }}",
                fallback: "{{ asset('assets/img_model_main/main_menu/frozenMain_Original.png') }}"
            },
            {
                primary: "{{ asset('assets/img_model_main/main_menu/roiMain_4k.png') }}",
                fallback: "{{ asset('assets/img_model_main/main_menu/roiMain_Original.png') }}"
            },
            {
                primary: "{{ asset('assets/img_model_main/main_menu/roiMain2_4k.png') }}",
                fallback: "{{ asset('assets/img_model_main/main_menu/roiMain2_Original.png') }}"
            }
        ];

        const preload = (url) => new Promise((resolve) => {
            const image = new Image();
            image.onload = () => resolve(url);
            image.onerror = () => resolve(null);
            image.src = url;
        });

        const resolveSource = async (entry) => {
            const primary = await preload(entry.primary);
            if (primary) {
                return primary;
            }

            return preload(entry.fallback);
        };

        const pickRandomIndex = (length, current = -1) => {
            if (length <= 1) {
                return 0;
            }

            let index = Math.floor(Math.random() * length);
            while (index === current) {
                index = Math.floor(Math.random() * length);
            }
            return index;
        };

        const applyLayer = (layer, url) => {
            layer.style.backgroundImage = `url('${url}')`;
        };

        const bootBackgrounds = async () => {
            const resolved = (await Promise.all(candidates.map(resolveSource))).filter(Boolean);
            const sources = resolved.length ? resolved : ["{{ asset('assets/img_model_main/main_menu/frozenMain_4k.png') }}"];
            let activeLayer = 0;
            let currentIndex = pickRandomIndex(sources.length);

            applyLayer(layers[activeLayer], sources[currentIndex]);
            layers[activeLayer].classList.add('is-active');
            scene.classList.add('is-ready');

            if (sources.length < 2) {
                return;
            }

            window.setInterval(() => {
                const nextLayer = activeLayer === 0 ? 1 : 0;
                const nextIndex = pickRandomIndex(sources.length, currentIndex);
                applyLayer(layers[nextLayer], sources[nextIndex]);
                layers[nextLayer].classList.add('is-active');
                layers[activeLayer].classList.remove('is-active');
                activeLayer = nextLayer;
                currentIndex = nextIndex;
            }, 16000);
        };

        bootBackgrounds();

        links.forEach((link) => {
            link.addEventListener('click', (event) => {
                if (
                    event.defaultPrevented ||
                    event.button !== 0 ||
                    event.metaKey ||
                    event.ctrlKey ||
                    event.shiftKey ||
                    event.altKey
                ) {
                    return;
                }

                const href = link.getAttribute('href');
                if (!href) {
                    return;
                }

                event.preventDefault();
                document.body.classList.add('menu-leaving');
                window.setTimeout(() => {
                    window.location.href = href;
                }, 560);
            });
        });
    });
</script>
@endpush