<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;

use App\Http\Controllers\MovimientoController;

use App\Http\Controllers\MonitorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:admin,operador'])->group(function () {
    Route::get('/operador', function () {
        return view('operador.dashboard');
    })->name('operador.dashboard');
});

Route::middleware(['auth', 'role:admin,operador,consulta'])->group(function () {
    Route::get('/consulta', function () {
        return view('consulta.dashboard');
    })->name('consulta.dashboard');
});

Route::middleware(['auth', 'role:admin,operador'])->group(function () {
    Route::resource('categorias', CategoriaController::class)->except(['show']);
    Route::resource('proveedores', ProveedorController::class)->except(['show']);
    Route::resource('productos', ProductoController::class)->except(['show', 'index']);
});

Route::middleware(['auth', 'role:admin,operador,consulta'])->group(function () {
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
});

Route::middleware(['auth', 'role:admin,operador,consulta'])->group(function () {
    Route::get('/movimientos', [MovimientoController::class, 'index'])
        ->name('movimientos.index');
});

Route::middleware(['auth', 'role:admin,operador'])->group(function () {
    Route::get('/movimientos/create', [MovimientoController::class, 'create'])
        ->name('movimientos.create');

    Route::post('/movimientos', [MovimientoController::class, 'store'])
        ->name('movimientos.store');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/monitoreo', [MonitorController::class, 'index'])
        ->name('monitoreo.index');
});

require __DIR__.'/auth.php';
