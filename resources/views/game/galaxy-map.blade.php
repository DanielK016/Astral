@extends('layouts.fullscreen')
@section('title', 'Galaxy Map — '.$galaxy->name)

@push('head')
<style>
  :root{
    --c-cyan:#00aaff;
    --c-cyan2:#88ddff;
    --c-gold:#ffaa00;
    --bg: #020210;
  }
  html,body{margin:0;height:100%;overflow:hidden;font-family:Arial, sans-serif;background:var(--bg);}
  #info{
    position:absolute;top:20px;left:20px;z-index:10;color:#fff;
    background:rgba(0,0,0,0.68);padding:14px 22px;border-radius:12px;
    backdrop-filter: blur(8px);border:1px solid var(--c-cyan);
    box-shadow:0 0 26px rgba(0,160,255,.35);
    pointer-events:none;
  }
  #info h1{margin:0 0 6px 0;font-size:18px;letter-spacing:.5px}
  #info p{margin:0;font-size:13px;color:#d9f3ff}
  #new-galaxy{
    position:absolute;top:20px;left:50%;transform:translateX(-50%);
    z-index:20;color:#fff;background:rgba(0,0,0,.6);
    padding:12px 26px;border-radius:30px;border:1px solid var(--c-cyan);
    backdrop-filter: blur(8px);cursor:pointer;user-select:none;
    box-shadow:0 0 22px rgba(0,160,255,.25);
    transition:.15s;
  }
  #new-galaxy:hover{background:rgba(0,160,255,.18);box-shadow:0 0 26px rgba(0,160,255,.45);}
  #mode-indicator{
    position:absolute;top:20px;right:20px;z-index:10;color:var(--c-gold);
    background:rgba(0,0,0,.55);padding:10px 18px;border-radius:30px;
    border:1px solid var(--c-gold);backdrop-filter: blur(6px);
    box-shadow:0 0 18px rgba(255,170,0,.25);
    font-weight:700;
  }
  #controls{
    position:absolute;bottom:20px;left:20px;z-index:10;color:#d6d6de;
    background:rgba(20,20,30,.88);padding:12px 18px;border-radius:10px;
    border-left:4px solid var(--c-cyan);backdrop-filter: blur(4px);
    line-height:1.65;font-size:13px;pointer-events:none;
    max-width:min(520px, calc(100vw - 40px));
  }
  .hl{color:var(--c-cyan2);font-weight:700}
</style>

<script type="importmap">
{
  "imports": {
    "three": "https://unpkg.com/three@0.128.0/build/three.module.js",
    "three/addons/": "https://unpkg.com/three@0.128.0/examples/jsm/"
  }
}
</script>
@endpush

@section('content')
  <div id="info">
    <h1>🌌 Galaxy · Map View</h1>
    <p>Click a star to enter the system · <span class="hl">L</span> toggles hyperlanes</p>
  </div>
  <div id="new-galaxy">🔄 New Game</div>
  <div id="mode-indicator">Hyperlanes: <span id="map-mode">OFF</span></div>
  <div id="controls">
    <span class="hl">WASD</span> — movement · <span class="hl">Q/E</span> — up/down · <span class="hl">Mouse</span> — rotate/zoom<br>
    Tip: returning from a system restores focus to the previously selected star.
  </div>
@endsection

