/**
 * ar-tryon.js — Probador AR en vivo (lentes 3D sobre la cámara web)
 * Nebula View 2026
 *
 * Usa MediaPipe Face Landmarker (tasks-vision) para obtener la pose 3D
 * de la cara en cada frame, y Three.js para renderizar el modelo .glb
 * de los lentes alineado con esa pose sobre el video de la cámara.
 *
 * No requiere backend ni build step: todo corre en el navegador vía
 * módulos ES importados desde CDN.
 *
 * Requisitos del navegador: getUserMedia (cámara) — necesita HTTPS o
 * localhost. En WAMP local usa http://localhost/... o http://127.0.0.1/...
 * (no una IP de red local), o instala un certificado local, si no la
 * cámara no se activará.
 */

import * as THREE from 'https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.module.js';
import { GLTFLoader } from 'https://cdn.jsdelivr.net/npm/three@0.160.0/examples/jsm/loaders/GLTFLoader.js';
import {
  FaceLandmarker,
  FilesetResolver,
} from 'https://cdn.jsdelivr.net/npm/@mediapipe/tasks-vision@0.10.14/vision_bundle.mjs';

// ─────────────────────────────────────────────────────────────────────────
// Calibración por modelo: cada .glb suele tener un origen/escala distinto,
// así que aquí se guardan los ajustes finos por modelo. Las claves son la
// URL del .glb (lo que ya trae cada data-glb en el catálogo).
// Usa el panel "Calibrar" dentro del probador para mover los sliders y
// copiar el JSON final, y pégalo aquí para dejarlo guardado de forma fija.
// ─────────────────────────────────────────────────────────────────────────
const CALIBRATION_DEFAULTS = {
  position: { x: 0, y: 0, z: 0 },   // desplazamiento respecto al puente de la nariz
  rotation: { x: 0, y: 0, z: 0 },   // grados, ajuste fino sobre la rotación de la cabeza
  scale: 1.0,                         // escala del modelo respecto al ancho de referencia
};

const MODEL_CALIBRATION = {
  '/models/purple_eyeglasses_3d_model.glb': {
    position: { x: 0, y: 0.01, z: 0.02 },
    rotation: { x: 0, y: 0, z: 0 },
    scale: 1.0,
  },
  '/models/blue-eyeglasses.glb': {
    position: { x: 0, y: 0.01, z: 0.02 },
    rotation: { x: 0, y: 0, z: 0 },
    scale: 1.0,
  },
  // Cualquier otro .glb no listado usa CALIBRATION_DEFAULTS.
};

function getCalibration(glbUrl) {
  const key = new URL(glbUrl, window.location.origin).pathname;
  const found = MODEL_CALIBRATION[key];
  return found
    ? JSON.parse(JSON.stringify(found))
    : JSON.parse(JSON.stringify(CALIBRATION_DEFAULTS));
}

// Índices de landmarks de MediaPipe Face Mesh usados como referencia de
// tamaño de cara (distancia entre ojos), para escalar el modelo.
const LEFT_EYE_OUTER = 33;
const RIGHT_EYE_OUTER = 263;

export class ARTryOn {
  /**
   * @param {Object} opts
   * @param {HTMLVideoElement} opts.video
   * @param {HTMLCanvasElement} opts.canvas
   * @param {HTMLElement} opts.statusEl - elemento donde mostrar mensajes de estado
   */
  constructor({ video, canvas, statusEl }) {
    this.video = video;
    this.canvas = canvas;
    this.statusEl = statusEl;

    this.stream = null;
    this.faceLandmarker = null;
    this.running = false;
    this.rafId = null;

    this.currentGlb = null;
    this.currentModel = null; // THREE.Group actualmente cargado
    this.gltfLoader = new GLTFLoader();
    this.modelCache = new Map();

    this.calibration = JSON.parse(JSON.stringify(CALIBRATION_DEFAULTS));

    this._initThree();
  }

  _setStatus(msg) {
    if (this.statusEl) this.statusEl.textContent = msg || '';
  }

