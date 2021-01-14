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

// User Section
// [Anmeldungpage]
Route::get('/anmeldung', [App\Http\Controllers\AnmeldungController::class, 'anmeldung']);
// [Anmeldung Verifizieren Endpunkt]
Route::post('/anmeldung_verifizieren', [App\Http\Controllers\AnmeldungController::class, 'anmeldung_verifizieren']);
// [Abmeldung Endpunkt]
Route::get('/abmeldung', [App\Http\Controllers\AnmeldungController::class, 'abmelden']);
// [Profil Page]
Route::get('/profil', [App\Http\Controllers\UserController::class, 'profil']);
// [User Bewertungen]
Route::get('/meinebewertungen', [App\Http\Controllers\UserController::class, 'meine_bewertungen']);

// Bewertungen Section
// [Gericht Bewertung Page]
Route::get('/bewertung', [App\Http\Controllers\GerichtBewertungController::class, 'bewertung']);
// [Gericht Bewertung verifizieren Endpunkt]
Route::post('bewertung_verifizieren', [App\Http\Controllers\GerichtBewertungController::class, 'bewertung_verifizieren']);
// [Gericht Bewertung speichern Fehler Endpunkt]
Route::get('/bewertung_error', [App\Http\Controllers\GerichtBewertungController::class, 'bewertung_error']);
// [Gericht Bewertung gespeichert ]
Route::get('/bewertung_success', [App\Http\Controllers\GerichtBewertungController::class, 'bewertung_success']);
// [Gericht Bewertung löschen]
Route::get('/bewertung_loeschen', [App\Http\Controllers\GerichtBewertungController::class, 'bewertung_loeschen']);
