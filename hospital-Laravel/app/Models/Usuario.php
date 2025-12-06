<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'idusuario';
    public $timestamps    = false;

    protected $fillable   = [
        'nif',
        'nombre',
        'apellidos',
        'email',
        'password',
        'foto',
    ];

    protected $hidden = ['password'];

    /**
     * Alta de usuario (valida, sube la foto y crea el registro).
     */
    public static function altaRegistro(Request $request): self
    {


        // FIX: validar desde Request (si no usas FormRequest)
        $data = $request->validate([
            'nif'        => 'required|string|max:9|unique:usuarios,nif',
            'nombre'     => 'required|string|max:50',
            'apellidos'  => 'required|string|max:50',
            'email'      => 'required|string|email|max:255|unique:usuarios,email',
            'password'   => 'required|string|min:4|confirmed',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // 2 MB
        ]);

        // Nombre por defecto
        $nombreImagen = 'sinfoto.jpg';

        // FIX: usa hasFile y guarda en el disco 'public' con ruta clara
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nombreImagen = uniqid() . '_' . $file->getClientOriginalName();
            $rutaImagen = public_path('assets/img');
            if (!file_exists($rutaImagen)) {
                mkdir($rutaImagen, 0755, true);
            }
            $file->move($rutaImagen, $nombreImagen);
        }

        // FIX: una sola creación; hashea password
        return self::create([
            'nif'        => $data['nif'],
            'nombre'     => $data['nombre'],
            'apellidos'  => $data['apellidos'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'foto'       => $nombreImagen,
        ]);
    }
    static public function obtenerUsuarioPorEmail($email)
    {

        $usuario = Usuario::where('email', $email)->first();

        return $usuario;

    }
}
