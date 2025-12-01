<?php

namespace App\Http\Controllers;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class vistaController extends Controller
{
    public function __construct()
{
    // Aplica el middleware de autenticación solo a los métodos indicados.
    // Esto asegura que los usuarios deban estar autenticados para acceder a:
    // - alta: formulario para dar de alta un paciente
    // - consultaPacientes: listado y búsqueda de pacientes
    // - mantenimiento: edición de datos del paciente
    $this->middleware('auth', ['only' => ['alta', 'mantenimiento']]);
}

    public function index()
    {
        return view('inicio');
    }
    public function home()
    {
        return view('home');
    }
    public function registro(){
        return view('auth.registro');
    }
    public function login(){
        return view('auth.login');
    }
    // Método del controlador que gestiona la consulta de pacientes
    public function consultaPacientes(Request $request)
    {
        // Obtener el valor del campo 'filtro' del formulario
        $apellido = $request->input('filtro');


    $consultaPacientes = Paciente::when(request('filtro'), function ($query) {
        $query->where('apellidos', 'like', '%' . request('filtro') . '%');
    })
       ->paginate(request('mostrar', 5))
       ->appends(request()->query());

        // Retornar la vista 'consulta' con la colección de pacientes
        return view('consulta', compact('consultaPacientes'));
    }

    public function alta()
    {
        return view('alta');
    }
    public function consultaUsuarios()
    {
        return view('consulta-usuarios');
    }
    public function mantenimiento($idpaciente = null)
    {
        $paciente = $idpaciente ? Paciente::find($idpaciente) : null;
        $mensaje = session('mensaje');
        return view('mantenimiento', compact('paciente', 'mensaje'));
    }
    public function registroUsuario()
    {
        return view('auth.registro');
    }
    public function loginUsuario(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                // Autenticación exitosa
                return redirect()->intended('/');
            } else {
                // Autenticación fallida
                return back()->withErrors([
                    'email' => 'Las credenciales no son válidas.',
                ])->onlyInput('email');
            }
        }

        return view('auth.login');
    }

}
