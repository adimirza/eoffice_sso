<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cek_api', [App\Http\Controllers\HomeController::class, 'cekApi']);
Route::get('/periksa_token', [App\Http\Controllers\Auth\LoginController::class, 'periksa_token']);
Route::post('/login_sso', [App\Http\Controllers\Auth\LoginController::class, 'login_sso'])->name('login_sso');
Route::post('/logout_sso', [App\Http\Controllers\Auth\LoginController::class, 'logout_sso'])->name('logout_sso');
