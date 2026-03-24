@extends('layouts.game')
@php($hideGameNav = true)

@push('head')
<style>
    .game-root {
        min-height: 100vh;
        background:
            radial-gradient(circle at 18% 18%, rgba(117, 193, 255, .14), transparent 30%),
            radial-gradient(circle at 82% 22%, rgba(255, 191, 96, .10), transparent 24%),
            linear-gradient(180deg, rgba(5, 9, 17, .34), rgba(3, 6, 12, .92)),
            url('{{ asset('assets/img_model_main/main_menu/frozenMain_4k.png') }}') center / cover no-repeat fixed;
        position: relative;
        overflow: hidden;
    }

    .generation-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .generation-page::before,
    .generation-page::after {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
    }

    .generation-page::before {
        background:
            linear-gradient(rgba(255, 255, 255, .025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, .02) 1px, transparent 1px);
        background-size: 62px 62px;
        mask-image: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, .84) 20%, #000 70%, transparent 100%);
        opacity: .28;
    }

    .generation-page::after {
        background: radial-gradient(circle at 50% 50%, transparent 46%, rgba(0, 0, 0, .42) 100%);
    }

    .generation-card {
        position: relative;
        width: min(100%, 760px);
        padding: clamp(28px, 4vw, 44px);
        border: 1px solid rgba(153, 218, 255, .2);
        border-radius: 30px;
        background:
            linear-gradient(180deg, rgba(255, 255, 255, .06), rgba(255, 255, 255, .015)),
            rgba(5, 10, 22, .62);
        backdrop-filter: blur(18px);
        box-shadow: 0 24px 80px rgba(0, 0, 0, .42);
        overflow: hidden;
    }

    .generation-card::before {
        content: '';
        position: absolute;
        inset: 1px;
        border-radius: inherit;
        border: 1px solid rgba(255, 255, 255, .04);
        pointer-events: none;
    }

    .generation-card__eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 8px 14px;
        border-radius: 999px;
        border: 1px solid rgba(144, 211, 255, .22);
        background: rgba(255, 255, 255, .04);
        color: #8ed8ff;
        font-size: .76rem;
        font-weight: 800;
        letter-spacing: .18em;
        text-transform: uppercase;
    }

    .generation-card__eyebrow::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #8ed8ff;
        box-shadow: 0 0 18px rgba(142, 216, 255, .8);
    }

    .generation-title {
        margin: 20px 0 10px;
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #f5fbff;
        text-shadow: 0 0 24px rgba(74, 183, 255, .18);
    }

    .generation-copy {
        margin: 0;
        max-width: 640px;
        color: rgba(228, 238, 255, .74);
        font-size: 1rem;
        line-height: 1.7;
    }

    .generation-actions {
        margin-top: 28px;
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
    }

    .generation-button,
    .generation-back {
        min-width: 170px;
        padding: 14px 20px;
        border-radius: 18px;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease, background .25s ease;
    }

    .generation-button {
        border: 1px solid rgba(143, 215, 255, .34);
        background: linear-gradient(180deg, rgba(118, 200, 255, .18), rgba(255, 255, 255, .04));
        color: #f7fbff;
        box-shadow: 0 16px 40px rgba(0, 0, 0, .28);
    }

    .generation-button:hover,
    .generation-button:focus-visible {
        border-color: rgba(143, 215, 255, .62);
        box-shadow: 0 20px 48px rgba(0, 0, 0, .34), 0 0 28px rgba(96, 186, 255, .18);
        transform: translateY(-3px);
        outline: none;
    }

    .generation-back {
        border: 1px solid rgba(255, 255, 255, .12);
        background: rgba(255, 255, 255, .04);
        color: rgba(236, 242, 255, .88);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .generation-back:hover,
    .generation-back:focus-visible {
        border-color: rgba(255, 255, 255, .26);
        color: #fff;
        transform: translateY(-3px);
        outline: none;
    }

    .generation-status {
        margin-top: 28px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }

    .generation-status__item {
        padding: 14px 16px;
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: 18px;
        background: rgba(255, 255, 255, .035);
    }

    .generation-status__label {
        display: block;
        margin-bottom: 6px;
        color: rgba(214, 228, 255, .56);
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .generation-status__value {
        display: block;
        color: #f4f8ff;
        font-size: .96rem;
        font-weight: 700;
        letter-spacing: .06em;
    }

    .generation-loading {
        position: fixed;
        inset: 0;
        z-index: 50;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity .45s ease, visibility .45s ease;
        background: rgba(2, 5, 10, .78);
    }

    .generation-loading__video,
    .generation-loading__shade,
    .generation-loading__noise {
        position: absolute;
        inset: 0;
    }

    .generation-loading__video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transform: scale(1.03);
        transition: opacity .7s ease, transform 1.4s ease;
        filter: contrast(1.06) saturate(1.05) brightness(.72);
    }

    .generation-loading__video.is-active {
        opacity: 1;
        transform: scale(1);
    }

    .generation-loading__shade {
        background:
            radial-gradient(circle at 50% 42%, rgba(120, 205, 255, .16), transparent 26%),
            linear-gradient(180deg, rgba(4, 7, 14, .14), rgba(4, 7, 14, .84));
    }

    .generation-loading__noise {
        background-image:
            radial-gradient(rgba(255, 255, 255, .06) .6px, transparent .6px),
            radial-gradient(rgba(255, 255, 255, .024) .5px, transparent .5px);
        background-position: 0 0, 13px 17px;
        background-size: 28px 28px, 34px 34px;
        mix-blend-mode: soft-light;
        opacity: .14;
    }

    .generation-loading__content {
        position: relative;
        z-index: 1;
        width: min(100% - 32px, 660px);
        padding: clamp(24px, 4vw, 40px);
        border-radius: 28px;
        border: 1px solid rgba(155, 220, 255, .18);
        background: rgba(4, 10, 20, .32);
        backdrop-filter: blur(14px);
        box-shadow: 0 24px 90px rgba(0, 0, 0, .46);
        text-align: center;
    }

    .generation-loading__title {
        margin: 0;
        font-size: clamp(1.8rem, 3vw, 2.6rem);
        font-weight: 800;
        letter-spacing: .16em;
        text-transform: uppercase;
        color: #f7fbff;
    }

    .generation-loading__copy {
        margin: 14px auto 0;
        max-width: 480px;
        color: rgba(228, 238, 255, .72);
        line-height: 1.7;
        letter-spacing: .04em;
        text-transform: uppercase;
        font-size: .92rem;
    }

    .generation-loading__bar {
        margin-top: 24px;
        height: 10px;
        border-radius: 999px;
        overflow: hidden;
        background: rgba(255, 255, 255, .08);
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .04);
    }

    .generation-loading__bar > span {
        display: block;
        width: 36%;
        height: 100%;
        border-radius: inherit;
        background: linear-gradient(90deg, rgba(143, 215, 255, .24), rgba(143, 215, 255, .92), rgba(255, 222, 168, .72));
        animation: generationProgress 1.25s ease-in-out infinite;
    }

    .generation-loading__steps {
        margin-top: 18px;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px 14px;
        color: rgba(221, 233, 249, .62);
        font-size: .76rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    body.generate-loading-active .generation-loading {
        opacity: 1;
        visibility: visible;
    pointer-events: none;
    }

    body.generate-loading-active .generation-card {
        opacity: 0;
        transform: translateY(12px) scale(.985);
        transition: opacity .35s ease, transform .35s ease;
    }

    @keyframes generationProgress {
        0% {
            transform: translateX(-105%);
        }
        100% {
            transform: translateX(260%);
        }
    }

    @media (max-width: 767.98px) {
        .generation-status {
            grid-template-columns: 1fr;
        }

        .generation-actions {
            flex-direction: column;
        }

        .generation-button,
        .generation-back {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="generation-page">
    <div class="generation-card" id="generationCard">
        <div class="generation-card__eyebrow">Galaxy Preparation</div>
        <h1 class="generation-title">{{ __('ui.newgame.generate') }}</h1>
        <p class="generation-copy">Build the strategic map, initialize star systems, assemble starting empires, and prepare a seamless handoff into the campaign.</p>

        <form method="POST" action="{{ route('newgame.generate.run') }}" class="generation-actions" id="generationForm">
            @csrf
            <button class="generation-button" id="generationButton">Generate</button>
            <a class="generation-back" href="{{ route('newgame.difficulty') }}">{{ __('ui.common.back') }}</a>
        </form>

        <div class="generation-status">
            <div class="generation-status__item">
                <span class="generation-status__label">Background</span>
                <span class="generation-status__value">Procedural star layout</span>
            </div>
            <div class="generation-status__item">
                <span class="generation-status__label">Mode</span>
                <span class="generation-status__value">Turn-based initialization</span>
            </div>
            <div class="generation-status__item">
                <span class="generation-status__label">Output</span>
                <span class="generation-status__value">Campaign-ready session</span>
            </div>
        </div>
    </div>
</div>

<div class="generation-loading" id="generationLoading" aria-hidden="true">
    <video class="generation-loading__video is-active" id="loadingVideoA" muted playsinline preload="auto">
        <source src="{{ asset('assets/img_model_main/main_menu/loadingFrame.mp4') }}" type="video/mp4">
    </video>
    <video class="generation-loading__video" id="loadingVideoB" muted playsinline preload="auto">
        <source src="{{ asset('assets/img_model_main/main_menu/loadingFrame.mp4') }}" type="video/mp4">
    </video>
    <div class="generation-loading__shade"></div>
    <div class="generation-loading__noise"></div>

    <div class="generation-loading__content">
        <h2 class="generation-loading__title">Generating Galaxy</h2>
        <p class="generation-loading__copy">Synchronizing systems, assigning worlds, and preparing the campaign entry point.</p>
        <div class="generation-loading__bar"><span></span></div>
        <div class="generation-loading__steps">
            <span>Starfields</span>
            <span>Empires</span>
            <span>Homeworlds</span>
            <span>Routes</span>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('generationForm');
        const button = document.getElementById('generationButton');
        const videos = [
            document.getElementById('loadingVideoA'),
            document.getElementById('loadingVideoB')
        ];

        let currentVideoIndex = 0;
        let crossfading = false;
        let rafId = null;
        let hideTimer = null;

        const playVideo = async (video) => {
            try {
                await video.play();
            } catch (error) {
            }
        };

        const stopLoadingOverlay = () => {
            document.body.classList.remove('generate-loading-active');

            videos.forEach((video, index) => {
                video.pause();
                video.currentTime = 0;
                video.classList.toggle('is-active', index === 0);
            });

            currentVideoIndex = 0;
            crossfading = false;

            if (rafId) {
                window.cancelAnimationFrame(rafId);
                rafId = null;
            }

            if (hideTimer) {
                clearTimeout(hideTimer);
                hideTimer = null;
            }

            button.dataset.locked = 'false';
            button.removeAttribute('disabled');
        };

        const monitorLoop = () => {
            const active = videos[currentVideoIndex];
            const inactiveIndex = currentVideoIndex === 0 ? 1 : 0;
            const inactive = videos[inactiveIndex];

            if (active.duration && Number.isFinite(active.duration)) {
                const remaining = active.duration - active.currentTime;
                if (!crossfading && remaining <= 0.75) {
                    crossfading = true;
                    inactive.currentTime = 0;
                    playVideo(inactive).then(() => {
                        inactive.classList.add('is-active');
                        active.classList.remove('is-active');
                        window.setTimeout(() => {
                            active.pause();
                            currentVideoIndex = inactiveIndex;
                            crossfading = false;
                        }, 520);
                    });
                }
            }

            rafId = window.requestAnimationFrame(monitorLoop);
        };

        form.addEventListener('submit', (event) => {
            if (button.dataset.locked === 'true') {
                return;
            }

            event.preventDefault();
            button.dataset.locked = 'true';
            button.setAttribute('disabled', 'disabled');
            document.body.classList.add('generate-loading-active');

            videos.forEach((video, index) => {
                video.pause();
                video.currentTime = 0;
                video.classList.toggle('is-active', index === 0);
            });

            currentVideoIndex = 0;
            crossfading = false;
            playVideo(videos[0]);

            if (rafId) {
                window.cancelAnimationFrame(rafId);
            }
            rafId = window.requestAnimationFrame(monitorLoop);

            hideTimer = window.setTimeout(() => {
                stopLoadingOverlay();
            }, 5000);

            window.setTimeout(() => {
                form.submit();
            }, 280);
        });

        window.addEventListener('pageshow', () => {
            stopLoadingOverlay();
        });
    });
</script>
@endpush
