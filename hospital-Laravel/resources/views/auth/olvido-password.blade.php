@extends('layout')
@section('contenido')
	<h2>Resetear password</h2>
	<form id='formulario' method='POST' action="{{ route('reset.password') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" id="email"  name="email">
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        </div>
        <br>
        <div class="d-flex justify-content-between">
            <button type="submit" id="forgotpassword" name="forgotpassword" class="btn btn-success">Resetear password</button>
        </div>

	</form>
@endsection
