@extends('layouts.app')
@section('title','Create Hyperlane')

@section('content')
  <div class="card" style="max-width:980px">
    <h1 style="margin:0 0 10px 0;">Create Hyperlane</h1>

    <form method="post" action="{{ route('admin.hyperlanes.store') }}">
      @csrf


      <div class="grid grid-2">
        <div class="field">
          <label>Galaxy</label>
          <select name="galaxy_id" required>
            @foreach($galaxies as $g)
              <option value="{{ $g->id }}" @selected(old('galaxy_id', null?->galaxy_id) == $g->id)>
                #{{ $g->id }} {{ $g->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="field">
          <label>From system</label>
          <select name="from_star_system_id" required>
            @foreach($systems as $s)
              <option value="{{ $s->id }}" @selected(old('from_star_system_id', null?->from_star_system_id) == $s->id)>
                #{{ $s->id }} {{ $s->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="field">
          <label>To system</label>
          <select name="to_star_system_id" required>
            @foreach($systems as $s)
              <option value="{{ $s->id }}" @selected(old('to_star_system_id', null?->to_star_system_id) == $s->id)>
                #{{ $s->id }} {{ $s->name }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      @if($errors->any())
        <div class="muted" style="color:#ff9a88;margin-top:10px">Check the form fields.</div>
      @endif

      <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap">
        <button class="btn" type="submit">Save</button>
        <a class="btn" href="{{ route('admin.hyperlanes.index') }}">← Back</a>
      </div>
    </form>
  </div>
@endsection
