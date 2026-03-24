@extends('layouts.app')
@section('title','Create System')

@section('content')
  <div class="card" style="max-width:1250px">
    <h1 style="margin:0 0 14px 0;">Create System</h1>

    <form method="post" action="{{ route('admin.star-systems.store') }}">
      @csrf

      <div style="display:grid;grid-template-columns:.95fr 1.05fr;gap:18px;align-items:start;">
        <div>
          <div class="grid grid-2">
            <div class="field">
              <label>Galaxy</label>
              <select name="galaxy_id" required>
                @foreach($galaxies as $g)
                  <option value="{{ $g->id }}" @selected(old('galaxy_id') == $g->id)>
                    #{{ $g->id }} {{ $g->name }}
                  </option>
                @endforeach
              </select>
              @error('galaxy_id')
                <div class="muted" style="color:#ff9a88">{{ $message }}</div>
              @enderror
            </div>

            <div class="field">
              <label>Name</label>
              <input name="name" value="{{ old('name', '') }}" required>
              @error('name')
                <div class="muted" style="color:#ff9a88">{{ $message }}</div>
              @enderror
            </div>

            <div class="field">
              <label>X</label>
              <input type="number" step="0.01" name="x" value="{{ old('x', 0) }}" required>
            </div>

            <div class="field">
              <label>Y</label>
              <input type="number" step="0.01" name="y" value="{{ old('y', 0) }}" required>
            </div>

            <div class="field">
              <label>Z</label>
              <input type="number" step="0.01" name="z" value="{{ old('z', 0) }}" required>
            </div>

            <div class="field">
              <label>Select Sun</label>
              <select id="sunTypeInput" name="color_hex" required>
                <option value="#ffdd99" @selected(old('color_hex', '#ffdd99') == '#ffdd99')>Yellow</option>
                <option value="#ff5555" @selected(old('color_hex', '#ffdd99') == '#ff5555')>Red</option>
                <option value="#66aaff" @selected(old('color_hex', '#ffdd99') == '#66aaff')>Blue</option>
              </select>
            </div>

            <div class="field">
              <label>Temperature</label>
              <input type="number" name="temperature" value="{{ old('temperature', 5800) }}" required>
            </div>

            <div class="field">
              <label>Base Scale</label>
              <input id="baseScaleInput" type="number" step="0.01" name="base_scale" value="{{ old('base_scale', 1.0) }}" required>
            </div>
          </div>

          <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap">
            <button class="btn" type="submit">Save</button>
            <a class="btn" href="{{ route('admin.star-systems.index') }}">← Back</a>
          </div>
        </div>

        <div>
          <div class="card" style="padding:14px;border:1px solid rgba(255,255,255,.12);border-radius:16px;background:rgba(255,255,255,.03);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
              <strong>System Preview</strong>
              <span class="muted">interactive preview</span>
            </div>

            <div id="systemPreview3D" style="width:100%;height:560px;border-radius:14px;overflow:hidden;background:
              radial-gradient(circle at center, rgba(70,90,180,.20), rgba(0,0,0,.20) 45%, rgba(0,0,0,.55) 100%);
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
    import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

    const container = document.getElementById('systemPreview3D');
    const sunTypeInput = document.getElementById('sunTypeInput');
    const baseScaleInput = document.getElementById('baseScaleInput');

    if (!container || !sunTypeInput || !baseScaleInput) {
      console.error('Preview elements not found');
    } else {
      const scene = new THREE.Scene();

      const width = container.clientWidth || 800;
      const height = container.clientHeight || 560;

      const camera = new THREE.PerspectiveCamera(50, width / height, 0.1, 2000);
      camera.position.set(0, 24, 52);

      const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
      renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
      renderer.setSize(width, height);
      renderer.outputColorSpace = THREE.SRGBColorSpace;
      container.appendChild(renderer.domElement);

      const controls = new OrbitControls(camera, renderer.domElement);
      controls.enableDamping = true;
      controls.dampingFactor = 0.06;
      controls.minDistance = 10;
      controls.maxDistance = 180;

      scene.add(new THREE.AmbientLight(0xffffff, 1.2));

      const dirLight = new THREE.DirectionalLight(0xffffff, 1.2);
      dirLight.position.set(25, 30, 20);
      scene.add(dirLight);

      const pointLight = new THREE.PointLight(0xffffff, 2.5, 500);
      pointLight.position.set(0, 0, 0);
      scene.add(pointLight);

      const loader = new GLTFLoader();
      const systemRoot = new THREE.Group();
      scene.add(systemRoot);

      const orbitGroups = [];
      let starObject = null;
      let buildToken = 0;

      const SUN_MODELS = {
        blue: @json(asset('models/DOX_TEXTUR_SUN_3D/blueStar.glb')),
        red: @json(asset('models/DOX_TEXTUR_SUN_3D/redStar.glb')),
        yellow: @json(asset('models/DOX_TEXTUR_SUN_3D/yellowStar.glb'))
      };

      const PLANET_MODELS = [
        @json(asset('models/DOX_TEXTUR_PLANET_3D/biolum_planet_model.glb')),
        @json(asset('models/DOX_TEXTUR_PLANET_3D/desert_planet_model.glb')),
        @json(asset('models/DOX_TEXTUR_PLANET_3D/gas_planet_model.glb')),
        @json(asset('models/DOX_TEXTUR_PLANET_3D/ice_planet_model.glb')),
        @json(asset('models/DOX_TEXTUR_PLANET_3D/ocean_planet_model.glb')),
        @json(asset('models/DOX_TEXTUR_PLANET_3D/terran_planet_model.glb')),
        @json(asset('models/DOX_TEXTUR_PLANET_3D/vulcanic_planet_model.glb'))
      ];

      function getSunModelByHex(hex) {
        if (hex === '#66aaff') return SUN_MODELS.blue;
        if (hex === '#ff5555') return SUN_MODELS.red;
        return SUN_MODELS.yellow;
      }

      function disposeObject(obj) {
        obj.traverse((child) => {
          if (child.geometry) child.geometry.dispose();
          if (child.material) {
            if (Array.isArray(child.material)) {
              child.material.forEach((m) => m.dispose && m.dispose());
            } else if (child.material.dispose) {
              child.material.dispose();
            }
          }
        });
      }

      function clearSystem() {
        while (systemRoot.children.length) {
          const child = systemRoot.children[0];
          systemRoot.remove(child);
          disposeObject(child);
        }
        orbitGroups.length = 0;
        starObject = null;
      }

      function makeOrbitRing(radius) {
        const curve = new THREE.EllipseCurve(0, 0, radius, radius, 0, Math.PI * 2, false, 0);
        const points = curve.getPoints(128).map((p) => new THREE.Vector3(p.x, 0, p.y));
        const geometry = new THREE.BufferGeometry().setFromPoints(points);
        const material = new THREE.LineBasicMaterial({
          color: 0x88aaff,
          transparent: true,
          opacity: 0.28
        });
        return new THREE.LineLoop(geometry, material);
      }

      function loadGLB(url) {
        return new Promise((resolve, reject) => {
          loader.load(url, (gltf) => resolve(gltf.scene), undefined, (err) => reject(err));
        });
      }

      async function buildSystemPreview() {
        const token = ++buildToken;
        clearSystem();

        const baseScale = parseFloat(baseScaleInput.value || '1') || 1;
        const colorHex = sunTypeInput.value || '#ffdd99';
        const sunUrl = getSunModelByHex(colorHex);

        try {
          const starScene = await loadGLB(sunUrl);
          if (token !== buildToken) return;
          starObject = starScene;
          starObject.scale.setScalar(2.8 * baseScale);
          systemRoot.add(starObject);
        } catch (e) {
          const fallbackStar = new THREE.Mesh(
            new THREE.SphereGeometry(4 * baseScale, 32, 32),
            new THREE.MeshStandardMaterial({
              color: colorHex,
              emissive: colorHex,
              emissiveIntensity: 1.6
            })
          );
          starObject = fallbackStar;
          systemRoot.add(starObject);
        }

        const orbitCount = 5;

        for (let i = 0; i < orbitCount; i++) {
          const radius = 9 + i * 6;
          const orbitRing = makeOrbitRing(radius);
          systemRoot.add(orbitRing);

          const orbitGroup = new THREE.Group();
          systemRoot.add(orbitGroup);

          const planetHolder = new THREE.Group();
          planetHolder.position.x = radius;
          orbitGroup.add(planetHolder);

          try {
            const modelUrl = PLANET_MODELS[i % PLANET_MODELS.length];
            const planet = await loadGLB(modelUrl);
            if (token !== buildToken) return;

            const scale = i === 2 ? 1.7 : (0.9 + i * 0.12);
            planet.scale.setScalar(scale);
            planetHolder.add(planet);

            if (i === 3) {
              const ringGeo = new THREE.RingGeometry(2.3, 3.6, 64);
              const ringMat = new THREE.MeshBasicMaterial({
                color: 0xcbbf9a,
                side: THREE.DoubleSide,
                transparent: true,
                opacity: 0.55
              });
              const ring = new THREE.Mesh(ringGeo, ringMat);
              ring.rotation.x = -Math.PI / 2.4;
              planetHolder.add(ring);
            }
          } catch (e) {
            const fallbackPlanet = new THREE.Mesh(
              new THREE.SphereGeometry(1.4 + i * 0.15, 24, 24),
              new THREE.MeshStandardMaterial({ color: 0x88aaff })
            );
            planetHolder.add(fallbackPlanet);
          }

          orbitGroups.push({
            orbitGroup,
            planetHolder,
            speed: 0.0025 + i * 0.0013,
            selfSpeed: 0.01 + i * 0.004
          });
        }
      }

      function animate() {
        requestAnimationFrame(animate);

        if (starObject) {
          starObject.rotation.y += 0.002;
        }

        orbitGroups.forEach((item) => {
          item.orbitGroup.rotation.y += item.speed;
          item.planetHolder.rotation.y += item.selfSpeed;
        });

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
      sunTypeInput.addEventListener('change', buildSystemPreview);
      baseScaleInput.addEventListener('input', buildSystemPreview);

      buildSystemPreview();
      animate();
    }
  </script>
@endsection