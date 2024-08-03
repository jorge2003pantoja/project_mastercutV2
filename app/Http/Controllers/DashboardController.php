<?php

namespace App\Http\Controllers;

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

        // Si el usuario es un cliente, obtenemos sus citas futuras
        if ($user->hasRole('user')) {
            $citas = Cita::where('id_usuario', $user->id)
                ->where('fecha', '>=', Carbon::today())
                ->get();
        }

        return view('dashboard', compact('citas'));
    }
}
