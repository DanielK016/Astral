@extends('layouts.app')
@section('title','Edit Planet')

@section('content')
  <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

  <div class="card" style="max-width:1180px">
    <h1 style="margin:0 0 14px 0;">Edit Planet</h1>

    <form method="post" action="{{ route('admin.planets.update', $item) }}">
      @csrf
      @method('PUT')

      <div style="display:grid;grid-template-columns:1.2fr .8fr;gap:18px;align-items:start;">
        <div>
          <div class="grid grid-2">
            <div class="field">
              <label>Star System</label>
              <select name="star_system_id" required>
                @foreach($systems as $s)
                  <option value="{{ $s->id }}" @selected(old('star_system_id', optional($item)->star_system_id) == $s->id)>
                    #{{ $s->id }} {{ $s->name }}
                  </option>
                @endforeach
              </select>
              @error('star_system_id')
                <div class="muted" style="color:#ff9a88">{{ $message }}</div>
              @enderror
            </div>

            <div class="field">
              <label>Name</label>
              <input name="name" value="{{ old('name', optional($item)->name ?? '') }}" required>
              @error('name')
                <div class="muted" style="color:#ff9a88">{{ $message }}</div>
              @enderror
            </div>

            <div class="field">
              <label>Type</label>
              <select name="type" id="planetType" required>
                @foreach(['biolum','desert','gas','ice','ocean','terran','vulcanic'] as $t)
                  <option value="{{ $t }}" @selected(old('type', optional($item)->type ?? 'terran') == $t)>{{ ucfirst($t) }}</option>
                @endforeach
              </select>
            </div>

            <div class="field">
              <label>Orbit radius</label>
              <input type="number" step="0.1" name="orbit_radius" value="{{ old('orbit_radius', optional($item)->orbit_radius ?? 10) }}" required>
            </div>

            <div class="field">
              <label>Radius</label>
              <input type="number" step="0.01" name="radius" value="{{ old('radius', optional($item)->radius ?? 1.0) }}" required>
            </div>

            <div class="field">
              <label>Rotation speed</label>
              <input type="number" step="0.0001" name="rotation_speed" value="{{ old('rotation_speed', optional($item)->rotation_speed ?? 0.01) }}" required>
            </div>

            <div class="field">
              <label>Axial tilt</label>
              <input type="number" step="0.01" name="axial_tilt" value="{{ old('axial_tilt', optional($item)->axial_tilt ?? 0) }}">
            </div>

            <div class="field">
              <label>Has rings</label>
              <select name="has_rings">
                <option value="0" @selected((string) old('has_rings', optional($item)->has_rings ?? 0) === '0')>No</option>
                <option value="1" @selected((string) old('has_rings', optional($item)->has_rings ?? 0) === '1')>Yes</option>
              </select>
            </div>

            <div class="field" style="grid-column:1/-1">
              <label>Meta JSON (optional)</label>
              <textarea name="meta_json">{{ old('meta_json', optional($item)->meta_json ? json_encode(optional($item)->meta_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '') }}</textarea>
              <div class="muted">Example: {"angle": 1.23, "y": 0.05}</div>
            </div>
          </div>
        </div>

        <div>
          <div class="card" style="padding:14px;border:1px solid rgba(255,255,255,.12);border-radius:16px;background:rgba(255,255,255,.03);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
              <strong>Planet Preview</strong>
              <span id="planetPreviewLabel" class="muted">{{ old('type', optional($item)->type ?? 'terran') }}</span>
            </div>

            <div style="height:420px;border-radius:14px;overflow:hidden;background:radial-gradient(circle at center, rgba(90,120,255,.18), rgba(0,0,0,.15) 45%, rgba(0,0,0,.45) 100%);border:1px solid rgba(255,255,255,.08);">
              <model-viewer
                id="planetPreview"
                src=""
                alt="Planet preview"
                camera-controls
                auto-rotate
                shadow-intensity="1"
                exposure="1"
                style="width:100%;height:100%;background:transparent;">
              </model-viewer>
            </div>

            <div class="muted" style="margin-top:10px;">
              The model updates automatically when the planet type changes.
            </div>
          </div>
        </div>
      </div>

      <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap">
        <button class="btn" type="submit">Save</button>
        <a class="btn" href="{{ route('admin.planets.index') }}">← Back</a>
      </div>
    </form>
  </div>

  <script>
    const planetModelMap = {
      biolum: @json(asset('models/DOX_TEXTUR_PLANET_3D/biolum_planet_model.glb')),
      desert: @json(asset('models/DOX_TEXTUR_PLANET_3D/desert_planet_model.glb')),
      gas: @json(asset('models/DOX_TEXTUR_PLANET_3D/gas_planet_model.glb')),
      ice: @json(asset('models/DOX_TEXTUR_PLANET_3D/ice_planet_model.glb')),
      ocean: @json(asset('models/DOX_TEXTUR_PLANET_3D/ocean_planet_model.glb')),
      terran: @json(asset('models/DOX_TEXTUR_PLANET_3D/terran_planet_model.glb')),
      vulcanic: @json(asset('models/DOX_TEXTUR_PLANET_3D/vulcanic_planet_model.glb'))
    };

    const typeSelect = document.getElementById('planetType');
    const preview = document.getElementById('planetPreview');
    const previewLabel = document.getElementById('planetPreviewLabel');

    function updatePlanetPreview() {
      const type = typeSelect.value || 'terran';
      preview.src = planetModelMap[type] || planetModelMap.terran;
      previewLabel.textContent = type;
    }

    typeSelect.addEventListener('change', updatePlanetPreview);
    updatePlanetPreview();
  </script>
@endsection