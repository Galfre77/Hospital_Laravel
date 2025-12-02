<?php

use App\Http\Controllers\AthUsuarioController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\VistaController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

    /* --- Route Get --- */

Route::get('/',                            [VistaController::class,   'home'])               ->name('home');
Route::get('/alta',                        [VistaController::class,   'alta'])               ->name('alta.paciente');
Route::get('/consulta',                    [VistaController::class,   'consultaPacientes'])  ->name('consulta.pacientes');
Route::get('/consultaUsuario',             [VistaController::class,   'consultaUsuarios'])   ->name('consulta.usuarios')->middleware('auth');
Route::get('/mantenimiento/{idpaciente?}', [VistaController::class,   'mantenimiento'])      ->name('mantenimiento.paciente');
Route::get('/login',                       [VistaController::class,   'login'])              ->name('login')->middleware('guest');




Route::get('/registro',                   [UsuarioController::class, 'registro'])             ->name('usuario.registro') ->middleware('guest');
Route::get('/olvido-password',            [UsuarioController::class, 'olvidoPasswordForm'])   ->name('password.request')  ->middleware('guest');
Route::get('/reset_password',             [UsuarioController::class, 'resetPasswordForm'])    ->name('password.reset')  ->middleware('guest');
/* --- Route Post --- */
Route::post('/registro',                  [UsuarioController::class,  'registroUsuario'])     ->name('registro.usuarios')->middleware('guest');
Route::post('/login',                     [UsuarioController::class,  'login'])               ->name('login.usuarios')   ->middleware('guest');
Route::post('/logout',                    [UsuarioController::class,  'logout'])              ->name('logout.usuario')   ->middleware('auth');
Route::post('/reset_password',            [UsuarioController::class,  'resetPassword'])       ->name('reset.password')   ->middleware('guest');
Route::post('/auth/olvido-password.blade',[UsuarioController::class,  'olvido'])              ->name('olvido.password')       ->middleware('guest');

// ENDPOINT PARA CONSULTA DE PACIENTE
// ENDPOINT PARA OPERATIVAS DE PACIENTE
Route::post('/alta',                      [PacienteController::class, 'pacienteAlta'])        ->name('paciente.alta')         ->middleware('auth');
Route::put('/paciente/{idpaciente}',      [PacienteController::class, 'pacienteModificacion'])->name('paciente.modificacion') ->middleware('auth');
Route::delete('/paciente/{idpaciente}',   [PacienteController::class, 'borrar'])              ->name('paciente.borrar')       ->middleware('auth');






// ENDPOINT PARA AUTENTIFICACION DEL USUARIO
//Route::post('/login',        [PacienteController::class, 'login'])       ->name('login.paciente');
//Route::post('/logout',       [PacienteController::class, 'logout'])      ->name('usuario.logout');
