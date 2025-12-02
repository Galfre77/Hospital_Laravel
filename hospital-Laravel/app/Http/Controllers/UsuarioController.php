<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class UsuarioController extends Controller
{
    public function resetPasswordForm()
    {
        return view('auth.reset_password');
    }
    public function registro()
    {
        return view('auth.registro');
    }
    // Reglas de validación
    protected $reglas = [
        'nombre'    => 'required|string|max:50',
        'apellidos' => 'required|string|max:50',
        'email'     => 'required|string|email|max:255|unique:usuarios',
        'password'  => 'required|string|min:4|confirmed',
        'nif'       => 'required|string|max:9|unique:usuarios',
        'foto'      => 'nullable|image|max:2048' , // La foto es opcional y debe ser una imagen
    ];
    // Mensajes de error personalizados
    protected $mensajes = [
        'required'  => 'El campo :attribute es obligatorio.',
        'string'    => 'El campo :attribute debe ser una cadena de texto.',
        'max'       => 'El campo :attribute no debe exceder los :max caracteres.',
        'email'     => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
        'unique'    => 'El campo :attribute ya está en uso.',
        'min'       => 'El campo :attribute debe tener al menos :min caracteres.',
        'confirmed' => 'La confirmación de :attribute no coincide.',
    ];
    public function registroUsuario(Request $request)
    {
        // Recogemos los datos del formulario
        $datos = $request->all();
        // Validamos los datos del formulario
        $validar   = validator($datos, $this->reglas, $this->mensajes);
        //echo "<pre>";
        //var_dump($validar ->errors());
        //echo "</pre>";
        //exit;
        if ($validar->fails()){
            return back()->withErrors($validar)->withInput();
        }
        // Llamamos al modelo para dar de alta el usuario
        Usuario::altaRegistro($request);//Pasamos el objeto original, mantiene todos los métodos de la clase Request
        return to_route('login')->with('status', 'Cuenta creada');
    }

    public function login(Request $request)
    {
        $usuario = Usuario::where('nif', $request->input('nif'))->first();


        if ($usuario && password_verify($request->input('password'), $usuario->password)) {
            // Autenticar al usuario

            Auth::login($usuario);
            return to_route('home')->with('status', 'Inicio de sesión exitoso');
        } else {
            return back()->withErrors(['nif' => 'Credenciales inválidas'])->withInput();
        }
    }
    public function logout(Request $request)
    {

        Auth::logout();

        return to_route('home')->with('status', 'Has cerrado sesión correctamente');
    }
    public function resetPassword(Request $request){
        $email = $request->input('email');
        // llamar a  la función para obtener el usuario por email
        $usuario = Usuario::obtenerUsuarioPorEmail($email);
        if (!$usuario) {
            return back()->withErrors(['email' => 'No existe un usuario con este email.'])->withInput();
        }
        // Generar una nueva contraseña temporal
        $nuevaPassword = Str::random(8);

        // Actualizar la contraseña en la base de datos
        $usuario->password = Hash::make($nuevaPassword);
        $usuario->save();

        // Aquí podrías enviar un email con la nueva contraseña
        // Mail::to($usuario->email)->send(new NuevaPasswordMail($nuevaPassword));
        // Por simplicidad, solo retornamos un mensaje de éxito.


        return back()->with('status', $email.' La nueva contraseña es: ' . $nuevaPassword . ' esto es un ejemplo, en un entorno real deberías enviar la nueva contraseña por email.');
    }
    public function olvidoPasswordForm()
    {
        return view('auth.olvido-password');
    }

    public function restablecerPassword(Request $request)
    {
        // Validar el email
        $request->validate([
            'email' => 'required|email|exists:usuarios,email'
        ], [
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Debe ser un email válido.',
            'email.exists' => 'No existe un usuario con este email.'
        ]);

        // Buscar el usuario
        $usuario = Usuario::where('email', $request->email)->first();

        if ($usuario) {
            // Generar nueva contraseña temporal
          //  $nuevaPassword = str_random(8);

            // Actualizar la contraseña en la base de datos
          //  $usuario->password = bcrypt($nuevaPassword);
            $usuario->save();

            // Aquí podrías enviar un email con la nueva contraseña
            // Mail::to($usuario->email)->send(new NuevaPasswordMail($nuevaPassword));

            return back()->with('status', 'Se ha enviado una nueva contraseña a tu email.');
        }

        return back()->withErrors(['email' => 'No se pudo restablecer la contraseña.']);
    }
}
