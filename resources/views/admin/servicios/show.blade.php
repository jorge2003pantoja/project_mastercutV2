<x-app-layout>
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-6">Ver Servicio</h1>
        <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
            <div class="mb-4">
                <strong class="text-gray-700">Nombre:</strong>
                <p>{{ $servicio->nombre }}</p>
            </div>
            <div class="mb-4">
                <strong class="text-gray-700">Descripción:</strong>
                <p>{{ $servicio->descripcion }}</p>
            </div>
            <div class="mb-4">
                <strong class="text-gray-700">Duración:</strong>
                <p>{{ $servicio->duracion }} minutos</p>
            </div>
            <div class="mb-4">
                <strong class="text-gray-700">Precio:</strong>
                <p>${{ $servicio->precio }}</p>
            </div>
            <!-- @if ($servicio->foto)
<div class="mb-4">
                    <strong class="text-gray-700">Foto:</strong>
                    <img src="{{ Storage::url($servicio->foto) }}" alt="Foto del servicio" class="mt-2 w-32 h-32 object-cover">
                </div>
@endif -->
            @if ($servicio->foto)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $servicio->foto) }}" alt="Foto de {{ $servicio->nombre }}"
                        class="w-32 h-32 object-cover rounded-md">
                </div>
            @endif

        </div>
    </main>
</x-app-layout>
