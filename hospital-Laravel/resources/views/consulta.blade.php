@extends('layout')
@section('contenido')
	<h2>Consulta de pacientes</h2>
    <br>
    <form action="{{ Route('consulta.pacientes') }}" method="get">
        <div class="mb-3">
            <label class="form-label">Pacientes a mostrar:</label>
            <select class="form-select" name="mostrar" onchange="this.form.submit()">
                <option value="5"  @selected(request('mostrar') == 5)>5</option>
                <option value="10" @selected(request('mostrar') == 10)>10</option>
                <option value="20" @selected(request('mostrar') == 20)>20</option>
                <option value="50" @selected(request('mostrar') == 50)>50</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Buscar por apellido:</label>
            <input type="search" class="form-control" id="filtro"  name="filtro" value="{{ request('filtro') }}" onkeyup="this.form.submit()">
        </div>
    </form>
    <br>
    @if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    <table id='pacientes' class="table table-striped">
        <tr><th>NIF</th><th>NOMBRE</th><th>APELLIDOS</th><th></th></tr>
        @foreach ($consultaPacientes as $paciente)
            <tr>
                <td>{{ $paciente->nif }}</td>
                <td>{{ $paciente->nombre }}</td>
                <td>{{ $paciente->apellidos }}</td>
                <td>
                    <form action="{{ Route('mantenimiento.paciente', ['idpaciente' => $paciente->idpaciente]) }}" method='GET'>
                        <input type='submit' value='Detalle paciente' >
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $consultaPacientes->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}

@endsection
