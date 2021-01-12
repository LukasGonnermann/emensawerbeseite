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

// [Homepage]
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
// [Anmeldungpage]
Route::get('/anmeldung', [App\Http\Controllers\AnmeldungController::class, 'anmeldung']);
// [Anmeldung Verifizieren Endpunkt]
Route::post('/anmeldung_verifizieren', [App\Http\Controllers\AnmeldungController::class, 'anmeldung_verifizieren']);
// [Abmeldung Endpunkt]
Route::get('/abmeldung', [App\Http\Controllers\AnmeldungController::class, 'abmelden']);
// [Profil Page]
Route::get('/profil', [App\Http\Controllers\UserController::class, 'profil']);
// [Gericht Bewertung Page]
Route::get('/bewertung', [App\Http\Controllers\GerichtBewertungController::class, 'bewertung']);

