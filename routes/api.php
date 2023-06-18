<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoletaComisionController;
use App\Http\Controllers\BoletaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\ColaboradoresController;
use App\Http\Controllers\ComisionesController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\IncentivoController;
use App\Http\Controllers\MarcacionController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidosAllController;
use App\Http\Controllers\PedidoUpdController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout',[AuthController::class,'logout']);
    Route::apiResource('/pedidos', PedidoController::class);
    Route::apiResource('/boletas',BoletaController::class);
    Route::apiResource('/boletaComision', BoletaComisionController::class);
    Route::apiResource('/pagos',PagoController::class);
    Route::apiResource('/comisiones',ComisionesController::class);
});

Route::apiResource('/usuarios', UsuarioController::class);
Route::apiResource('/colaborador', ColaboradorController::class);
Route::apiResource('/imagen',ImagenController::class);
Route::apiResource('/marcacion', MarcacionController::class);
Route::apiResource('/horario', HorarioController::class);
Route::apiResource('/incentivo', IncentivoController::class);
Route::apiResource('/pedidoUpd', PedidoUpdController::class);
Route::apiResource('/pedidosAll', PedidosAllController::class);




Route::apiResource('/categorias', CategoriaController::class);
Route::apiResource('/productos', ProductoController::class);
Route::apiResource('/mesas', MesaController::class);

Route::post('/registro',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);