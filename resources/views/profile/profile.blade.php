<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <header class="bg-gray-800 text-white">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold">Barbería</a>
            <nav>
                <a href="{{ route('logout') }}" class="text-white hover:text-gray-300">Cerrar sesión</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4">Perfil de {{ Auth::user()->name }}</h1>
            <div class="space-y-4">
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Teléfono:</strong> {{ Auth::user()->telefono ?? 'No disponible' }}</p>
                <!-- Agrega más campos aquí si es necesario -->
            </div>
        </div>
    </main>
</body>
</html>