@push('scripts')
<script type="module">
  import * as THREE from 'three';
  import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
  import { EffectComposer } from 'three/addons/postprocessing/EffectComposer.js';
  import { RenderPass } from 'three/addons/postprocessing/RenderPass.js';
  import { UnrealBloomPass } from 'three/addons/postprocessing/UnrealBloomPass.js';
  import { ShaderPass } from 'three/addons/postprocessing/ShaderPass.js';
  import { FXAAShader } from 'three/addons/shaders/FXAAShader.js';

  // Data provided by Laravel
  const galaxyData = @json($payload);
  const focusId = @json($focusId);

  // =====================
  // Scene / renderer
  // =====================
  const scene = new THREE.Scene();
  scene.background = new THREE.Color(0x020210);
  scene.fog = new THREE.FogExp2(0x020210, 0.00155);

  const camera = new THREE.PerspectiveCamera(65, window.innerWidth / window.innerHeight, 0.1, 5000);
  camera.position.set(210, 160, 420);

  const renderer = new THREE.WebGLRenderer({ antialias: true, powerPreference: "default" });
  renderer.setSize(window.innerWidth, window.innerHeight);
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.5));
  renderer.outputEncoding = THREE.sRGBEncoding;
  renderer.toneMapping = THREE.ReinhardToneMapping;
  renderer.toneMappingExposure = 1.45;
  document.body.appendChild(renderer.domElement);

  const controls = new OrbitControls(camera, renderer.domElement);
  controls.enableDamping = true;
  controls.dampingFactor = 0.06;
  controls.rotateSpeed = 0.85;
  controls.enableZoom = true;
  controls.zoomSpeed = 1.15;
  controls.enablePan = false;
  controls.minDistance = 20;
  controls.maxDistance = 2200;

  // Lighting
  scene.add(new THREE.AmbientLight(0x404060, 1.0));
  const coreLight = new THREE.PointLight(0x88aaff, 1.1, 900);
  coreLight.position.set(0,0,0);
  scene.add(coreLight);
  const dir1 = new THREE.DirectionalLight(0x446688, 0.55);
  dir1.position.set(1,1,1);
  scene.add(dir1);

  // Background stars
  function createStarPointTexture(res=64){
    const c = document.createElement('canvas');
    c.width=c.height=res;
    const ctx = c.getContext('2d');
    const g = ctx.createRadialGradient(res/2,res/2,0,res/2,res/2,res/2);
    g.addColorStop(0,'rgba(255,255,255,1)');
    g.addColorStop(0.45,'rgba(220,220,255,0.85)');
    g.addColorStop(0.7,'rgba(140,160,255,0.25)');
    g.addColorStop(1,'rgba(0,0,0,0)');
    ctx.fillStyle=g;
    ctx.fillRect(0,0,res,res);
    const tex = new THREE.CanvasTexture(c);
    tex.needsUpdate = true;
    return tex;
  }
  const starPointTex = createStarPointTexture(64);

  const bgCount = 26000;
  const bgGeo = new THREE.BufferGeometry();
  const bgPos = new Float32Array(bgCount*3);
  for(let i=0;i<bgCount;i++){
    const rad = 900 + Math.random()*1500;
    const theta = Math.random()*Math.PI*2;
    const phi = Math.acos(2*Math.random()-1);
    bgPos[i*3]   = rad*Math.sin(phi)*Math.cos(theta);
    bgPos[i*3+1] = rad*Math.sin(phi)*Math.sin(theta);
    bgPos[i*3+2] = rad*Math.cos(phi);
  }
  bgGeo.setAttribute('position', new THREE.BufferAttribute(bgPos,3));
  const bgMat = new THREE.PointsMaterial({
    color: 0x9aa0aa,
    size: 1.05,
    map: starPointTex,
    transparent:true,
    opacity:0.55,
    depthWrite:false,
    blending:THREE.AdditiveBlending
  });
  scene.add(new THREE.Points(bgGeo,bgMat));

  // Active stars
  function createStarSurfaceTexture(colorHex, seed){
    const size = 256;
    const canvas = document.createElement('canvas');
    canvas.width = canvas.height = size;
    const ctx = canvas.getContext('2d');
    const img = ctx.createImageData(size, size);
    const data = img.data;

    function rnd2(x,y){
      let n = (x*374761393 + y*668265263 + seed*1442695041) | 0;
      n = Math.imul(n ^ (n >>> 13), 1274126177);
      return ((n ^ (n >>> 16)) >>> 0) / 4294967296;
    }

    const base = new THREE.Color(colorHex);
    for(let y=0;y<size;y++){
      for(let x=0;x<size;x++){
        const dx = (x/(size-1))*2-1;
        const dy = (y/(size-1))*2-1;
        const r2 = dx*dx + dy*dy;
        const idx = (y*size + x)*4;
        if(r2>1){
          data[idx+3]=0;
          continue;
        }
        const n = rnd2(x,y);
        const t = Math.pow(1 - r2, 0.45);
        const f = 0.7 + 0.6*n;
        const c = base.clone().multiplyScalar(0.85 + 0.35*f).lerp(new THREE.Color(0xffffff), 0.08 + 0.10*n);
        data[idx]   = Math.max(0,Math.min(255, Math.round(c.r*255*t + 10)));
        data[idx+1] = Math.max(0,Math.min(255, Math.round(c.g*255*t + 10)));
        data[idx+2] = Math.max(0,Math.min(255, Math.round(c.b*255*t + 10)));
        data[idx+3] = Math.round(255 * (0.15 + 0.85*t));
      }
    }
    ctx.putImageData(img,0,0);

    const g = ctx.createRadialGradient(size/2,size/2,0,size/2,size/2,size/2);
    g.addColorStop(0, 'rgba(255,255,255,0.60)');
    g.addColorStop(0.35, 'rgba(255,255,255,0.18)');
    g.addColorStop(0.75, 'rgba(0,0,0,0)');
    ctx.fillStyle = g;
    ctx.globalCompositeOperation = 'screen';
    ctx.fillRect(0,0,size,size);
    ctx.globalCompositeOperation = 'source-over';

    const tex = new THREE.CanvasTexture(canvas);
    tex.needsUpdate = true;
    tex.encoding = THREE.sRGBEncoding;
    return tex;
  }

  const stars = galaxyData.stars;
  const byId = new Map(stars.map(s => [s.id, s]));
  const activeStars = [];
  const starGeo = new THREE.SphereGeometry(2, 24, 24);

  stars.forEach((s, idx) => {
    const col = new THREE.Color(s.color);
    const tex = createStarSurfaceTexture(s.color, (galaxyData.seed + idx*9973)>>>0);

    const mat = new THREE.MeshStandardMaterial({
      map: tex,
      emissive: col,
      emissiveIntensity: 1.0,
      roughness: 0.35,
      metalness: 0.05
    });

    const mesh = new THREE.Mesh(starGeo, mat);
    mesh.position.set(s.position[0], s.position[1], s.position[2]);
    mesh.scale.set(s.baseScale, s.baseScale, s.baseScale);

    mesh.userData = {
      id: s.id,
      name: s.name,
      temperature: s.temperature,
      color: col,
      baseScale: s.baseScale
    };

    scene.add(mesh);
    activeStars.push(mesh);

    const coronaGeo = new THREE.SphereGeometry(2.6, 18, 18);
    const coronaMat = new THREE.MeshBasicMaterial({
      color: col,
      transparent: true,
      opacity: 0.16,
      side: THREE.BackSide,
      blending: THREE.AdditiveBlending,
      depthWrite: false
    });
    const corona = new THREE.Mesh(coronaGeo, coronaMat);
    corona.scale.set(s.baseScale*1.25, s.baseScale*1.25, s.baseScale*1.25);
    corona.position.copy(mesh.position);
    scene.add(corona);
    mesh.userData.corona = corona;
  });

  // Hyperlanes
  const lineMaterial = new THREE.LineBasicMaterial({ color: 0x88aaff, opacity: 0.65, transparent: true });
  const lineSegments = [];
  for(const link of galaxyData.links){
    const a = byId.get(link.a)?.position;
    const b = byId.get(link.b)?.position;
    if(!a || !b) continue;
    const geometry = new THREE.BufferGeometry().setFromPoints([
      new THREE.Vector3(a[0],a[1],a[2]),
      new THREE.Vector3(b[0],b[1],b[2])
    ]);
    const line = new THREE.Line(geometry, lineMaterial);
    line.visible = false;
    scene.add(line);
    lineSegments.push(line);
  }

  let linesVisible = false;
  const mapModeEl = document.getElementById('map-mode');
  window.addEventListener('keydown', (e) => {
    if(e.code === 'KeyL'){
      linesVisible = !linesVisible;
      for(const l of lineSegments) l.visible = linesVisible;
      mapModeEl.textContent = linesVisible ? 'ON' : 'OFF';
      e.preventDefault();
    }
  });

  // Postprocessing
  const composer = new EffectComposer(renderer);
  composer.addPass(new RenderPass(scene, camera));
  const bloomPass = new UnrealBloomPass(
    new THREE.Vector2(window.innerWidth, window.innerHeight),
    0.95,
    0.55,
    0.25
  );
  composer.addPass(bloomPass);
  const fxaa = new ShaderPass(FXAAShader);
  fxaa.uniforms['resolution'].value.set(1 / window.innerWidth, 1 / window.innerHeight);
  composer.addPass(fxaa);

  // Interaction
  const raycaster = new THREE.Raycaster();
  const mouse = new THREE.Vector2();
  let hoveredStar = null;

  function setHover(star){
    if(hoveredStar === star) return;
    if(hoveredStar){
      hoveredStar.scale.set(hoveredStar.userData.baseScale, hoveredStar.userData.baseScale, hoveredStar.userData.baseScale);
    }
    hoveredStar = star;
    if(hoveredStar){
      hoveredStar.scale.set(hoveredStar.userData.baseScale*1.9, hoveredStar.userData.baseScale*1.9, hoveredStar.userData.baseScale*1.9);
    }
    renderer.domElement.style.cursor = hoveredStar ? 'pointer' : 'default';
  }

  renderer.domElement.addEventListener('mousemove', (event) => {
    mouse.x = (event.clientX / renderer.domElement.clientWidth) * 2 - 1;
    mouse.y = -(event.clientY / renderer.domElement.clientHeight) * 2 + 1;

    raycaster.setFromCamera(mouse, camera);
    const hits = raycaster.intersectObjects(activeStars, false);
    if(hits.length) setHover(hits[0].object);
    else setHover(null);
  });

  renderer.domElement.addEventListener('click', () => {
    raycaster.setFromCamera(mouse, camera);
    const hits = raycaster.intersectObjects(activeStars, false);
    if(!hits.length) return;
    const star = hits[0].object;
    window.location.href = `/system/${encodeURIComponent(star.userData.id)}`;
  });

  // WASD movement
  const keyState = { w:false,a:false,s:false,d:false,q:false,e:false };
  window.addEventListener('keydown', (e) => {
    if(e.code==='KeyW') keyState.w=true;
    if(e.code==='KeyA') keyState.a=true;
    if(e.code==='KeyS') keyState.s=true;
    if(e.code==='KeyD') keyState.d=true;
    if(e.code==='KeyQ') keyState.q=true;
    if(e.code==='KeyE') keyState.e=true;
  });
  window.addEventListener('keyup', (e) => {
    if(e.code==='KeyW') keyState.w=false;
    if(e.code==='KeyA') keyState.a=false;
    if(e.code==='KeyS') keyState.s=false;
    if(e.code==='KeyD') keyState.d=false;
    if(e.code==='KeyQ') keyState.q=false;
    if(e.code==='KeyE') keyState.e=false;
  });

  const forward = new THREE.Vector3();
  const right = new THREE.Vector3();
  const moveSpeed = 2.1;

  function applyFocus(){
    if(focusId == null) return;
    const id = Number(focusId);
    const mesh = activeStars.find(s => s.userData.id === id);
    if(!mesh) return;
    const target = mesh.position.clone();
    controls.target.copy(target);
    const off = new THREE.Vector3(55, 35, 85);
    camera.position.copy(target.clone().add(off));
    controls.update();
  }
  applyFocus();

  document.getElementById('new-galaxy').addEventListener('click', () => {
    window.location.href = `/new-game/difficulty`;
  });

  function animate(){
    requestAnimationFrame(animate);
    const t = performance.now()*0.001;
    for(const s of activeStars){
      if(s.userData.corona){
        s.userData.corona.material.opacity = 0.12 + 0.06*Math.sin(t*1.3 + s.userData.id*0.7);
      }
    }

    camera.getWorldDirection(forward);
    forward.y = 0; forward.normalize();
    right.set(forward.z, 0, -forward.x).normalize();

    const move = new THREE.Vector3(0,0,0);
    if(keyState.w) move.addScaledVector(forward, moveSpeed);
    if(keyState.s) move.addScaledVector(forward, -moveSpeed);
    if(keyState.a) move.addScaledVector(right, -moveSpeed);
    if(keyState.d) move.addScaledVector(right, moveSpeed);
    if(keyState.q) move.y -= moveSpeed;
    if(keyState.e) move.y += moveSpeed;

    if(move.lengthSq() > 0){
      camera.position.add(move);
      controls.target.add(move);
    }

    controls.update();
    composer.render();
  }
  animate();

  window.addEventListener('resize', () => {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
    composer.setSize(window.innerWidth, window.innerHeight);
    fxaa.uniforms['resolution'].value.set(1 / window.innerWidth, 1 / window.innerHeight);
  });
</script>
@endpush
