
@extends('layout')
@section('contenido')
    <h2>Mantenimiento paciente</h2>
    <br>

    @if ($paciente)

	<form id='formulario' method='post' action="{{ Route('paciente.modificacion', $paciente->idpaciente) }}">
        @csrf

        <input type="hidden" id='idpaciente' name='spoofMethod'value='{{ $paciente->idpaciente }}'>
        <div class="mb-3">
            <label class="form-label">NIF:</label>
            <input type="text" class="form-control" id="nif"  name="nif" value="{{ $paciente->nif}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre"  name="nombre" value="{{ $paciente->nombre}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Apellidos:</label>
            <input type="text" class="form-control" id="apellidos"  name="apellidos" value="{{ $paciente->apellidos}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha Ingreso:</label>
            <input type="date" class="form-control" id="fechaingreso"  name="fechaingreso" value="{{ $paciente->fechaingreso }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha Alta Médica:</label>
            <input type="date" class="form-control" id="fechaalta"  name="fechaalta" value="{{ $paciente->fechaalta }}">
        </div>
        <br>

        <button type="button" id="modificacion" name="modificacion" class="btn btn-primary" onclick="eventFormulario('PUT')">Modificar paciente</button>
        <button type="button" id="baja" name="baja" class="btn btn-danger" onclick="eventFormulario('DELETE')">Baja paciente</button>
        @if ($errors->any())
            <ul>
	        @foreach ($errors->all() as $error) <li>{{$error}}</li> @endforeach
	    	</ul>
        @else
	    	@if (isset($mensaje))
            <div class="alert alert-success">
                {{ $mensaje }}
            </div>
        @endif
        @endif

    </form>
    @endif
    <script>
    function eventFormulario(metodo){
        // Eliminar campo _method si ya existe
        const metodoInput = document.querySelector('input[name="_method"]');
        if (metodoInput) {
            metodoInput.remove();
        }

        // Crear campo oculto _method
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = '_method';
        input.value = metodo;
        document.querySelector('#formulario').appendChild(input);

        // Enviar formulario
        document.querySelector('#formulario').submit();
    }
</script>


@endsection
