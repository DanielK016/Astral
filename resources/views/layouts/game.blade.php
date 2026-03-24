@extends('layouts.base')

@section('body')
@php($hideGameNav = $hideGameNav ?? false)
<div class="game-root {{ $hideGameNav ? 'game-root--navless' : '' }}" data-astral-page>
    @unless($hideGameNav)
        <nav class="game-nav-shell">
            <div class="game-nav-bar">
                <a class="game-nav-brand" href="{{ route('menu') }}" data-page-link>
                    <span class="game-nav-brand__dot"></span>
                    Astral Empires
                </a>

                <div class="game-nav-actions">
                    <span class="game-nav-label">{{ __('ui.common.language') }}</span>
                    <div class="game-nav-lang" role="group" aria-label="Language">
                        <a class="game-nav-lang__btn {{ app()->getLocale()==='en' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['lang'=>'en']) }}" data-page-link>EN</a>
                        <a class="game-nav-lang__btn {{ app()->getLocale()==='ro' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['lang'=>'ro']) }}" data-page-link>RO</a>
                        <a class="game-nav-lang__btn {{ app()->getLocale()==='ru' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['lang'=>'ru']) }}" data-page-link>RU</a>
                    </div>
                </div>
            </div>
        </nav>
    @endunless

    <main class="game-main {{ $hideGameNav ? 'game-main--navless' : '' }}">
        @yield('content')
    </main>

    <div class="astral-page-transition" data-page-transition>
        <div class="astral-page-transition__glow"></div>
        <div class="astral-page-transition__label">Loading</div>
    </div>
</div>
@endsection

@push('head')
<style>
    .game-nav-shell {
        position: fixed;
        inset: 0 0 auto 0;
        z-index: 1100;
        padding: 10px 12px;
        pointer-events: none;
    }

    .game-nav-bar {
        pointer-events: auto;
        min-height: 58px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 10px 14px;
        border-radius: 22px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: linear-gradient(180deg, rgba(7, 14, 28, .82), rgba(4, 9, 18, .72));
        backdrop-filter: blur(14px);
        box-shadow: 0 16px 38px rgba(0, 0, 0, .24);
    }

    .game-nav-brand {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #f1f7ff;
        font-weight: 800;
        letter-spacing: .16em;
        text-transform: uppercase;
        text-decoration: none;
    }

    .game-nav-brand__dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #8fd7ff;
        box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .game-nav-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .game-nav-label {
        color: rgba(220, 235, 255, .58);
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .game-nav-lang {
        display: inline-flex;
        gap: 8px;
    }

    .game-nav-lang__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        min-height: 40px;
        padding: 0 12px;
        border-radius: 13px;
        border: 1px solid rgba(143, 215, 255, .14);
        background: rgba(255, 255, 255, .03);
        color: #d8e7ff;
        font-weight: 700;
        letter-spacing: .08em;
        text-decoration: none;
        transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .game-nav-lang__btn:hover,
    .game-nav-lang__btn.active {
        transform: translateY(-1px);
        border-color: rgba(143, 215, 255, .42);
        background: rgba(96, 187, 255, .10);
        box-shadow: 0 0 18px rgba(97, 188, 255, .14);
        color: #f4fbff;
    }

    .game-main {
        min-height: 100vh;
        padding-top: 82px;
    }

    .game-main--navless {
        padding-top: 0;
    }

    .astral-page-transition {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: grid;
        place-items: center;
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
        transition: opacity .46s ease, visibility .46s ease;
    }

    .astral-page-transition__glow {
        position: absolute;
        width: 42vmin;
        height: 42vmin;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(143, 215, 255, .22), transparent 68%);
        filter: blur(10px);
    }

    .astral-page-transition__label {
        position: relative;
        color: #eff7ff;
        font-size: .88rem;
        font-weight: 800;
        letter-spacing: .30em;
        text-transform: uppercase;
    }

    .astral-page-transition.is-visible {
        opacity: 1;
        visibility: visible;
        pointer-events: none;
    }

    @media (max-width: 720px) {
        .game-nav-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .game-nav-actions {
            justify-content: space-between;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const overlay = document.querySelector('[data-page-transition]');
        let hideTimer = null;

        const showTransition = () => {
            overlay?.classList.add('is-visible');

            if (hideTimer) {
                clearTimeout(hideTimer);
            }

            hideTimer = setTimeout(() => {
                overlay?.classList.remove('is-visible');
            }, 5000);
        };

        const hideTransition = () => {
            requestAnimationFrame(() => overlay?.classList.remove('is-visible'));

            if (hideTimer) {
                clearTimeout(hideTimer);
                hideTimer = null;
            }
        };

        hideTransition();
        window.AstralPageTransition = { show: showTransition, hide: hideTransition };

       window.addEventListener('pageshow', () => {
    const label = document.querySelector('.astral-page-transition__label');
    if (label) {
        label.textContent = 'Loading';
    }
});

        window.addEventListener('load', () => {
            hideTransition();
        });

        setTimeout(() => {
            hideTransition();
        }, 5000);

        document.querySelectorAll('a[data-page-link]').forEach((link) => {
            link.addEventListener('click', (event) => {
                const href = link.getAttribute('href');
                if (!href || href.startsWith('#') || link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
                    return;
                }
                event.preventDefault();
                showTransition();
                setTimeout(() => window.location.href = href, 340);
            });
        });

        document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
            form.addEventListener('submit', () => showTransition());
        });
    });
</script>
@endpush
