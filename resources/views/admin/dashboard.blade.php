@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
  <div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;margin-bottom:18px;">
      <div>
        <div class="muted" style="text-transform:uppercase;letter-spacing:.16em;font-weight:700;">Administration</div>
        <h1 style="margin:8px 0 0;letter-spacing:.08em;text-transform:uppercase;">Project Control</h1>
      </div>
      <a class="btn" href="{{ route('menu') }}" data-page-link>Back to Menu</a>
    </div>

    <p class="muted" style="margin:0 0 18px;max-width:760px;line-height:1.7;">
      Access the project CRUD sections for galaxies, systems, planets, hyperlanes, and races. All administrative tools now follow the same translucent sci-fi styling as the redesigned game interface.
    </p>

    <div class="grid grid-2">
      <a class="card" href="{{ route('admin.galaxies.index') }}" data-page-link>
        <strong>Galaxies</strong>
        <div class="muted" style="margin-top:8px;">Manage procedural seeds, galaxy size, notes, and structural configuration.</div>
      </a>
      <a class="card" href="{{ route('admin.star-systems.index') }}" data-page-link>
        <strong>Star Systems</strong>
        <div class="muted" style="margin-top:8px;">Edit coordinates, star appearance, previews, and system metadata.</div>
      </a>
      <a class="card" href="{{ route('admin.planets.index') }}" data-page-link>
        <strong>Planets</strong>
        <div class="muted" style="margin-top:8px;">Create and tune world data, rings, orbit values, and planet properties.</div>
      </a>
      <a class="card" href="{{ route('admin.hyperlanes.index') }}" data-page-link>
        <strong>Hyperlanes</strong>
        <div class="muted" style="margin-top:8px;">Connect systems and control the navigational backbone of the galaxy.</div>
      </a>
      <a class="card" href="{{ route('admin.races.index') }}" data-page-link>
        <strong>Races</strong>
        <div class="muted" style="margin-top:8px;">Maintain playable factions, colors, traits, and homeworld references.</div>
      </a>
    </div>
  </div>
@endsection
