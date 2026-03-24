@extends('layouts.app')
@section('title','New Game — Race Configuration')

@section('content')
  <div class="card">
    <h1 style="margin:0 0 10px 0;">Race Configuration</h1>
    <div class="muted">These are the core fields for now. Additional parameters can be added later, including portraits, traits, and bonuses.</div>

    <form method="post" action="{{ route('new-game.race.configure.save', ['race' => $race->id]) }}" style="margin-top:14px">
      @csrf
      <div class="grid grid-2">
        <div class="field">
          <label>Name</label>
          <input name="name" value="{{ old('name', $race->name) }}" required>
          @error('name')<div class="muted" style="color:#ff9a88">{{ $message }}</div>@enderror
        </div>
        <div class="field">
          <label>Color (HEX)</label>
          <input name="color_hex" value="{{ old('color_hex', $race->color_hex) }}" required>
          @error('color_hex')<div class="muted" style="color:#ff9a88">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="field" style="margin-top:12px">
        <label>Description</label>
        <textarea name="description">{{ old('description', $race->description) }}</textarea>
      </div>

      <div class="field" style="margin-top:12px">
        <label>Traits JSON (optional)</label>
        <textarea name="traits_json">{{ old('traits_json', $race->traits_json ? json_encode($race->traits_json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) : '') }}</textarea>
        <div class="muted">Example: {"machine":true,"agile":false}</div>
      </div>

      <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap">
        <button class="btn" type="submit">Continue →</button>
        <a class="btn" href="{{ route('new-game.race') }}">← Back</a>
      </div>
    </form>
  </div>
@endsection
