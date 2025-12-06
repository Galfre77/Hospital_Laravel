@extends('layout')
@section('contenido')

    <h2>Consulta de usuarios</h2>
    <br>
    <table id='usuarios' class="table table-striped">
        <tr><th>NIF</th><th>NOMBRE</th><th>APELLIDOS</th><th>EMAIL</th><th>ADMIN</th><th></th></tr>
        @foreach ($consultaUsuarios as $usuario)
        <tr>
            <td>{{ $usuario->nif }}</td>
            <td>{{ $usuario->nombre }}</td>
            <td>{{ $usuario->apellidos }}</td>
            <td>{{ $usuario->email }}</td>
            <td>{{ $usuario->is_admin }}</td>
            <td><img src="assets/img/{{ $usuario->foto }}"></td>
        </tr>
        @endforeach
    </table>
@endsection
