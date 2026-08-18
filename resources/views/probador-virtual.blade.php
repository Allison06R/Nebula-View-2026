@extends('layouts.app')

@section('title', 'Probador Virtual — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/probador.css') }}">
@endsection

@section('content')
<!-- HERO -->
<div class="page-hero">
  <div class="page-hero-bg"></div>
  <div class="hero-accent-rect"></div>
  <div class="page-hero-title">
    <h1>Probador Virtual</h1>
    <div class="breadcrumb">
      <a>Pruébate los lentes con tu cámara, en tiempo real</a>
    </div>
  </div>
</div>

<div class="page-content pv-page">

  <div class="pv-stage reveal">

    <!-- ESCENARIO: video + overlay 3D -->
    <div class="pv-viewport" id="pvViewport">
      <div class="pv-mirror" id="pvMirror">
        <video id="pvVideo" autoplay playsinline muted></video>
        <canvas id="pvCanvas"></canvas>
      </div>

      <div class="pv-status" id="pvStatus">
        <div class="pv-status-spinner"></div>
        <span id="pvStatusText">Preparando el probador…</span>
      </div>

      <button class="pv-camera-btn" id="pvCameraBtn" type="button">
        <svg viewBox="0 0 24 24"><path d="M23 7l-7 5 7 5V7z"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
        <span id="pvCameraBtnLabel">Activar cámara</span>
      </button>
    </div>

    <!-- PANEL LATERAL -->
    <div class="pv-panel">

      <div class="pv-panel-block">
        <div class="pv-panel-title">Elige una montura</div>
        <div class="pv-models" id="pvModels">
          <button class="pv-model-thumb active" data-glb="{{ asset('models/purple_eyeglasses_3d_model.glb') }}" data-name="Purple Eyeglasses">
            <img src="{{ asset('images/lentesmorados.jpg') }}" alt="Purple Eyeglasses">
            <span>Purple Eyeglasses</span>
          </button>
          <button class="pv-model-thumb" data-glb="{{ asset('models/blue-eyeglasses.glb') }}" data-name="Blue Eyeglasses">
            <img src="{{ asset('images/lentesmorados.jpg') }}" alt="Blue Eyeglasses" style="filter:hue-rotate(180deg) saturate(1.4);">
            <span>Blue Eyeglasses</span>
          </button>
        </div>
      </div>

      <div class="pv-panel-block">
        <div class="pv-panel-title">Ajuste fino</div>
        <p class="pv-panel-hint">Cada modelo 3D puede necesitar un pequeño ajuste para calzar bien — igual que en Lens Studio.</p>

        <label class="pv-slider">
          <span>Tamaño</span>
          <input type="range" id="pvScale" min="0.3" max="2.5" step="0.01" value="1">
        </label>
        <label class="pv-slider">
          <span>Altura (arriba / abajo)</span>
          <input type="range" id="pvOffsetY" min="-0.4" max="0.4" step="0.005" value="0">
        </label>
        <label class="pv-slider">
          <span>Profundidad (adelante / atrás)</span>
          <input type="range" id="pvOffsetZ" min="-0.4" max="0.4" step="0.005" value="0">
        </label>

        <button class="pv-reset-btn" id="pvReset" type="button">Restablecer ajustes</button>
      </div>

    </div>

  </div>

  <p class="pv-disclaimer">La cámara se procesa localmente en tu navegador — Nebula View no graba ni envía tu video a ningún servidor.</p>

</div>

@endsection

@section('scripts')
<script type="module">
// ══════════════════════════════════════════════════════════════
// PROBADOR VIRTUAL — face tracking + overlay 3D en el navegador
// MediaPipe Face Landmarker (detección de rostro) + Three.js
// (renderizado del modelo .glb sobre el video de la cámara)
// ══════════════════════════════════════════════════════════════
import * as THREE from "https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.module.js";
import { GLTFLoader } from "https://cdn.jsdelivr.net/npm/three@0.160.0/examples/jsm/loaders/GLTFLoader.js";
import { FaceLandmarker, FilesetResolver } from "https://cdn.jsdelivr.net/npm/@mediapipe/tasks-vision@0.10.14";

