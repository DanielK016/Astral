<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Astral Empires')</title>
  @stack('head')
</head>
<body style="margin:0;overflow:hidden;background:#020210;">
  @yield('content')
  @stack('scripts')
</body>
</html>
