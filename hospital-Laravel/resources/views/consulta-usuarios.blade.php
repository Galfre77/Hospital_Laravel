@extends('layout')
@section('contenido')

    <h2>Consulta de usuarios</h2>
    <br>
    <table id='usuarios' class="table table-striped">
        <tr><th>NIF</th><th>NOMBRE</th><th>APELLIDOS</th><th>EMAIL</th><th>ADMIN</th><th></th></tr>
        <tr>
            <td>nif</td>
            <td>nombre</td>
            <td>apellidos</td>
            <td>email</td>
            <td>is_admin</td>
            <td><img src="assets/img/sinfoto.jpg"></td>
        </tr>
    </table>
@endsection