const video       = document.getElementById('pvVideo');
const canvas      = document.getElementById('pvCanvas');
const cameraBtn   = document.getElementById('pvCameraBtn');
const statusBox   = document.getElementById('pvStatus');
const statusText  = document.getElementById('pvStatusText');
const modelBtns   = document.querySelectorAll('.pv-model-thumb');
const scaleSlider = document.getElementById('pvScale');
const offYSlider  = document.getElementById('pvOffsetY');
const offZSlider  = document.getElementById('pvOffsetZ');
const cameraBtnLabel = document.getElementById('pvCameraBtnLabel');
const resetBtn    = document.getElementById('pvReset');

let faceLandmarker = null;
let renderer, scene, camera3d, glassesGroup, currentModel;
let running = false;
let lastVideoTime = -1;

// Ajustes finos del usuario (independientes por modelo, se guardan en memoria)
const calibrations = {};
function getCalibration(glbUrl) {
  if (!calibrations[glbUrl]) calibrations[glbUrl] = { scale: 1, offsetY: 0, offsetZ: 0 };
  return calibrations[glbUrl];
}

function setStatus(msg, show = true) {
  statusText.textContent = msg;
  statusBox.style.display = show ? 'flex' : 'none';
}

// ── 1. Three.js: escena, cámara y luces ─────────────────────────
function initThree() {
  renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
  renderer.setPixelRatio(window.devicePixelRatio || 1);

  scene = new THREE.Scene();

  // MediaPipe asume una cámara virtual con FOV vertical fijo (~63°)
  // y el origen en el centro de la imagen — replicamos esa cámara
  // en Three.js para que la matriz de transformación de la cara
  // coincida directamente con la posición del modelo 3D.
  camera3d = new THREE.PerspectiveCamera(63, 1, 0.01, 5000);

  const light1 = new THREE.HemisphereLight(0xffffff, 0x443355, 1.1);
  scene.add(light1);
  const light2 = new THREE.DirectionalLight(0xffffff, 0.6);
  light2.position.set(0, 1, 2);
  scene.add(light2);

  glassesGroup = new THREE.Group();
  glassesGroup.matrixAutoUpdate = false;
  scene.add(glassesGroup);
}

// ── 2. Cargar un modelo .glb dentro del grupo ───────────────────
const loader = new GLTFLoader();
function loadModel(glbUrl) {
  setStatus('Cargando montura…');
  loader.load(glbUrl, (gltf) => {
    if (currentModel) glassesGroup.remove(currentModel);
    currentModel = gltf.scene;
    glassesGroup.add(currentModel);

    const cal = getCalibration(glbUrl);
    scaleSlider.value = cal.scale;
    offYSlider.value  = cal.offsetY;
    offZSlider.value  = cal.offsetZ;

    if (running) setStatus('', false);
  }, undefined, (err) => {
    console.error('[Probador] Error cargando el modelo:', err);
    setStatus('No se pudo cargar esta montura.');
  });
}

// ── 3. MediaPipe Face Landmarker ────────────────────────────────
async function initFaceLandmarker() {
  setStatus('Cargando el motor de reconocimiento facial…');
  const filesetResolver = await FilesetResolver.forVisionTasks(
    "https://cdn.jsdelivr.net/npm/@mediapipe/tasks-vision@0.10.14/wasm"
  );
  faceLandmarker = await FaceLandmarker.createFromOptions(filesetResolver, {
    baseOptions: {
      modelAssetPath: "https://storage.googleapis.com/mediapipe-models/face_landmarker/face_landmarker/float16/1/face_landmarker.task",
      delegate: "GPU"
    },
    outputFaceBlendshapes: false,
    outputFacialTransformationMatrixes: true,
    runningMode: "VIDEO",
    numFaces: 1
  });
}

// ── 4. Cámara del usuario ───────────────────────────────────────
async function startCamera() {
  try {
    setStatus('Solicitando acceso a la cámara…');
    const stream = await navigator.mediaDevices.getUserMedia({
      video: { width: 640, height: 480, facingMode: 'user' }
    });
    video.srcObject = stream;
    await video.play();

    canvas.width  = video.videoWidth  || 640;
    canvas.height = video.videoHeight || 480;
    renderer.setSize(canvas.width, canvas.height, false);
    camera3d.aspect = canvas.width / canvas.height;
    camera3d.updateProjectionMatrix();

    running = true;
    cameraBtn.classList.add('active');
    cameraBtn.querySelector('svg + span, span')?.remove; // no-op guard
    setStatus('Buscando tu rostro…');
    requestAnimationFrame(renderLoop);
  } catch (err) {
    console.error('[Probador] No se pudo activar la cámara:', err);
    setStatus('No pudimos acceder a tu cámara. Revisa los permisos del navegador.');
  }
}

