<?php

use App\Http\Controllers\BoletaController;
use App\Http\Controllers\CategoriaController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return view('welcome');
});


Route::get('/categorias',[CategoriaController::class,'index'] );
Route::get('/ticket',[BoletaController::class,'listar']);
Route::get('/detalle/{id}',[BoletaController::class,'detalle'])->name('detalle');
Route::get('/detalle/pdf/{id}',[BoletaController::class,'PDF'])->name('pdf');
