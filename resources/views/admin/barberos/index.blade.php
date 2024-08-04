<x-app-layout>
    <main class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-4 md:space-y-0">
            <h1 class="text-3xl font-semibold">Lista de Barberos</h1>
            @role('admin')
            <a href="{{ route('barberos.create') }}" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded flex items-center space-x-2">
                <i class="fas fa-user-plus"></i>
                <span>Crear Barbero</span>
            </a>
            @endrole
        </div>
        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-black border border-gray-700">
                <thead class="bg-red-700 border-red-700">
                    <tr class="border-red-700">
                        <th class="py-2 px-4 border border-gray-700">Nombre Completo</th>
                        <th class="py-2 px-4 border border-gray-700">Email</th>
                        <th class="py-2 px-4 border border-gray-700">Teléfono</th>
                        <th class="py-2 px-4 border border-gray-700">Especialidad</th>
                        <th class="py-2 px-4 border border-gray-700">Experiencia</th>
                        <th class="py-2 px-4 border border-gray-700">Foto</th>
                        <th class="py-2 px-4 border border-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-black text-white">
                    @foreach($barberos as $barbero)
                    <tr>
                        <td class="py-2 px-4 border border-gray-700">{{ $barbero->nombre_completo }}</td>
                        <td class="py-2 px-4 border border-gray-700">{{ $barbero->email }}</td>
                        <td class="py-2 px-4 border border-gray-700">{{ $barbero->telefono }}</td>
                        <td class="py-2 px-4 border border-gray-700">{{ $barbero->especialidad }}</td>
                        <td class="py-2 px-4 border border-gray-700">{{ $barbero->experiencia }} años</td>
                        <td class="py-2 px-4 border border-gray-700">
                            @if ($barbero->foto)
                                <img src="{{ asset('storage/' . $barbero->foto) }}" alt="Foto de {{ $barbero->nombre_completo }}" class="w-16 h-16 object-cover rounded">
                            @else
                                Sin foto
                            @endif
                        </td>
                        <td class="py-2 px-4 border border-gray-700 flex flex-col space-y-2 md:space-y-0 md:flex-row md:space-x-2">
                            <a href="{{ route('barberos.edit', $barbero->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-2 rounded">Editar</a>
                            <form action="{{ route('barberos.destroy', $barbero->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded" onclick="return confirm('¿Estás seguro de que deseas eliminar este barbero?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener el elemento del mensaje de éxito
            const successMessage = document.getElementById('success-message');

            if (successMessage) {
                // Ocultar el mensaje después de 4 segundos
                setTimeout(() => {
                    successMessage.style.opacity = 0;
                    setTimeout(() => {
                        successMessage.style.display = 'none';
                    }, 0); // Tiempo para desvanecerse
                }, 6000); // Tiempo de espera en milisegundos
            }
        });
    </script>
</x-app-layout>
