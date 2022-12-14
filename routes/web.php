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

Route::get('/', function () {
    return redirect()->route('films.index');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/films', [App\Http\Controllers\FilmController::class, 'index'])->name('films.index');
Route::get('/films/create', [App\Http\Controllers\FilmController::class, 'create'])->name('films.create');
Route::delete('/films/{film}/destroy', [App\Http\Controllers\FilmController::class, 'destroy'])->name('films.destroy');
Route::post('/films', [App\Http\Controllers\FilmController::class, 'store'])->name('films.store');
Route::get('/films/{film}/show', [App\Http\Controllers\FilmController::class, 'show'])->name('films.show');
Route::get('/films/{film}/edit', [App\Http\Controllers\FilmController::class, 'edit'])->name('films.edit');
Route::put('/films/{film}', [App\Http\Controllers\FilmController::class, 'update'])->name('films.update');


