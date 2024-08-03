<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;

use App\Http\Controllers\BarberoController;
use App\Http\Controllers\ServicioController;



Route::get('/', function () {
    return view('welcome');
});

//Ruta al dashboard principal
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas para el perfil del usuario
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Rutas de administrador con permisos específicos
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        /* Route::view('/admin/services', 'admin.services'); */

        // Rutas para el manejo de servicios
        Route::middleware(['can:create-services'])->group(function () {
            //Ruta funcionando NO MOVER
            Route::get('/admin/servicios/create', [ServicioController::class, 'create'])->name('servicios.create');
            Route::post('/admin/servicios', [ServicioController::class, 'store'])->name('servicios.store');
        });

        // Rutas para el manejo de trabajadores
        Route::middleware(['can:create-workers'])->group(function () {
            //Ruta funcionando NO MOVER
            Route::get('/admin/barberos/create', [BarberoController::class, 'create'])->name('barberos.create');
            Route::post('/admin/barberos', [BarberoController::class, 'store'])->name('barberos.store');
        });

        Route::middleware(['can:edit-workers'])->group(function () {
            Route::get('/admin/barberos/{barbero}/edit', [BarberoController::class, 'edit'])->name('barberos.edit');
            Route::patch('/admin/barberos/{barbero}', [BarberoController::class, 'update'])->name('barberos.update');
        });

        Route::middleware(['can:delete-workers'])->group(function () {
            Route::delete('/admin/barberos/{worker}', [BarberoController::class, 'destroy'])->name('barberos.destroy');
        });

        Route::middleware(['can:view-workers'])->group(function () {
            Route::get('/admin/barberos/index', [BarberoController::class, 'index'])->name('barberos.index');
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
    });
});



// Ruta para cerrar sesión
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


/* Route::resource('citas', CitaController::class); */
/* Route::get('citas/horarios', [CitaController::class, 'getAvailableTimes']); */

/* Route::get('/horas-disponibles', [CitaController::class, 'horasDisponibles']);

/*Manejar la solicitud AJAX de horas disponibles
Route::get('/citas/available-hours', [CitaController::class, 'availableHours'])->name('citas.availableHours'); */


/* Route::post('/citas/horas-disponibles', [CitaController::class, 'availableHours'])->name('citas.availableHours'); */
/* 

Route::get('/citas/disponibilidad', [CitaController::class, 'obtenerDisponibilidad'])->name('citas.disponibilidad'); */
// routes/web.php

Route::post('/citas/check-availability', [CitaController::class, 'checkAvailability'])->name('citas.check_availability');
Route::post('/citas/check-availability', [CitaController::class, 'checkAvailability'])->name('citas.check_availability');

Route::get('/', [HomeController::class, 'index']);

//Rutas de perfil del usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
















