<?php
namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Barbero;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all(); // Obtén todos los servicios
        $barberos = Barbero::all(); // Obtén todos los barberos

        // Pasa ambas variables a la vista
        return view('welcome', [
            'servicios' => $servicios,
            'barberos' => $barberos
        ]);
    }
}