  _initThree() {
    this.renderer = new THREE.WebGLRenderer({
      canvas: this.canvas,
      alpha: true,
      antialias: true,
    });
    this.renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));

    this.scene = new THREE.Scene();

    this.camera = new THREE.PerspectiveCamera(63, 1, 0.01, 100);
    this.camera.position.set(0, 0, 0);

    const hemi = new THREE.HemisphereLight(0xffffff, 0x8866aa, 1.1);
    this.scene.add(hemi);
    const dir = new THREE.DirectionalLight(0xffffff, 1.1);
    dir.position.set(0.5, 1, 1.2);
    this.scene.add(dir);
    const fill = new THREE.DirectionalLight(0xffffff, 0.4);
    fill.position.set(-0.5, -0.3, 1);
    this.scene.add(fill);

    // Grupo raíz que sigue la pose de la cara (posición + rotación).
    this.faceGroup = new THREE.Group();
    this.scene.add(this.faceGroup);

    // Grupo hijo para aplicar la calibración fina por modelo, sin tocar
    // la pose calculada por el face tracker.
    this.calibGroup = new THREE.Group();
    this.faceGroup.add(this.calibGroup);
  }

  async _initFaceLandmarker() {
    if (this.faceLandmarker) return;
    this._setStatus('Cargando modelo de seguimiento facial…');
    const filesetResolver = await FilesetResolver.forVisionTasks(
      'https://cdn.jsdelivr.net/npm/@mediapipe/tasks-vision@0.10.14/wasm'
    );
    this.faceLandmarker = await FaceLandmarker.createFromOptions(filesetResolver, {
      baseOptions: {
        modelAssetPath:
          'https://storage.googleapis.com/mediapipe-models/face_landmarker/face_landmarker/float16/1/face_landmarker.task',
        delegate: 'GPU',
      },
      outputFaceBlendshapes: false,
      outputFacialTransformationMatrixes: true,
      runningMode: 'VIDEO',
      numFaces: 1,
    });
  }

  async start() {
    if (this.running) return;
    this._setStatus('Solicitando acceso a la cámara…');

    try {
      this.stream = await navigator.mediaDevices.getUserMedia({
        video: { facingMode: 'user', width: { ideal: 960 }, height: { ideal: 720 } },
        audio: false,
      });
    } catch (err) {
      this._setStatus('No se pudo acceder a la cámara. Revisa los permisos del navegador.');
      throw err;
    }

    this.video.srcObject = this.stream;
    await this.video.play();

    await this._initFaceLandmarker();

    this._resize();
    window.addEventListener('resize', this._resizeBound || (this._resizeBound = () => this._resize()));

    this.running = true;
    this._setStatus('');
    this._loop();
  }

  stop() {
    this.running = false;
    if (this.rafId) cancelAnimationFrame(this.rafId);
    if (this.stream) {
      this.stream.getTracks().forEach((t) => t.stop());
      this.stream = null;
    }
    if (this._resizeBound) {
      window.removeEventListener('resize', this._resizeBound);
    }
    this.video.srcObject = null;
  }

  _resize() {
    const rect = this.video.getBoundingClientRect();
    const w = Math.max(1, Math.round(rect.width));
    const h = Math.max(1, Math.round(rect.height));
    this.renderer.setSize(w, h, false);
    this.camera.aspect = w / h;
    this.camera.updateProjectionMatrix();
  }

  /** Carga (o reutiliza) un modelo .glb y lo pone activo en la escena. */
  async loadModel(glbUrl) {
    this.currentGlb = glbUrl;
    this.calibration = getCalibration(glbUrl);

    if (this.currentModel) {
      this.calibGroup.remove(this.currentModel);
      this.currentModel = null;
    }

    this._setStatus('Cargando modelo 3D de los lentes…');

    let gltf = this.modelCache.get(glbUrl);
    if (!gltf) {
      gltf = await this.gltfLoader.loadAsync(glbUrl);
      this.modelCache.set(glbUrl, gltf);
    }

    // Clonar para poder tener varios modelos en caché sin compartir transform.
    const model = gltf.scene.clone(true);

    // Normaliza el tamaño del modelo a un ancho de referencia de ~1 unidad
    // (aprox. la distancia interpupilar real en metros), para que la
    // calibración por modelo empiece desde una base consistente.
    const box = new THREE.Box3().setFromObject(model);
    const size = new THREE.Vector3();
    box.getSize(size);
    const refWidth = 0.13; // ~13cm, ancho aproximado de una montura de lentes
    const modelWidth = Math.max(size.x, 0.0001);
    const autoScale = refWidth / modelWidth;
    model.scale.setScalar(autoScale);

    // Centra el modelo en su propio bounding box para que el pivote quede
    // en el centro del objeto (mejor punto de partida para calibrar).
    const centeredBox = new THREE.Box3().setFromObject(model);
    const center = new THREE.Vector3();
    centeredBox.getCenter(center);
    model.position.sub(center);

    this.currentModel = model;
    this.calibGroup.add(model);
    this._applyCalibration();
    this._setStatus('');
    return model;
  }

  /** Aplica this.calibration al calibGroup (posición/rotación/escala fina). */
  _applyCalibration() {
    const c = this.calibration;
    this.calibGroup.position.set(c.position.x, c.position.y, c.position.z);
    this.calibGroup.rotation.set(
      THREE.MathUtils.degToRad(c.rotation.x),
      THREE.MathUtils.degToRad(c.rotation.y),
      THREE.MathUtils.degToRad(c.rotation.z)
    );
    this.calibGroup.scale.setScalar(c.scale);
  }

  /** Actualiza un valor de calibración en vivo (usado por el panel de sliders). */
  setCalibration(partial) {
    this.calibration = {
      position: { ...this.calibration.position, ...(partial.position || {}) },
      rotation: { ...this.calibration.rotation, ...(partial.rotation || {}) },
      scale: partial.scale !== undefined ? partial.scale : this.calibration.scale,
    };
    this._applyCalibration();
  }

  getCalibrationJSON() {
    return JSON.stringify(this.calibration, null, 2);
  }

  _loop() {
    if (!this.running) return;
    this.rafId = requestAnimationFrame(() => this._loop());

    if (this.video.readyState < 2) return; // aún no hay frame de video

    const now = performance.now();
    let result;
    try {
      result = this.faceLandmarker.detectForVideo(this.video, now);
    } catch (e) {
      return;
    }

    const matrices = result && result.facialTransformationMatrixes;
    const hasFace = matrices && matrices.length > 0;

    if (this.currentModel) this.currentModel.visible = hasFace;

    if (hasFace) {
      const m = matrices[0].data; // Float32Array de 16 elementos, column-major
      const mat = new THREE.Matrix4().fromArray(m);

      
      const mirror = new THREE.Matrix4().makeScale(-1, 1, -1);
      mat.multiplyMatrices(mirror, mat);
      mat.multiply(mirror);

      const pos = new THREE.Vector3();
      const quat = new THREE.Quaternion();
      const scl = new THREE.Vector3();
      mat.decompose(pos, quat, scl);

      // MediaPipe da la posición en unidades ~cm relativas a la cámara
      // virtual del propio modelo; la escalamos a metros para nuestra
      // escena three.js.
      this.faceGroup.position.copy(pos).multiplyScalar(0.01);
      this.faceGroup.quaternion.copy(quat);
    }

    this.renderer.render(this.scene, this.camera);
  }
}