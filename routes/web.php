<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CapacitacionController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/capacitaciones/create', [CapacitacionController::class, 'create'])->name('capacitaciones.create');
    Route::post('/capacitaciones', [CapacitacionController::class, 'store'])->name('capacitaciones.store');
    Route::get('/capacitaciones', [CapacitacionController::class, 'index'])->name('capacitaciones.index');
    Route::get('/capacitaciones/{id}/suscribir', [CapacitacionController::class, 'suscribir'])->name('capacitaciones.suscribir');
    Route::get('/capacitaciones/suscripciones', [CapacitacionController::class, 'verSuscripciones'])->name('capacitaciones.suscripciones');
    Route::delete('/users/cancelar-suscripcion/{id}', [UserController::class, 'cancelarSuscripcion'])->name('users.cancelar-suscripcion');

});