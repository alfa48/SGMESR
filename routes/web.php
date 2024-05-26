<?php

use App\Http\Controllers\BateriaController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\LoginController; // Corrigido o nome da classe para "LoginController"
use App\Http\Controllers\PainelController;
use App\Http\Controllers\PainelSolarController;
use App\Models\Alerta;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/user/chart', "PainelController@showChart");

Route::get('/chart', [ChartController::class, 'index']);
Route::get('/getNivelDeTensao', [PainelController::class, 'getNivelDeTensao']);
Route::prefix("/painel-control")->group(function(){

    Route::get("/dashboard", [PainelController::class, "dashboard"])->name("dashboard");
    Route::get("/configurar", [PainelController::class, "config"])->name("config");
    Route::get("/alerta", [PainelController::class, "alerta"])->name("alerta");
    Route::get("/control", [PainelController::class, "control"])->name("control");
    Route::get("/temperatura", [PainelController::class, "temperatura"])->name("temperatura");
    Route::get("/casa", [PainelController::class, "casa"])->name("casa");
    Route::get("/ajuda", [PainelController::class, "ajuda"])->name("ajuda");
    
});

Route::prefix("/usuario")->group(function(){

    Route::get("/login", [LoginController::class, "login"])->name("login"); // Corrigido o nome da classe para "LoginController"
    Route::post("/logar", [LoginController::class, "logar"])->name("logar"); // Corrigido o nome da classe para "LoginController"
    Route::get("/cadastro", [LoginController::class, "cadastro"])->name("cadastro"); // Corrigido o nome da classe para "LoginController"
    Route::get("/cadastrar", [LoginController::class, "cadastrar"])->name("cadastrar"); // Corrigido o nome da classe para "LoginController"
}); 

Route::prefix("/bateria")->group(function(){

    Route::get("/control", [BateriaController::class, "index"])->name("control"); // Corrigido o controlador para "BateriaController"
});

Route::prefix("/painel-solar")->group(function(){

    Route::get("/info", [PainelSolarController::class, "index"])->name("info");
});