function stopCamera() {
  running = false;
  const stream = video.srcObject;
  if (stream) stream.getTracks().forEach(t => t.stop());
  video.srcObject = null;
  cameraBtn.classList.remove('active');
  setStatus('Cámara desactivada.');
}

// ── 5. Loop principal: detectar rostro + posicionar el modelo ──
function renderLoop() {
  if (!running) return;

  if (faceLandmarker && video.currentTime !== lastVideoTime) {
    lastVideoTime = video.currentTime;
    const results = faceLandmarker.detectForVideo(video, performance.now());

    if (results.facialTransformationMatrixes && results.facialTransformationMatrixes.length > 0) {
      const matrixData = results.facialTransformationMatrixes[0].data;
      glassesGroup.matrix.fromArray(matrixData);

      // Ajuste fino del usuario encima de la matriz detectada
      const glbUrl = currentModel ? currentModel.userData.glbUrl : null;
      const cal = glbUrl ? getCalibration(glbUrl) : { scale: 1, offsetY: 0, offsetZ: 0 };

      const fine = new THREE.Matrix4()
        .makeTranslation(0, cal.offsetY, cal.offsetZ)
        .multiply(new THREE.Matrix4().makeScale(cal.scale, cal.scale, cal.scale));

      glassesGroup.matrix.multiply(fine);
      glassesGroup.visible = true;
      if (statusBox.style.display !== 'none') setStatus('', false);
    } else {
      glassesGroup.visible = false;
      setStatus('No detectamos tu rostro — acércate o mejora la luz.');
    }
  }

  renderer.render(scene, camera3d);
  requestAnimationFrame(renderLoop);
}

// ── 6. Controles de la interfaz ─────────────────────────────────
cameraBtn.addEventListener('click', () => {
  if (running) { stopCamera(); return; }
  startCamera();
});

modelBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    modelBtns.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const glbUrl = btn.getAttribute('data-glb');
    loadModel(glbUrl);
    // Se guarda el glbUrl actual para leer su calibración en el loop
    const checkLoaded = setInterval(() => {
      if (currentModel) {
        currentModel.userData.glbUrl = glbUrl;
        clearInterval(checkLoaded);
      }
    }, 50);
  });
});

function applyCalibrationFromSliders() {
  const active = document.querySelector('.pv-model-thumb.active');
  if (!active) return;
  const glbUrl = active.getAttribute('data-glb');
  const cal = getCalibration(glbUrl);
  cal.scale   = parseFloat(scaleSlider.value);
  cal.offsetY = parseFloat(offYSlider.value);
  cal.offsetZ = parseFloat(offZSlider.value);
}
[scaleSlider, offYSlider, offZSlider].forEach(el => el.addEventListener('input', applyCalibrationFromSliders));

resetBtn.addEventListener('click', () => {
  scaleSlider.value = 1; offYSlider.value = 0; offZSlider.value = 0;
  applyCalibrationFromSliders();
});

// ── 7. Arranque ──────────────────────────────────────────────────
(async function boot() {
  initThree();
  const firstBtn = document.querySelector('.pv-model-thumb.active');
  loadModel(firstBtn.getAttribute('data-glb'));
  const checkLoaded = setInterval(() => {
    if (currentModel) {
      currentModel.userData.glbUrl = firstBtn.getAttribute('data-glb');
      clearInterval(checkLoaded);
    }
  }, 50);

  try {
    await initFaceLandmarker();
    setStatus('Todo listo — activa tu cámara para probarte los lentes.');
  } catch (err) {
    console.error('[Probador] Error cargando el motor facial:', err);
    setStatus('No se pudo cargar el reconocimiento facial. Revisa tu conexión.');
  }
})();

window.addEventListener('beforeunload', stopCamera);
</script>
@endsection