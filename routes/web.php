<?php

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

//Auth routes
Route::group([
    "middleware" => "guest",
    "as" => "auth."
], function (){
    Route::get("login", [\App\Http\Controllers\Auth\LoginController::class,"index"])->name("login");
    Route::post("login", [\App\Http\Controllers\Auth\LoginController::class,"login"])->name("login.post");
    Route::get("reset-password", [])->name("reset-password");
    Route::post("reset-password", [])->name("reset-password.post");
});

//Dashboard route
Route::get("dashboard", [])->name("dashboard");


//Redirections
Route::redirect('/',"dashboard");
