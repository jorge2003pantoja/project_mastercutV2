<x-app-layout>
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-6">Crear Barbero</h1>
        <form action="{{ route('barberos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="nombre_completo" class="block text-sm font-medium text-gray-700">Nombre Completo</label>
                <input type="text" id="nombre_completo" name="nombre_completo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
            </div>
            <!-- Campo de contraseña -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                @if ($errors->has('password'))
                    <span class="text-red-500 text-sm">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <!-- Campo de confirmación de contraseña -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                @if ($errors->has('password_confirmation'))
                    <span class="text-red-500 text-sm">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>
            <div class="mb-4">
                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
            </div>
            <div class="mb-4">
                <label for="especialidad" class="block text-sm font-medium text-gray-700">Especialidad</label>
                <input type="text" id="especialidad" name="especialidad" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label for="experiencia" class="block text-sm font-medium text-gray-700">Experiencia</label>
                <textarea id="experiencia" name="experiencia" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required></textarea>
            </div>
            <div class="mb-4">
                <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                <input type="file" id="foto" name="foto" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                <p class="mt-2 text-sm text-gray-500">Tamaño máximo: 2MB. Formatos permitidos: jpeg, png, jpg.</p>
                <!-- Mensaje de error para la foto -->
                @if ($errors->has('foto'))
                    <p class="mt-2 text-sm text-red-500">{{ $errors->first('foto') }}</p>
                @endif
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Guardar</button>
            </div>
        </form>
    </main>
</x-app-layout>
