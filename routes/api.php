<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgrupacionController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\Mision_soloController;
use App\Http\Controllers\Mision_superheroesController;
use App\Http\Controllers\MisionController;
use App\Http\Controllers\PlanetaController;
use App\Http\Controllers\Poderes_superheroeController;
use App\Http\Controllers\SuperheroeController;
use App\Http\Controllers\SuperpoderController;
use App\Http\Controllers\Tipo_misionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('agrupacion', AgrupacionController::class);

Route::resource('equipo', EquipoController::class);

Route::resource('misionSolo', Mision_soloController::class);

Route::resource('misionGrupal', Mision_superheroesController::class);

Route::resource('mision', MisionController::class);

Route::resource('planeta', PlanetaController::class);

Route::resource('poderHeroe', Poderes_superheroeController::class);

Route::resource('heroe', SuperheroeController::class);
Route::get('heroeAll', [SuperheroeController::class, 'todoheroes']);

Route::resource('poderes', SuperpoderController::class);

Route::resource('tipoMision', Tipo_misionController::class);