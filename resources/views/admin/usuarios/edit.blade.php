@extends('admin.layout')
@section('title', 'Editar usuario')
@section('page-title', 'Editar usuario')
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
    <h3 class="admin-card-title">Datos de la cuenta</h3>
  </div>
  <div class="admin-card-body">
    <form method="POST" action="{{ route('admin.usuarios.update', $usuario) }}">
      @csrf
      @method('PUT')
      <div class="admin-form-grid">

        <div class="admin-form-group">
          <label class="admin-form-label">Nombre completo</label>
          <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" class="admin-form-input">
          @error('nombre') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
          <label class="admin-form-label">Nombre de usuario</label>
          <input type="text" name="usuario" value="{{ old('usuario', $usuario->usuario) }}" class="admin-form-input">
          @error('usuario') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
          <label class="admin-form-label">Correo electrónico</label>
          <input type="email" name="correo" value="{{ old('correo', $usuario->correo) }}" class="admin-form-input">
          @error('correo') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
          <label class="admin-form-label">Rol</label>
          <select name="rol" class="admin-form-select">
            <option value="usuario" {{ old('rol', $usuario->rol)=='usuario' ? 'selected':'' }}>Usuario</option>
            <option value="admin" {{ old('rol', $usuario->rol)=='admin' ? 'selected':'' }}>Administrador</option>
          </select>
          @error('rol') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
          <label class="admin-form-label">Nueva contraseña</label>
          <input type="password" name="password" class="admin-form-input" placeholder="Dejar en blanco para no cambiar">
          @error('password') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
          <label class="admin-form-label">Confirmar nueva contraseña</label>
          <input type="password" name="password_confirmation" class="admin-form-input" placeholder="Repetir contraseña">
        </div>

        <div class="admin-form-actions">
          <button type="submit" class="btn btn-primary">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Guardar cambios
          </button>
          <a href="{{ route('admin.usuarios.show', $usuario) }}" class="btn btn-ghost">Cancelar</a>
        </div>

      </div>
    </form>
  </div>
</div>

@endsection
