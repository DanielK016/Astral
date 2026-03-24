@extends('layouts.app')
@section('title','System #'.$item->id)

@section('content')
  <div class="card" style="max-width:1250px">
    <h1 style="margin:0 0 14px 0;">System #{{ $item->id }} — {{ $item->name }}</h1>

    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:14px">
      <a class="btn" href="{{ route('admin.star-systems.edit', $item) }}">Edit</a>
      <a class="btn" href="{{ route('admin.star-systems.index') }}">← Back</a>
    </div>

    <div style="display:grid;grid-template-columns:.95fr 1.05fr;gap:18px;align-items:start;">
      <div>
        <div class="card" style="padding:14px;border:1px solid rgba(255,255,255,.12);border-radius:16px;background:rgba(255,255,255,.03);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
            <strong>System Information</strong>
            <span class="muted">ID: {{ $item->id }}</span>
          </div>

          <div class="grid grid-2">
            <div class="field">
              <label>Name</label>
              <input value="{{ $item->name }}" disabled>
            </div>

            <div class="field">
              <label>Galaxy ID</label>
              <input value="{{ $item->galaxy_id }}" disabled>
            </div>

            <div class="field">
              <label>X</label>
              <input value="{{ $item->x }}" disabled>
            </div>

            <div class="field">
              <label>Y</label>
              <input value="{{ $item->y }}" disabled>
            </div>

            <div class="field">
              <label>Z</label>
              <input value="{{ $item->z }}" disabled>
            </div>

            <div class="field">
              <label>Selected Sun</label>
              <input value="@if(($item->color_hex ?? '#ffdd99') === '#66aaff') Blue @elseif(($item->color_hex ?? '#ffdd99') === '#ff5555') Red @else Yellow @endif" disabled>
            </div>

            <div class="field">
              <label>Temperature</label>
              <input value="{{ $item->temperature }}" disabled>
            </div>

            <div class="field">
              <label>Base Scale</label>
              <input value="{{ $item->base_scale }}" disabled>
            </div>
          </div>
        </div>

        <div class="card" style="margin-top:16px;">
          <pre style="white-space:pre-wrap;background:rgba(0,0,0,.35);padding:12px;border-radius:12px;border:1px solid rgba(255,255,255,.12);margin:0;">{{ json_encode($item->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
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

    if (!container) {
      console.error('Preview container not found');
    } else {
      const colorHex = @json($item->color_hex ?? '#ffdd99');
      const baseScaleValue = parseFloat(@json($item->base_scale ?? 1.0)) || 1;

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
        const sunUrl = getSunModelByHex(colorHex);

        try {
          const starScene = await loadGLB(sunUrl);
          starObject = starScene;
          starObject.scale.setScalar(2.8 * baseScaleValue);
          systemRoot.add(starObject);
        } catch (e) {
          const fallbackStar = new THREE.Mesh(
            new THREE.SphereGeometry(4 * baseScaleValue, 32, 32),
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

      buildSystemPreview();
      animate();
    }
  </script>
@endsection