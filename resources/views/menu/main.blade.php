@extends('layouts.app')
@section('title','Main Menu')

@section('content')
  <div class="card">
    <h1 style="margin:0 0 10px 0;">Main Menu</h1>
    <div class="muted">Project skeleton: gameplay and interface will continue to expand. Right now the focus is Laravel CRUD and a working visual presentation.</div>

    <div style="margin-top:14px;display:flex;gap:12px;flex-wrap:wrap">
      <a class="btn" href="{{ route('new-game.difficulty') }}">▶ New Game</a>
      <a class="btn" href="{{ route('admin.races.index') }}">🛠 CRUD / Admin</a>
      @if(session('game.galaxy_id'))
        <a class="btn" href="{{ route('galaxy.show', ['galaxy' => session('game.galaxy_id')]) }}">🌌 Continue (Galaxy)</a>
      @endif
    </div>
  </div>

  <div style="height:14px"></div>

  <div class="card">
    <h3 style="margin:0 0 8px 0;">Stage Structure</h3>
    <ol style="margin:0;padding-left:20px;line-height:1.7">
      <li>Main Menu</li>
      <li>Difficulty Selection</li>
      <li>Race Selection</li>
      <li>Race Configuration + galaxy</li>
      <li>Galaxy Generation</li>
      <li>Transition into Your Race System</li>
    </ol>
  </div>
@endsection
