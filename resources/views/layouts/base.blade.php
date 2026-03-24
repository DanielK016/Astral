<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Astral Empires'))</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        html, body { height: 100%; background: #050510; }
        .game-root { min-height: 100vh; background: radial-gradient(1200px 700px at 50% 20%, rgba(0,160,255,.10), transparent 60%), #050510; }
        .glass { backdrop-filter: blur(10px); background: rgba(0,0,0,.55); border: 1px solid rgba(0,170,255,.25); }
        .neon { text-shadow: 0 0 18px rgba(0,170,255,.55); }
        .btn-neon { border-color: rgba(0,170,255,.55); }
        .btn-neon:hover { box-shadow: 0 0 18px rgba(0,170,255,.35); }
        .menu-video { position: fixed; inset: 0; object-fit: cover; width: 100%; height: 100%; filter: contrast(1.05) saturate(1.05) brightness(0.75); }
        .menu-overlay { position: fixed; inset: 0; background: radial-gradient(900px 500px at 50% 20%, rgba(0,170,255,.12), transparent 60%), rgba(0,0,0,.55); }
    </style>

    @stack('head')
</head>
<body>
    @yield('body')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
      try { new bootstrap.Tooltip(el, { boundary: document.body }); } catch (e) {}
    });
  });
</script>
    @stack('scripts')
</body>
</html>
