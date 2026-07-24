@extends('admin.layout')
@section('title', 'Nuevo usuario')
@section('page-title', 'Nuevo usuario')
@section('page-subtitle', 'Crear una cuenta manualmente')

@section('topbar-actions')
  <a href="{{ route('admin.usuarios.index') }}" class="btn btn-ghost">
    <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Volver
  </a>
@endsection

@section('content')

<div class="admin-card">
  <div class="admin-card-header">
    <h3 class="admin-card-title">Datos de la cuenta</h3>
  </div>
  <div class="admin-card-body">
    <form method="POST" action="{{ route('admin.usuarios.store') }}">
      @csrf
      <div class="admin-form-grid">

        <div class="admin-form-group">
          <label class="admin-form-label">Nombre completo</label>
          <input type="text" name="nombre" value="{{ old('nombre') }}" class="admin-form-input" placeholder="Ej. Ana Gómez">
          @error('nombre') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
          <label class="admin-form-label">Nombre de usuario</label>
          <input type="text" name="usuario" value="{{ old('usuario') }}" class="admin-form-input" placeholder="Ej. ana.gomez">
          @error('usuario') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
          <label class="admin-form-label">Correo electrónico</label>
          <input type="email" name="correo" value="{{ old('correo') }}" class="admin-form-input" placeholder="correo@ejemplo.com">
          @error('correo') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
          <label class="admin-form-label">Rol</label>
          <select name="rol" class="admin-form-select">
            <option value="usuario" {{ old('rol')=='usuario' ? 'selected':'' }}>Usuario</option>
            <option value="admin" {{ old('rol')=='admin' ? 'selected':'' }}>Administrador</option>
          </select>
          @error('rol') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
          <label class="admin-form-label">Contraseña</label>
          <input type="password" name="password" class="admin-form-input" placeholder="Mínimo 6 caracteres">
          @error('password') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
          <label class="admin-form-label">Confirmar contraseña</label>
          <input type="password" name="password_confirmation" class="admin-form-input" placeholder="Repetir contraseña">
        </div>

        <div class="admin-form-actions">
          <button type="submit" class="btn btn-primary">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Crear usuario
          </button>
          <a href="{{ route('admin.usuarios.index') }}" class="btn btn-ghost">Cancelar</a>
        </div>

      </div>
    </form>
  </div>
</div>

@endsection
