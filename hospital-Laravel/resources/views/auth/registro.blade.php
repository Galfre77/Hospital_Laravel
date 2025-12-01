@extends('layout')
@section('contenido')
<h2>Registro de usuario</h2>
    <form id='formulario' method='POST' action="{{ route('registro.usuarios') }}" enctype="multipart/form-data">
    @csrf
    @if ($errors->any())
        @foreach ($errors->all() as $error)

        @endforeach



        @else
            @if (!empty($mensaje))
                <div class="alert alert-success">
                    {{ $mensaje }}
                </div>
            @endif
        @endif
        <div class="mb-3">
            <label class="form-label">NIF:</label>
            <input type="text" class="form-control" id="nif"  name="nif" value="{{ old('nif') }}">
        </div>
        @if ($errors->first('nif'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('nif') }}
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre"  name="nombre" value="{{ old('nombre')}}">
        </div>
        @if ($errors->first('nombre'))
            <div class="alert alert-danger" role="alert" >
                {{ $errors->first('nombre') }}
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Apellidos:</label>
            <input type="text" class="form-control" id="apellidos"  name="apellidos" value="{{ old('apellidos')}}">
        </div>
        @if ($errors->first('apellidos'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('apellidos') }}
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" id="email"  name="email" value="{{ old('email')}}">
        </div>
        @if ($errors->first('email'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('email') }}
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Foto:</label>
            <input type="file" class="form-control" id="foto"  name="foto" accept="image/*">
        </div>

        @if ($errors->first('foto'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('foto') }}
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Password:</label>
            <input type="password" class="form-control" id="password"  name="password">

        </div>
        @if ($errors->first('password'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('password') }}
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Confirmar Password:</label>
            <input type="password" class="form-control" id="password_confirmation"  name="password_confirmation">
        </div>
        @if ($errors->first('password_confirmation'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('password_confirmation') }}
            </div>
        @endif

        <br>
        <button type="submit" id="registro" name="registro" class="btn btn-success">Registrar</button>
	</form>
@endsection
