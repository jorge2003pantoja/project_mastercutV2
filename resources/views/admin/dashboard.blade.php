<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <main class="container mx-auto px-4 py-8">
        <div class="flex flex-col justify-center items-center p-6"> <!-- Removido mt-32 -->
            <div class="text-center mt-10"> <!-- Agregado mt-10 -->
                <h3 class="text-lg font-medium text-gray-900">Panel del administrador</h3>
                <p class="mt-4 text-gray-600">
                    Utilice el botón de abajo para gestionar los trabajadores.
                </p>
                <!-- Botón para navegar a la lista de trabajadores -->
                <a href="{{ route('barberos.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                    Gestionar los trabajadores
                </a>
                <p class="mt-4 text-gray-600">
                    Utilice el botón de abajo para gestionar los servicios.
                </p>
                <!-- Botón para navegar a la lista de servicios -->
                <a href="{{ route('servicios.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                    Gestionar los servicios
                </a>
            </div>
        </div>
    </main>
</body>
