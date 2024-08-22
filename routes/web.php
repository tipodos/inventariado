<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HerramientaController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\UsuarioController;
use App\Models\Material;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/movimiento',[MovimientoController::class,'index'])->name('movimiento.index');
    Route::post('/movimiento/agregar',[MovimientoController::class,'store'])->name('movimiento.store');

    Route::get('/categoria',[CategoryController::class,'index'])->name('categoria.index');
    Route::post('/categoria/agregar',[CategoryController::class,'store'])->name('categoria.store');
    Route::get('/categoria/editar/{id}',[CategoryController::class,'edit'])->name('categoria.edit');
    Route::put('/categoria/update/{id}',[CategoryController::class,'update'])->name('categoria.update');
    Route::delete('/categoria/delete/{id}',[CategoryController::class,'destroy'])->name('categoria.delete');

    Route::get('/material',[MaterialController::class,'index'])->name('material.index');
    Route::post('/material/agregar',[MaterialController::class,'store'])->name('material.store');
    Route::get('/material/edit/{id}',[MaterialController::class,'edit'])->name('material.edit');
    Route::put('/material/update/{id}',[MaterialController::class,'update'])->name('material.update');
    Route::delete('/material/delete/{id}',[MaterialController::class,'destroy'])->name('material.delete');

    Route::get('/herramienta',[HerramientaController::class,'index'])->name('herramienta.index');
    Route::post('/herramienta/agregar',[HerramientaController::class,'store'])->name('herramienta.store');
    Route::get('/herramienta/editar/{id}',[HerramientaController::class,'edit'])->name('herramienta.edit');
    Route::put('/herramienta/update/{id}',[HerramientaController::class,'update'])->name('herramienta.update');
    Route::delete('/herramienta/delete/{id}',[HerramientaController::class,'destroy'])->name('herramienta.delete');


    Route::get('/lista',[UsuarioController::class,'lista']);
    Route::get('/usuario',[UsuarioController::class,'usuario']);
});
