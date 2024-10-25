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
});

Route::get('/prestamos/sin-devolucion', [prestamosController::class, 'indexSinDevolucion'])->name('prestamos.sin-devolucion');
Route::get('/prestamos/crearSinCB', [prestamosController::class, 'crearSinCB'])->name('prestamos.crearSinCB');

Route::resource('herramientas', herramientasController::class);
Route::resource('usuarios', usuariosController::class);
Route::resource('prestamos', prestamosController::class);
Route::resource('reportes', reportesController::class);

Route::get('/buscar-herramientas', [herramientasController::class, 'buscar'])->name('buscar.herramientas');
Route::get('/buscar-usuario', [usuariosController::class, 'buscar'])->name('buscar.usuarios');
Route::get('/buscar-prestamos', [prestamosController::class, 'buscar'])->name('buscar.prestamos');
Route::get('/buscar-encargado', [usersController::class, 'buscar'])->name('buscar.encargados');

Route::put('/prestamos/{prestamo}/devolver', [prestamosController::class, 'devolver'])->name('prestamos.devolver');


require __DIR__.'/auth.php';
