@extends('layouts.app')
@section('title','Edit Galaxy')

@section('content')
  <div class="card" style="max-width:1250px">
    <h1 style="margin:0 0 14px 0;">Edit Galaxy</h1>

    <form method="post" action="{{ route('admin.galaxies.update', $item) }}">
      @csrf
      @method('PUT')

      <div style="display:grid;grid-template-columns:.95fr 1.05fr;gap:18px;align-items:start;">
        <div>
          <div class="grid grid-2">
            <div class="field">
              <label>Name</label>
              <input type="text" name="name" value="{{ old('name', $item->name) }}" required>
              @error('name')
                <div class="muted" style="color:#ff9a88">{{ $message }}</div>
              @enderror
            </div>

            <div class="field">
              <label>Seed</label>
              <input id="seedInput" type="number" name="seed" value="{{ old('seed', $item->seed) }}">
              @error('seed')
                <div class="muted" style="color:#ff9a88">{{ $message }}</div>
              @enderror
            </div>

            <div class="field">
              <label>Size (systems)</label>
              <input id="sizeInput" type="number" name="size" value="{{ old('size', $item->size) }}" required>
              @error('size')
                <div class="muted" style="color:#ff9a88">{{ $message }}</div>
              @enderror
            </div>

            <div class="field">
              <label>Arms</label>
              <input id="armsInput" type="number" name="arms" value="{{ old('arms', $item->arms) }}" required>
              @error('arms')
                <div class="muted" style="color:#ff9a88">{{ $message }}</div>
              @enderror
            </div>

            <div class="field" style="grid-column:1 / -1;">
              <label>Notes</label>
              <textarea name="notes">{{ old('notes', $item->notes) }}</textarea>
              @error('notes')
                <div class="muted" style="color:#ff9a88">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap">
            <button class="btn" type="submit">Save</button>
            <a class="btn" href="{{ route('admin.galaxies.index') }}">← Back</a>
          </div>
        </div>

        <div>
          <div class="card" style="padding:14px;border:1px solid rgba(255,255,255,.12);border-radius:16px;background:rgba(255,255,255,.03);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
              <strong>Galaxy Preview</strong>
              <span class="muted">interactive preview</span>
            </div>

            <div id="galaxyPreview3D" style="width:100%;height:560px;border-radius:14px;overflow:hidden;background:
              radial-gradient(circle at center, rgba(55,85,160,.20), rgba(0,0,0,.20) 45%, rgba(0,0,0,.60) 100%);
              border:1px solid rgba(255,255,255,.08);"></div>

            <div class="muted" style="margin-top:10px;">
              You can rotate, zoom in, and zoom out with the mouse.
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <script type="importmap">
  {
    "imports": {
      "three": "https://unpkg.com/three@0.152.2/build/three.module.js",
      "three/addons/": "https://unpkg.com/three@0.152.2/examples/jsm/"
    }
  }
  </script>

  <script type="module">
    import * as THREE from 'three';
    import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

    const container = document.getElementById('galaxyPreview3D');
    const seedInput = document.getElementById('seedInput');
    const sizeInput = document.getElementById('sizeInput');
    const armsInput = document.getElementById('armsInput');

    if (!container || !seedInput || !sizeInput || !armsInput) {
      console.error('Galaxy preview elements not found');
    } else {
      const scene = new THREE.Scene();

      const width = container.clientWidth || 800;
      const height = container.clientHeight || 560;

      const camera = new THREE.PerspectiveCamera(55, width / height, 0.1, 3000);
      camera.position.set(0, 140, 220);

      const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
      renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
      renderer.setSize(width, height);
      renderer.outputColorSpace = THREE.SRGBColorSpace;
      container.appendChild(renderer.domElement);

      const controls = new OrbitControls(camera, renderer.domElement);
      controls.enableDamping = true;
      controls.dampingFactor = 0.06;
      controls.minDistance = 60;
      controls.maxDistance = 600;
      controls.target.set(0, 0, 0);

      scene.add(new THREE.AmbientLight(0xffffff, 0.9));

      const dirLight = new THREE.DirectionalLight(0xffffff, 0.9);
      dirLight.position.set(50, 80, 40);
      scene.add(dirLight);

      const galaxyRoot = new THREE.Group();
      scene.add(galaxyRoot);

      let starsPoints = null;
      let coreMesh = null;
      let buildToken = 0;

      function mulberry32(seed) {
        let t = seed >>> 0;
        return function () {
          t += 0x6D2B79F5;
          let r = Math.imul(t ^ (t >>> 15), 1 | t);
          r ^= r + Math.imul(r ^ (r >>> 7), 61 | r);
          return ((r ^ (r >>> 14)) >>> 0) / 4294967296;
        };
      }

      function clearGalaxy() {
        while (galaxyRoot.children.length) {
          const child = galaxyRoot.children[0];
          galaxyRoot.remove(child);

          if (child.geometry) child.geometry.dispose();
          if (child.material) {
            if (Array.isArray(child.material)) {
              child.material.forEach((m) => m.dispose && m.dispose());
            } else if (child.material.dispose) {
              child.material.dispose();
            }
          }
        }

        starsPoints = null;
        coreMesh = null;
      }

      function buildGalaxyPreview() {
        const token = ++buildToken;
        clearGalaxy();

        const seed = parseInt(seedInput.value || '1', 10) || 1;
        const size = Math.max(20, parseInt(sizeInput.value || '100', 10) || 100);
        const arms = Math.max(2, parseInt(armsInput.value || '4', 10) || 4);

        const random = mulberry32(seed);
        const starCount = Math.min(5000, Math.max(600, size * 18));
        const radiusMax = Math.max(35, size * 0.65);

        const positions = new Float32Array(starCount * 3);
        const colors = new Float32Array(starCount * 3);

        for (let i = 0; i < starCount; i++) {
          const t = i / starCount;
          const arm = i % arms;
          const dist = Math.pow(random(), 0.72) * radiusMax;

          const armAngle = (arm / arms) * Math.PI * 2;
          const twist = dist * 0.07;
          const jitter = (random() - 0.5) * 0.8;
          const angle = armAngle + twist + jitter;

          const thickness = (random() - 0.5) * (4 + dist * 0.02);
          const x = Math.cos(angle) * dist + (random() - 0.5) * 2.2;
          const z = Math.sin(angle) * dist + (random() - 0.5) * 2.2;
          const y = thickness * 0.35;

          positions[i * 3 + 0] = x;
          positions[i * 3 + 1] = y;
          positions[i * 3 + 2] = z;

          const glow = 0.65 + random() * 0.35;
          colors[i * 3 + 0] = glow;
          colors[i * 3 + 1] = 0.78 + random() * 0.2;
          colors[i * 3 + 2] = 1.0;
        }

        if (token !== buildToken) return;

        const starsGeometry = new THREE.BufferGeometry();
        starsGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        starsGeometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));

        const starsMaterial = new THREE.PointsMaterial({
          size: 1.8,
          transparent: true,
          opacity: 0.95,
          vertexColors: true,
          depthWrite: false,
          blending: THREE.AdditiveBlending
        });

        starsPoints = new THREE.Points(starsGeometry, starsMaterial);
        galaxyRoot.add(starsPoints);

        const coreGeometry = new THREE.SphereGeometry(Math.max(4, radiusMax * 0.08), 24, 24);
        const coreMaterial = new THREE.MeshBasicMaterial({
          color: 0xbfd8ff,
          transparent: true,
          opacity: 0.95
        });

        coreMesh = new THREE.Mesh(coreGeometry, coreMaterial);
        galaxyRoot.add(coreMesh);

        galaxyRoot.rotation.x = -0.35;
      }

      function animate() {
        requestAnimationFrame(animate);

        if (starsPoints) {
          starsPoints.rotation.y += 0.0008;
        }

        if (coreMesh) {
          coreMesh.rotation.y += 0.002;
        }

        controls.update();
        renderer.render(scene, camera);
      }

      function onResize() {
        const w = container.clientWidth || 800;
        const h = container.clientHeight || 560;
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
        renderer.setSize(w, h);
      }

      window.addEventListener('resize', onResize);

      seedInput.addEventListener('input', buildGalaxyPreview);
      sizeInput.addEventListener('input', buildGalaxyPreview);
      armsInput.addEventListener('input', buildGalaxyPreview);

      buildGalaxyPreview();
      animate();
    }
  </script>
@endsection