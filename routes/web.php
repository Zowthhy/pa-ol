<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\herramientasController;
use App\Http\Controllers\prestamosController;
use App\Http\Controllers\usuariosController;
use App\Http\Controllers\reportesController;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [herramientasController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('herramientas', herramientasController::class);
});

Route::get('/prestamos/sin-devolucion', [prestamosController::class, 'indexSinDevolucion'])->name('prestamos.sin-devolucion')->middleware('auth');;
Route::get('/prestamos/crearSinCB', [prestamosController::class, 'crearSinCB'])->name('prestamos.crearSinCB')->middleware('auth');;
Route::post('/prestamos/storeSinCB', [prestamosController::class, 'storeSinCB'])->name('prestamos.storeSinCB')->middleware('auth');;

Route::resource('herramientas', herramientasController::class)->middleware('auth');;
Route::resource('usuarios', usuariosController::class)->middleware('auth');;
Route::resource('prestamos', prestamosController::class)->middleware('auth');;
Route::resource('reportes', reportesController::class)->middleware('auth');;
Route::get('/reportes/create/{id_prestamo}', [reportesController::class, 'create'])->name('reportes.create')->middleware('auth');;

Route::get('/buscar-herramientas', [herramientasController::class, 'buscar'])->name('buscar.herramientas')->middleware('auth');;
Route::get('/buscar-usuario', [usuariosController::class, 'buscar'])->name('buscar.usuarios')->middleware('auth');;
Route::get('/buscar-prestamos', [prestamosController::class, 'buscar'])->name('buscar.prestamos')->middleware('auth');;
Route::get('/buscar-encargado', [usersController::class, 'buscar'])->name('buscar.encargados')->middleware('auth');;

Route::put('/prestamos/{prestamo}/devolver', [prestamosController::class, 'devolver'])->name('prestamos.devolver')->middleware('auth');;


require __DIR__.'/auth.php';
