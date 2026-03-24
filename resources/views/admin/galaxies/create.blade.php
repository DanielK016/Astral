@extends('layouts.app')
@section('title','Create Galaxy')

@section('content')
  <div class="card" style="max-width:900px">
    <h1 style="margin:0 0 10px 0;">Create Galaxy</h1>

    <form method="post" action="{{ route('admin.galaxies.store') }}">
      @csrf


      <div class="grid grid-2">
          <div class="field">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', 'New Galaxy' ) }}" required>
        @error('name')<div class="muted" style="color:#ff9a88">{{ $message }}</div>@enderror

      </div>
      <div class="field">
        <label>Seed</label>
        <input type="number" name="seed" value="{{ old('seed', '' ) }}" >
        @error('seed')<div class="muted" style="color:#ff9a88">{{ $message }}</div>@enderror

      </div>
      <div class="field">
        <label>Size (systems)</label>
        <input type="number" name="size" value="{{ old('size', 300 ) }}" required>
        @error('size')<div class="muted" style="color:#ff9a88">{{ $message }}</div>@enderror

      </div>
      <div class="field">
        <label>Arms</label>
        <input type="number" name="arms" value="{{ old('arms', 4 ) }}" required>
        @error('arms')<div class="muted" style="color:#ff9a88">{{ $message }}</div>@enderror

      </div>
      <div class="field">
        <label>Notes</label>
        <textarea name="notes">{{ old('notes', '' ) }}</textarea>
        @error('notes')<div class="muted" style="color:#ff9a88">{{ $message }}</div>@enderror

      </div>
      </div>

      <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap">
        <button class="btn" type="submit">Save</button>
        <a class="btn" href="{{ route('admin.galaxies.index') }}">← Back</a>
      </div>
    </form>
  </div>
@endsection
