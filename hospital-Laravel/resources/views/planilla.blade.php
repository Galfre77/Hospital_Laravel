@extends('layout')
@section('contenido')
<form>
  @csrf
  <h2>Leistungsnachweis – Registro de Horas</h2>
  <label>Cliente/Proyecto:</label>
  <input type="text" name="cliente" /><br><br>

  <label>Número de Orden:</label>
  <input type="text" name="orden" /><br><br>

  <table border="1" cellpadding="5">
    <thead>
      <tr>
        <th>Día</th>
        <th>Inicio</th>
        <th>Fin</th>
        <th>Pausa (min)</th>
        <th>Total (h)</th>
        <th>Descripción</th>
      </tr>
    </thead>
    <tbody>
      <tr><td>Lunes</td><td><input type="time"></td><td><input type="time"></td><td><input type="number"></td><td><input type="number"></td><td><input type="text"></td></tr>
      <tr><td>Martes</td><td><input type="time"></td><td><input type="time"></td><td><input type="number"></td><td><input type="number"></td><td><input type="text"></td></tr>
      <tr><td>Miércoles</td><td><input type="time"></td><td><input type="time"></td><td><input type="number"></td><td><input type="number"></td><td><input type="text"></td></tr>
      <tr><td>Jueves</td><td><input type="time"></td><td><input type="time"></td><td><input type="number"></td><td><input type="number"></td><td><input type="text"></td></tr>
      <tr><td>Viernes</td><td><input type="time"></td><td><input type="time"></td><td><input type="number"></td><td><input type="number"></td><td><input type="text"></td></tr>
      <tr><td>Sábado</td><td><input type="time"></td><td><input type="time"></td><td><input type="number"></td><td><input type="number"></td><td><input type="text"></td></tr>
      <tr><td>Domingo</td><td><input type="time"></td><td><input type="time"></td><td><input type="number"></td><td><input type="number"></td><td><input type="text"></td></tr>
    </tbody>
  </table><br>

  <label>Total Semanal (horas):</label>
  <input type="number" name="total_semana"><br><br>

  <label>Firma del Cliente:</label>
  <input type="text" name="firma"><br><br>

  <button type="submit">Enviar</button>
</form>
@endsection
