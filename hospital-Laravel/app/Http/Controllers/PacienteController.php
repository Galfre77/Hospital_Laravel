<?php

namespace App\Http\Controllers;
use App\Models\Paciente;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth as FacadesAuth;


class PacienteController extends Controller
{
    protected $mensaje = [
        'nif.required'          => 'El nif es obligatorio.',
        'nif.string'            => 'El nif deve contener una letra.',
        'nif.max'               => 'El nif no debe exceder 9 caracteres.',
        'nif.unique'            => 'El nif ya existe en la base de datos.',
        'nombre.required'       => 'El nombre es obligatorio',
        'apellidos.required'    => 'Los apellidos son obligatorios',
        'fechaingreso.required' => 'La fecha de ingreso es obligatoria',
        'fechaingreso.date'     => 'La fecha de ingreso no es correcta',
    ];



    public function pacienteAlta(Request $request)
    {

        $datosAlta = $request->all();
        //validamos los datos del formulario
        $validar   = validator($datosAlta , Paciente::reglas($idpaciente = null), $this->mensaje);
        if ($validar->fails()){
            return redirect()->route('alta.paciente')->withErrors($validar)->withInput();
        }
        //llamamos al modelo para dar de alta el paciente
        Paciente::alta($datosAlta);
        return redirect()->route('alta.paciente')->with('mensaje', 'Paciente dado de alta correctamente');
    }
    public function pacienteModificacion(Request $request, $idpaciente)
    {
        // Recoger los datos del formulario
        $datosModificacion = $request->all();
        // Validar los datos del formulario
        $validar = validator($datosModificacion, Paciente::reglas($idpaciente), $this->mensaje);
        if ($validar->fails()){
            return redirect()->route('mantenimiento.paciente', ['idpaciente' => $idpaciente])->withErrors($validar)->withInput();
        }
        $paciente = Paciente::where('idpaciente', $idpaciente)->first();
        if (!$paciente) {
            return redirect()->route('mantenimiento.paciente')->withErrors(['paciente' => 'Paciente no encontrado'])->withInput();
        }
        $paciente->modificacion($request->all());
        $mensaje = 'Paciente modificado correctamente';
        return view('mantenimiento', compact('paciente', 'mensaje'));
    }
    public function borrar($idpaciente)
    {
        // Busca el paciente por ID o lanza error 404 si no existe
        $paciente = Paciente::findOrFail($idpaciente);
        // Guarda el nombre o apellidos antes de eliminarlo
        $nombre   = strtoupper($paciente->apellidos); //strtoupper para poner en mayúsculas
        // Elimina el paciente
        $paciente->borrar($idpaciente);
        // Mensaje personalizado
        $mensaje  = 'Paciente ' . $nombre . ' se ha borrado correctamente';
        // Redirige a la vista general de pacientes
        return redirect()->route('consulta.pacientes')->with('mensaje', $mensaje);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!FacadesAuth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Credenciales inválidas'])->withInput();
        }
        return redirect()->route('dashboard');
    }
    public function logout(Request $request)
    {
        // Lógica para cerrar sesión
    }

}
