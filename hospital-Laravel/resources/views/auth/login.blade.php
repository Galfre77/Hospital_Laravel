@extends('layout')

@section('contenido')
    <h2>Login de usuario</h2>

    {{-- Mensaje flash de éxito --}}
    @if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    <form id="formulario" method="POST" action="{{ route('login.usuarios') }}">
        @csrf

        {{-- Campo NIF --}}
        <div class="mb-3">
            <label class="form-label">NIF:</label>
            <input type="text" class="form-control" id="nif" name="nif" value="{{ old('nif') }}">
            @error('nif')
                <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo Password --}}
        <div class="mb-3">
            <label class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
                <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
        </div>

        {{-- Checkbox "Recuérdame" (mantiene estado si hay error en envío) --}}
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="recordar"
                       {{ old('recordar') ? 'checked' : '' }}>
                <label class="form-check-label" for="flexCheckDefault">
                    Recuérdame
                </label>
            </div>
        </div>


        {{-- Mostrar errores generales --}}
        @if ($errors->any())
            <div class="alert alert-warning">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Botones y enlaces --}}
        <div class="d-flex justify-content-between">
            <button type="submit" id="login" name="login" class="btn btn-success">Login</button>
            <span><a href="{{ route('password.request') }}" class="link-underline-primary fs-6">Olvidé la contraseña</a></span>
            <span><a href="{{ route('registro.usuarios')}}" class="link-underline-primary">Registro</a></span>
        </div>
    </form>
@endsection
