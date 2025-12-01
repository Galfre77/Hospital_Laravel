<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paciente extends Model
{
    use HasFactory;
    protected $table = 'paciente';
    protected $primaryKey = 'idpaciente';
    public $timestamps = false;
    // Impide que se asignen valores masivamente
    protected $fillable = ['nif', 'nombre', 'apellidos', 'fechaingreso'];

    public static function factory()
    {
        return \Database\Factories\pacienteFactory::new();
    }
    public static function alta($datosAlta)
    {
        return self::create($datosAlta);
    }
    public static function borrar($idpaciente)
    {
        return self::destroy($idpaciente);
    }
    public function modificacion($datosModificacion)
    {
        return parent::update($datosModificacion);
    }
    protected function reglas($idpaciente)
    {
        return [
            'nif'          => 'required|string|max:9|unique:paciente,nif,' . $idpaciente . ',idpaciente', //regla unique para que no se repita el nif en la base de datos
            'nombre'       => 'required|string|max:50',
            'apellidos'    => 'required|string|max:50',
            'fechaingreso' => 'required|date',
        ];
    }



}
