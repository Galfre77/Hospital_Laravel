@extends('layout')
@section('contenido')
	<h2>Resetear password</h2>
	<form id='formulario' method='POST' action="">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" id="email"  name="email">
        </div>

            <div class="alert alert-danger" role="alert">

            </div>

        <div class="mb-3">
            <label class="form-label">Password:</label>
            <input type="password" class="form-control" id="password"  name="password">
        </div>

            <div class="alert alert-danger" role="alert">

            </div>

        <div class="mb-3">
            <label class="form-label">Confirmar Password:</label>
            <input type="password" class="form-control" id="password_confirmation"  name="password_confirmation">
        </div>

            <div class="alert alert-danger" role="alert">

            </div>

        <input type="hidden" name="token">

        <div class="d-flex justify-content-between">
            <button type="submit" id="forgotpassword" name="forgotpassword" class="btn btn-success">Resetear password</button>
        </div>
        <br>

        <div class="alert alert-success" role="success">

        </div>

	</form>
@endsection
