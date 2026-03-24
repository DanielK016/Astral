@extends('layouts.app')
@section('title','Edit Race')

@section('content')
  <div class="card" style="max-width:900px">
    <h1 style="margin:0 0 10px 0;">Edit Race</h1>

    <form method="post" action="{{ route('admin.races.update', $item) }}">
      @csrf
      @method('PUT')

      <div class="grid grid-2">
          <div class="field">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $item->name ) }}" required>
        @error('name')<div class="muted" style="color:#ff9a88">{{ $message }}</div>@enderror

      </div>
      <div class="field">
        <label>HEX Color</label>
        <input type="text" name="color_hex" value="{{ old('color_hex', $item->color_hex ) }}" required>
        @error('color_hex')<div class="muted" style="color:#ff9a88">{{ $message }}</div>@enderror

      </div>
      <div class="field">
        <label>Home Star System ID (optional)</label>
        <input type="number" name="home_star_system_id" value="{{ old('home_star_system_id', $item->home_star_system_id ?? '' ) }}" >
        @error('home_star_system_id')<div class="muted" style="color:#ff9a88">{{ $message }}</div>@enderror

      </div>
      <div class="field">
        <label>Description</label>
        <textarea name="description">{{ old('description', $item->description ) }}</textarea>
        @error('description')<div class="muted" style="color:#ff9a88">{{ $message }}</div>@enderror

      </div>
      <div class="field">
        <label>Traits JSON (optional)</label>
        <textarea name="traits_json">{{ old('traits_json', $item->traits_json ? json_encode($item->traits_json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) : '' ) }}</textarea>
        @error('traits_json')<div class="muted" style="color:#ff9a88">{{ $message }}</div>@enderror

      </div>
      </div>

      <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap">
        <button class="btn" type="submit">Save</button>
        <a class="btn" href="{{ route('admin.races.index') }}">← Back</a>
      </div>
    </form>
  </div>
@endsection
