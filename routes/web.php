<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\LibrosController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register');

# Agrupa rutas con auth
Route::middleware('auth')->group(function (){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias');
    Route::get('/categorias/crear', [CategoriasController::class, 'create'])->name('categorias.create');
    Route::post('/categorias/store', [CategoriasController::class, 'store'])->name('categorias.store');

    Route::get('/categorias/{id}/editar', [CategoriasController::class, 'edit'])->name('categorias.edit');
    
    Route::put('/categorias/{id}', [CategoriasController::class, 'update'])->name('categorias.update');
    
    Route::delete('/categorias/{id}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');

    Route::get('/libros/crear', [LibrosController::class, 'create'])->name('libros.create');
    Route::post('/libros/store', [LibrosController::class, 'store'])->name('libros.store');
    Route::patch('/libros/{libro}/estado', [LibrosController::class, 'actualidarEstado'])->name('libros.estado');

    Route::get('/libros', [LibrosController::class, 'index'])->name('libros');
    Route::get('/libros/{id}/editar', [LibrosController::class, 'edit'])->name('libros.edit');
    Route::put('/libros/{id}', [LibrosController::class, 'update'])->name('libros.update');
    Route::delete('/libros/{id}', [LibrosController::class, 'destroy'])->name('libros.destroy');

});
