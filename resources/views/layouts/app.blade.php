<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Astral Empires Admin')</title>
  <style>
    :root {
      --app-bg: #030711;
      --app-panel: rgba(6, 12, 24, .78);
      --app-panel-soft: rgba(255, 255, 255, .03);
      --app-border: rgba(143, 215, 255, .16);
      --app-border-strong: rgba(143, 215, 255, .28);
      --app-text: #eef5ff;
      --app-muted: rgba(220, 235, 255, .62);
      --app-accent: #8fd7ff;
      --app-accent-2: #ffd38a;
      --app-danger: #ff8f8f;
    }

    * { box-sizing: border-box; }

    html, body {
      margin: 0;
      min-height: 100%;
      font-family: Inter, Arial, sans-serif;
      background:
        radial-gradient(circle at 18% 18%, rgba(88, 176, 255, .12), transparent 24%),
        radial-gradient(circle at 82% 20%, rgba(255, 193, 119, .08), transparent 20%),
        linear-gradient(180deg, #040913, #02050c 62%);
      color: var(--app-text);
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .app-shell {
      min-height: 100vh;
      position: relative;
      overflow: clip;
    }

    .app-shell::before {
      content: '';
      position: fixed;
      inset: 0;
      pointer-events: none;
      background-image:
        linear-gradient(rgba(255,255,255,.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.018) 1px, transparent 1px);
      background-size: 72px 72px;
      mask-image: linear-gradient(180deg, transparent 0%, #000 18%, #000 82%, transparent 100%);
      opacity: .25;
    }

    .app-nav {
      position: sticky;
      top: 0;
      z-index: 100;
      padding: 12px;
    }

    .app-nav__bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 12px 16px;
      border-radius: 24px;
      border: 1px solid var(--app-border);
      background: linear-gradient(180deg, rgba(7, 14, 28, .86), rgba(4, 9, 18, .74));
      backdrop-filter: blur(15px);
      box-shadow: 0 16px 36px rgba(0, 0, 0, .26);
    }

    .app-brand {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-weight: 800;
      letter-spacing: .18em;
      text-transform: uppercase;
    }

    .app-brand::before {
      content: '';
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--app-accent);
      box-shadow: 0 0 16px rgba(143, 215, 255, .82);
    }

    .app-nav__links {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .app-nav__link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 40px;
      padding: 0 14px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .14);
      background: rgba(255, 255, 255, .03);
      color: #d8e7ff;
      font-size: .88rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .app-nav__link:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
      color: #f4fbff;
    }

    .container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 8px 18px 32px;
    }

    .card {
      position: relative;
      border-radius: 28px;
      padding: 20px 22px;
      background: linear-gradient(180deg, rgba(255,255,255,.048), rgba(255,255,255,.02)), var(--app-panel);
      border: 1px solid var(--app-border);
      box-shadow: 0 20px 52px rgba(0, 0, 0, .28);
      backdrop-filter: blur(16px);
    }

    .card + .card { margin-top: 16px; }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 44px;
      padding: 0 16px;
      border-radius: 14px;
      border: 1px solid rgba(143, 215, 255, .18);
      background: rgba(255,255,255,.03);
      color: #f1f7ff;
      font-weight: 700;
      letter-spacing: .05em;
      cursor: pointer;
      transition: transform .18s ease, border-color .18s ease, background .18s ease, box-shadow .18s ease;
    }

    .btn:hover {
      transform: translateY(-1px);
      border-color: var(--app-border-strong);
      background: rgba(96, 187, 255, .10);
      box-shadow: 0 0 18px rgba(97, 188, 255, .14);
    }

    .btn-danger {
      border-color: rgba(255, 143, 143, .24);
      background: rgba(255, 143, 143, .05);
    }

    .btn-danger:hover {
      border-color: rgba(255, 143, 143, .46);
      background: rgba(255, 143, 143, .12);
      box-shadow: 0 0 18px rgba(255, 143, 143, .12);
    }

    .grid { display: grid; gap: 14px; }
    .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }

    .field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    label {
      color: rgba(232, 241, 255, .72);
      font-size: .82rem;
      font-weight: 700;
      letter-spacing: .10em;
      text-transform: uppercase;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px 14px;
      border-radius: 16px;
      border: 1px solid rgba(255,255,255,.10);
      background: rgba(8, 14, 26, .92);
      color: #f1f7ff;
      outline: none;
      transition: border-color .18s ease, box-shadow .18s ease, background .18s ease;
    }

    input:focus, select:focus, textarea:focus {
      border-color: rgba(143, 215, 255, .38);
      box-shadow: 0 0 0 4px rgba(143, 215, 255, .08);
      background: rgba(10, 18, 32, .96);
    }

    textarea { min-height: 124px; resize: vertical; }

    table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 18px;
    }

    th, td {
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255,255,255,.08);
    }

    thead th {
      color: var(--app-accent-2);
      font-size: .76rem;
      font-weight: 800;
      letter-spacing: .16em;
      text-transform: uppercase;
    }

    tbody tr {
      transition: background .16s ease;
    }

    tbody tr:hover {
      background: rgba(255,255,255,.03);
    }

    .muted {
      color: var(--app-muted);
      font-size: .88rem;
    }

    .flash {
      margin: 0 0 18px;
      padding: 12px 14px;
      border-radius: 16px;
      background: rgba(96, 187, 255, .12);
      border: 1px solid rgba(143, 215, 255, .24);
    }

    .app-page-transition {
      position: fixed;
      inset: 0;
      z-index: 999;
      display: grid;
      place-items: center;
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
      background: radial-gradient(circle at 50% 38%, rgba(18, 45, 82, .42), rgba(1, 4, 10, .94));
      transition: opacity .45s ease, visibility .45s ease;
    }

    .app-page-transition.is-visible {
      opacity: 1;
      visibility: visible;
      pointer-events: none;
    }

    .app-page-transition__label {
      color: #eef7ff;
      font-size: .88rem;
      font-weight: 800;
      letter-spacing: .28em;
      text-transform: uppercase;
    }

    @media (max-width: 860px) {
      .grid-2 { grid-template-columns: 1fr; }
      .app-nav__bar { flex-direction: column; align-items: stretch; }
      .app-nav__links { justify-content: space-between; }
    }
  </style>
  @stack('head')
</head>
<body>
  <div class="app-shell">
    <nav class="app-nav">
      <div class="app-nav__bar">
        <a class="app-brand" href="{{ route('menu') }}" data-page-link>Astral Control</a>
        <div class="app-nav__links">
          <a class="app-nav__link" href="{{ route('menu') }}" data-page-link>Main Menu</a>
          <a class="app-nav__link" href="{{ route('newgame.difficulty') }}" data-page-link>New Game</a>
          <a class="app-nav__link" href="{{ route('admin.dashboard') }}" data-page-link>Admin</a>
        </div>
      </div>
    </nav>

    <div class="container">
      @if(session('ok'))
        <div class="flash">{{ session('ok') }}</div>
      @endif

      @yield('content')
    </div>

    <div class="app-page-transition" data-page-transition>
      <div class="app-page-transition__label">Loading</div>
    </div>
  </div>

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

    window.addEventListener('pageshow', () => {
      hideTransition();
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
        setTimeout(() => window.location.href = href, 320);
      });
    });

    document.querySelectorAll('form:not([data-no-transition])').forEach((form) => {
      form.addEventListener('submit', () => {
        showTransition();
      });
    });
  });
</script>

  @stack('scripts')
</body>
</html>
