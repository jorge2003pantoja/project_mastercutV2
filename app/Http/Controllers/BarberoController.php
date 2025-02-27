<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barbero;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class BarberoController extends Controller
{
    public function index()
    {
        $barberos = Barbero::all();
        return view('admin.barberos.index', compact('barberos'));
    }

    public function create()
    {
        //Ruta funcionando bien NO MOVER
        return view('admin.barberos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'telefono' => 'nullable|string|max:20',
            'especialidad' => 'required|string|max:100',
            'experiencia' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'foto.max' => 'El tamaño máximo permitido de la imagen es de 2MB.',
        ]);

        // Crear el usuario correspondiente en la tabla users
        $user = User::create([
            'name' => $request->input('nombre_completo'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->password),
        ]);

        // Asignar el rol de 'barbero' al nuevo usuario
        $role = Role::findByName('barbero', 'web');
        $user->assignRole($role);

        // Crear el barbero correspondiente en la tabla barberos
        $barbero = new Barbero();
        $barbero->id = $user->id; // Asegurar que la id del barbero sea la misma que la del usuario
        $barbero->nombre_completo = $request->input('nombre_completo');
        $barbero->email = $request->input('email'); // Asegurarse de que el email esté asignado
        $barbero->password = Hash::make($request->password); // Asegurarse de que el password esté asignado
        $barbero->telefono = $request->input('telefono');
        $barbero->especialidad = $request->input('especialidad');
        $barbero->experiencia = $request->input('experiencia');

        // Almacenar la foto si existe
        if ($request->hasFile('foto')) {
            $barbero->foto = $request->file('foto')->store('barberos', 'public');
        }

        $barbero->save();

        return redirect()->route('dashboard')->with('success', 'Barbero creado exitosamente.');
    }




    public function show(Barbero $barbero)
    {
        return view('admin.barberos.show', compact('barbero'));
    }

    public function edit(Barbero $barbero)
    {
        return view('admin.barberos.edit', compact('barbero'));
    }

    public function update(Request $request, Barbero $barbero)
    {
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'email' => 'required|email|unique:barberos,email,' . $barbero->id,
            'password' => 'nullable|string|min:8|confirmed',
            'telefono' => 'nullable|string|max:20',
            'especialidad' => 'required|string|max:100',
            'experiencia' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'foto.max' => 'El tamaño máximo permitido de la imagen es de 2MB.',
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('foto')) {
            if ($barbero->foto) {
                Storage::disk('public')->delete($barbero->foto);
            }
            $validated['foto'] = $request->file('foto')->store('barberos', 'public');
        }

        $barbero->update($validated);

        return redirect()->route('dashboard')->with('success', 'Barbero actualizado exitosamente.');
    }

        public function destroy($id)
        {
            $barbero = Barbero::findOrFail($id);

            // Eliminar todas las citas asociadas al barbero
            Cita::where('id_barbero', $id)->delete();

            // Ahora eliminar al barbero
            $barbero->delete();

            // Eliminar el usuario correspondiente en la tabla users
            $user = User::where('email', $barbero->email)->first();
            if ($user) {
                $user->delete();
            }

            $barbero->delete();

            return redirect()->route('dashboard')->with('success', 'Barbero eliminado exitosamente.');
        }
}
