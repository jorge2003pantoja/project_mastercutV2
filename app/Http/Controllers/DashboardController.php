<?php

namespace App\Http\Controllers;

use App\Models\Barbero;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $citas = [];
        $barberos = [];
        $servicios = []; // Inicializa la variable $servicios

        // Si el usuario es un cliente, obtenemos sus citas futuras
        if ($user->hasRole('user')) {
            $citas = Cita::where('id_usuario', $user->id)
                ->where('fecha', '>=', Carbon::today())
                ->get();
        }

        // Si el usuario es un barbero, obtenemos todos los barberos
        if ($user->hasRole('barbero')) {
            $barberos = Barbero::all();
        }

        // Si el usuario es un administrador, obtenemos todos los barberos y servicios
        if ($user->hasRole('admin')) {
            $barberos = Barbero::all();
            $servicios = Servicio::all();
        }

        return view('dashboard', compact('citas', 'barberos', 'servicios'));
    }

}


