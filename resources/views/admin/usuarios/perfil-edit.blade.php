@extends('admin.layout')
@section('title', 'Perfil visual')
@section('page-title', 'Perfil visual')
@section('page-subtitle', $usuario->nombre)

@section('topbar-actions')
  <a href="{{ route('admin.usuarios.show', $usuario) }}" class="btn btn-ghost">
    <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Volver
  </a>
@endsection

@section('content')

<div class="admin-card">
  <div class="admin-card-header">
    <h3 class="admin-card-title">{{ $perfil ? 'Editar perfil visual' : 'Crear perfil visual' }}</h3>
  </div>
  <div class="admin-card-body">
    <form method="POST" action="{{ route('admin.usuarios.perfil.update', $usuario) }}">
      @csrf
      @method('PUT')
      <div class="admin-form-grid">

        <div class="admin-form-group">
          <label class="admin-form-label">Tipo de cara</label>
          <select name="tipo_cara" class="admin-form-select" required>
            <option value="">— Seleccionar —</option>
            @foreach(['ovalada','redonda','cuadrada','corazon','alargada','diamante'] as $tipo)
              <option value="{{ $tipo }}" {{ old('tipo_cara', $perfil->tipo_cara ?? '')==$tipo ? 'selected':'' }}>{{ ucfirst($tipo) }}</option>
            @endforeach
          </select>
          @error('tipo_cara') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
          <label class="admin-form-label">Edad</label>
          <input type="number" name="edad" min="0" max="120" value="{{ old('edad', $perfil->edad ?? '') }}" class="admin-form-input" required>
          @error('edad') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
          <label class="admin-form-label">Sexo</label>
          <select name="sexo" class="admin-form-select" required>
            <option value="">— Seleccionar —</option>
            <option value="femenino" {{ old('sexo', $perfil->sexo ?? '')=='femenino' ? 'selected':'' }}>Femenino</option>
            <option value="masculino" {{ old('sexo', $perfil->sexo ?? '')=='masculino' ? 'selected':'' }}>Masculino</option>
            <option value="otro" {{ old('sexo', $perfil->sexo ?? '')=='otro' ? 'selected':'' }}>Otro</option>
          </select>
          @error('sexo') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
          <label class="admin-form-label">Color preferido</label>
          <input type="text" name="color" value="{{ old('color', $perfil->color ?? '') }}" class="admin-form-input" placeholder="Ej. Negro, Carey, Violeta" required>
          @error('color') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group admin-form-full">
          <label class="admin-form-label">Problema visual</label>
          <input type="text" name="problema_visual" value="{{ old('problema_visual', $perfil->problema_visual ?? '') }}" class="admin-form-input" placeholder="Ej. Miopía, Astigmatismo" required>
          @error('problema_visual') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group admin-form-full">
          <label class="admin-form-label">Síntomas</label>
          <textarea name="sintomas" class="admin-form-textarea" placeholder="Describe los síntomas reportados" required>{{ old('sintomas', $perfil->sintomas ?? '') }}</textarea>
          @error('sintomas') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group admin-form-full">
          <label class="admin-form-label">Estética preferida</label>
          <textarea name="estetica" class="admin-form-textarea" placeholder="Preferencias estéticas de montura, estilo, etc." required>{{ old('estetica', $perfil->estetica ?? '') }}</textarea>
          @error('estetica') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-actions">
          <button type="submit" class="btn btn-primary">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Guardar perfil
          </button>
          <a href="{{ route('admin.usuarios.show', $usuario) }}" class="btn btn-ghost">Cancelar</a>
        </div>

      </div>
    </form>
  </div>
</div>

@endsection
