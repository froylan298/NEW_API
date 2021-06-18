<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/saludo', function () {
    echo json_encode("HOla");
});
//OBTENER TODOS LOS GENEROS Y GUARDARLOS EN LA BASE DE DATOS
Route::get('get/generos',[ApiController::class,'obtenerGeneros'])->name('obtener.genero');
//OBTENER EL ARTISTA POR ID Y GUARDARLO EN LA BASE DE DATOS
Route::get('get/gartista/{id}',[ApiController::class,'obtenerArtistas'])->name('obtener.artista');
//OBTENER EL GENERO POR ID EN NUESTRA BASE DE DATOS
Route::get('get/obtenerId/{id}',[ApiController::class,'obtenerGenero'])->name('obtener.id');
//OBTENER EL ARTISTA POR ID DESDE NUESTRA BASE DE DATOS
Route::get('get/obtenerArtista/{id}',[ApiController::class,'obtenerArtista'])->name('obtener.artista');
//OBTENER GENERO POR NOMBRE DESDE NUESTRA BASE DE DATOS
Route::get('get/obtenerNombre/{nombre}',[ApiController::class,'obtenerNombre'])->name('obtener.nombre');

