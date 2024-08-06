<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CitaController;

use App\Http\Controllers\BarberoController;
use App\Http\Controllers\ServicioController;
use App\Models\Barbero;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [CitaController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Rutas de administrador con permisos específicos
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Rutas para el manejo de servicios
        Route::middleware(['can:create-services'])->group(function () {
            Route::get('/admin/servicios/create', [ServicioController::class, 'create'])->name('servicios.create');
            Route::post('/admin/servicios', [ServicioController::class, 'store'])->name('servicios.store');
        });

        Route::middleware(['can:edit-services'])->group(function () {
            Route::get('/admin/servicios/{servicio}/edit', [ServicioController::class, 'edit'])->name('servicios.edit');
            Route::patch('/admin/servicios/{servicio}', [ServicioController::class, 'update'])->name('servicios.update');
        });

        Route::middleware(['can:delete-services'])->group(function () {
            Route::delete('/admin/servicios/{servicio}', [ServicioController::class, 'destroy'])->name('servicios.destroy');
        });

        Route::middleware(['can:view-services'])->group(function () {
            Route::get('/admin/servicios', [ServicioController::class, 'index'])->name('servicios.index');
        });

        // Rutas para el manejo de trabajadores
        Route::middleware(['can:create-workers'])->group(function () {
            Route::get('/admin/barberos/create', [BarberoController::class, 'create'])->name('barberos.create');
            Route::post('/admin/barberos', [BarberoController::class, 'store'])->name('barberos.store');
        });

        Route::middleware(['can:edit-workers'])->group(function () {
            Route::get('/admin/barberos/{barbero}/edit', [BarberoController::class, 'edit'])->name('barberos.edit');
            Route::patch('/admin/barberos/{barbero}', [BarberoController::class, 'update'])->name('barberos.update');
        });

        Route::middleware(['can:delete-workers'])->group(function () {
            Route::delete('/admin/barberos/{barbero}', [BarberoController::class, 'destroy'])->name('barberos.destroy');
        });

        Route::middleware(['can:view-workers'])->group(function () {
            Route::get('/admin/barberos/index', [BarberoController::class, 'index'])->name('barberos.index');
            Route::get('/admin/barberos', [BarberoController::class, 'index'])->name('barberos.index');
        });
    });

    // Rutas de trabajadores
    Route::middleware(['role:worker'])->group(function () {
        Route::view('/worker', 'worker.dashboard');
        Route::view('/worker/appointments', 'worker.appointments');
    });

    // Rutas de usuarios
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user/citas', function () {
            return view('user.citas.index');
        })->name('user.citas.index');

        Route::middleware(['can:create-appointments'])->group(function () {
            // Ruta para crear una nueva cita
            Route::get('/citas/create', [CitaController::class, 'create'])->name('citas.create');
            Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
            Route::post('/citas/check-availability', [CitaController::class, 'checkAvailability'])->name('citas.check_availability');
        });

        Route::middleware(['can:view-own-appointments'])->group(function () {
            Route::get('/citas/index', [CitaController::class, 'index'])->name('citas.index');
        });

        Route::middleware(['can:cancel-appointments'])->group(function () {
            Route::delete('/citas/{citas}}', [CitaController::class, 'destroy'])->name('citas.destroy');
        });

    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* Route::get('/test', function () {
    //este trae todos los barberos con sus citas
    $barberos = Barbero::with('citas')->get();

    //este trae todas las citas del barbero
    $citas = Barbero::find(1);
    $citas->citas;

    return $citas;
}); */

Route::get('/', [HomeController::class, 'index']);
require __DIR__.'/auth.php';
