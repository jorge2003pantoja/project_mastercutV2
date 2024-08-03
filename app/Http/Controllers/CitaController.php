<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Servicio;
use App\Models\Barbero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class CitaController extends Controller
{

    public function create()
    {
        $servicios = Servicio::all();
        $barberos = Barbero::all();
        return view('citas.create', compact('servicios', 'barberos'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $fecha = $request->input('fecha');
        $hora = $request->input('hora');
        $barberoId = $request->input('id_barbero');

        // Verificar el número de citas futuras del usuario
        $citasPendientes = Cita::where('id_usuario', $user->id)
            ->where('fecha', '>=', Carbon::today())
            ->count();

        if ($citasPendientes >= 2) {
            return redirect()->back()->with('error', 'Ya existen 2 citas pendientes, no puedes agendar una tercera cita.');
        }

        // Verificar si ya existe una cita con el mismo barbero, fecha y hora
        $citaExistente = Cita::where('id_barbero', $barberoId)
            ->where('fecha', $fecha)
            ->where('hora', $hora)
            ->first();

        if ($citaExistente) {
            return redirect()->back()->with('error', 'Sin disponibilidad, asegurate de haber elegido alguno de los horarios disponibles');
        }

        $cita = new Cita();
        $cita->nombre_completo = $request->input('nombre_completo');
        $cita->numero_telefono = $request->input('numero_telefono');
        $cita->correo_electronico = $request->input('correo_electronico');
        $cita->fecha = $fecha;
        $cita->hora = $hora;
        $cita->id_barbero = $barberoId;
        $cita->id_usuario = $user->id;

        $servicios = $request->input('servicios', []);
        $serviciosNames = Servicio::whereIn('id', $servicios)->pluck('nombre')->toArray();
        $cita->servicios = implode(', ', $serviciosNames);

        $cita->costo = Servicio::whereIn('id', $servicios)->sum('precio');

        $cita->save();

        return redirect()->route('citas.index')->with('success', 'Cita agendada exitosamente.');
    }

    public function index()
    {
        $user = Auth::user();
        // Eliminar citas pasadas
        Cita::where('id_usuario', $user->id)
            ->where('fecha', '<', Carbon::today())
            ->delete();

        $citas = Cita::where('id_usuario', $user->id)
            ->where('fecha', '>=', Carbon::today())
            ->get();

        $citasDos = Cita::where('id_usuario', $user->id)
            ->where('fecha', '>=', Carbon::today())
            ->get();


        return view('citas.index', compact('citas'));
    }

    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita cancelada exitosamente.');
    } 
    
    public function checkAvailability(Request $request)
    {
        $barberoId = $request->input('barbero_id');
        $fecha = $request->input('fecha');

        $citas = Cita::where('id_barbero', $barberoId)
            ->where('fecha', $fecha)
            ->get(['hora']);

        return response()->json($citas);
    }

}
