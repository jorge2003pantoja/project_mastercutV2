<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.5.0/dist/flowbite.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Olvidé mi Contraseña</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            position: relative;
            background-image: url('{{ asset('images/barber_mastercut_HD.jpeg') }}');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }

        /* Capa de sombreado sobre la imagen de fondo */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Sombreado oscuro con 50% de opacidad */
            z-index: -1; /* Asegura que el sombreado esté detrás del contenido */
        }
    </style>
</head>
<body>

    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg bg-opacity-90">
            <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Olvidé mi Contraseña</h2>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-800">Correo Electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                           class="block w-full mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-black-500">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                        Enviar Enlace de Reinicio
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500">Inicia sesión</a></p>
                <p class="text-sm text-gray-600">¿No tienes cuenta? <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500">Regístrate</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.5.0/dist/flowbite.min.js"></script>
</body>
</html>
