<div class="p-6">
    <h3 class="text-lg font-medium text-gray-900">Admin Panel</h3>
    <p class="mt-4 text-gray-600">
        Use the button below to manage workers.
    </p>
    <!-- Botón para navegar a la lista de trabajadores -->
    <a href="{{ route('barberos.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
        Manage Workers
    </a>
    <!-- Botón para navegar a la lista de servicios -->
    <a href="{{ route('servicios.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
        Manage Services
    </a>
</div>