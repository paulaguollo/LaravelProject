<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IniciativaController;
use App\Http\Controllers\EventoController;

// Página principal
Route::get('/', [IniciativaController::class, 'index'])->name('iniciativas.index');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Iniciativas
Route::get('/iniciativas/{id}/eventos', [EventoController::class, 'index'])->name('eventos.index');

// Dashboard (protegido por middleware auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// CRUD iniciativas— (para autenticados)
Route::middleware(['auth'])->group(function () {
    Route::get('/iniciativas/criar', [IniciativaController::class, 'create'])->name('iniciativas.create');
    Route::post('/iniciativas', [IniciativaController::class, 'store'])->name('iniciativas.store');
    Route::get('/iniciativas/{id}/editar', [IniciativaController::class, 'edit'])->name('iniciativas.edit');
    Route::put('/iniciativas/atualizar', [IniciativaController::class, 'update'])->name('iniciativas.update');
    Route::delete('/iniciativas/{id}', [IniciativaController::class, 'destroy'])->name('iniciativas.destroy');
});

// CRUD eventos (para autenticados)
Route::middleware(['auth'])->group(function () {
    Route::get('/iniciativas/{id}/eventos/criar', [EventoController::class, 'create'])->name('eventos.create');
    Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
    Route::get('/eventos/{id}/editar', [EventoController::class, 'edit'])->name('eventos.edit');
    Route::put('/eventos/atualizar', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('/eventos/{id}', [EventoController::class, 'destroy'])->name('eventos.destroy');
});
