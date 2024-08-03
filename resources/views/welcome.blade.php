<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.5.0/dist/flowbite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <title>Barbería</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #mi_mapa {
            height: 400px;
            width: 100%;
        }
        .barbero-card {
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 5rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .barbero-card img {
            border-radius: 50%;
            height: 250px;
            width: 250px;
            object-fit: cover;
        }
        .barbero-card h3 {
            font-size: 1.25rem;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .barbero-card p {
            color: #6b7280;
        }
        #home {
            position: relative;
            background-image: url('/images/barber_mastercut_HD.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            min-height: 500px;
        }
        #home::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }
        #home > .container {
            position: relative;
            z-index: 2;
        }
        /* Estilos para la barra de navegación fija */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background-color: #1f2937;
            padding: 2rem 0;
        }
        main {
            margin-top: 120px;
        }
        .swiper {
            width: 100%;
            height: 400px;
        }
        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .swiper-slide img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .swiper-slide .service-name {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 5px;
        }
        #about .description-padding, h2 {
            padding: 1rem; /* Ajusta el valor según tus necesidades */
            text-align: justify; /* Justifica el texto */
        }
    </style>
</head>
<body>
    <header class="bg-gray-900 text-white">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold">MasterCut</a>
            <nav class="space-x-4 hidden md:flex">
                <a href="#home" class="hover:text-yellow-400">Inicio</a>
                <a href="#about" class="hover:teyellow-400">Sobre Nosotros</a>
                <a href="#services" class="hover:text-yellow-400">Servicios</a>
                <a href="#barberos" class="hover:text-yellow-400">Barberos</a>
                <a href="#information" class="hover:text-yellow-400">Información</a>
            </nav>
            <div class="space-x-2">
                @guest
                    <a href="{{ route('login') }}" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Registrarse</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cerrar Sesión</button>
                    </form>
                @endauth
            </div>
        </div>
    </header>

    <main class="bg-gray-100 min-h-screen">
        <section id="home" class="text-center py-12">
            <div class="container mx-auto">
                <h1 class="text-4xl font-bold mb-4">Bienvenido a Barber MasterCut</h1>
                <p class="text-lg mb-8">La mejor experiencia de barbería en Ixmiquilpan. ¡Reserva tu cita hoy!</p>
                <a id="reserve-appointment" href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded">Reserva una Cita</a>

            </div>
        </section>

        <section id="about" class="py-12 bg-gray-200">
            <div class="container mx-auto flex flex-col md:flex-row items-center md:space-x-8">
                <div class="w-full md:w-1/2 mb-8 md:mb-0">
                    <img src="{{ asset('images/sobre_nosotros_HD.jpeg') }}" alt="Imagen de la Barbería" class="w-full h-auto object-cover rounded-lg shadow-lg">
                </div>
                <div class="w-full md:w-1/2">
                    <h2 class="text-3xl font-semibold mb-4 text-center">Sobre Nosotros</h2>
                    <p class="text-lg mb-4 mb-8 description-padding">En Barbería MasterCut, ofrecemos la mejor experiencia de barbería en Ixmiquilpan. Nuestro equipo de profesionales está altamente capacitado para proporcionarte el mejor servicio posible, asegurando que te sientas y luzcas increíble. Desde cortes de cabello clásicos hasta estilos modernos, estamos aquí para cumplir con tus expectativas.</p>
                    <p class="text-lg description-padding">Nuestra barbería no es solo un lugar para cortar el cabello, es un espacio donde puedes relajarte, disfrutar de una conversación amena y recibir un servicio de calidad superior. Ven y conoce el ambiente único que hemos creado para ti.</p>
                </div>
            </div>
        </section>


        <section id="services" class="text-center py-12 bg-white">
            <div class="container mx-auto">
                <h2 class="text-3xl font-semibold mb-4 text-center">Nuestros Servicios</h2>
                <p class="text-lg mb-8">Descubre los servicios que ofrecemos para ti.</p>
                <!-- Carrusel de servicios -->
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach($servicios as $servicio)
                            <div class="swiper-slide">
                                @if($servicio->foto)
                                    <img src="{{ asset('storage/' . $servicio->foto) }}" alt="{{ $servicio->nombre }}">
                                @else
                                    <img src="https://via.placeholder.com/800x400" alt="{{ $servicio->nombre }}">
                                @endif
                                <div class="service-name">{{ $servicio->nombre }}</div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Agregar botones de navegación si se desea -->
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>

        <section id="barberos" class="text-center py-12 bg-white">
            <div class="container mx-auto">
                <h2 class="text-3xl font-semibold mb-4 text-center">Nuestros Barberos</h2>
                <p class="text-lg mb-8">Conoce a nuestros talentosos barberos que están listos para atenderte.</p>
                <div class="flex flex-wrap justify-center gap-8">
                    @foreach($barberos as $barbero)
                        <div class="barbero-card">
                            @if($barbero->foto)
                                <img src="{{ asset('storage/' . $barbero->foto) }}" alt="{{ $barbero->nombre_completo }}">
                            @else
                                <img src="https://via.placeholder.com/150" alt="{{ $barbero->nombre_completo }}">
                            @endif
                            <h3>{{ $barbero->nombre_completo }}</h3>
                            <p>{{ $barbero->especialidad }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="information" class="text-center py-12 bg-white">
            <div class="container mx-auto">
                <h2 class="text-3xl font-semibold mb-4 text-center">Información</h2>
                <p class="text-lg mb-8">Estamos aquí para ayudarte. A continuación te mostramos información extra:</p>
                <div class="container mx-auto flex flex-col md:flex-row items-center">
                    <div class="w-full md:w-1/2">
                        <!-- Título de Ubicación -->
                        <h3 class="text-2xl font-semibold mb-4">Ubicación</h3>
                        <!-- Mapa -->
                        <div id="mi_mapa"></div>
                    </div>
                    <div class="w-full md:w-1/2 md:pl-8 mt-8 md:mt-0 items-start">
                        <div class="info-item">
                            <p class="text-lg mb-4"><i class="fas fa-map-marker-alt fa-1x mr-2"></i>Frente Sr. Paste y Sra. Pizza y un costado de Farmasana, 42302, Av. Benito Pablo Juárez García 24, San Antonio, 42300 Ixmiquilpan, Hgo.</p>
                        </div>
                        <div class="info-item">
                            <p class="text-lg mb-4"><i class="fas fa-phone fa-1x mr-2"></i>Teléfono: (123) 456-7890</p>
                        </div>
                        <div class="info-item">
                            <p class="text-lg"><i class="fas fa-clock fa-1x mr-2"></i>Horario: Lunes a Sábado - 6:00 AM a 9:00 PM</p>
                        </div>
                        <br>
                        <p class="text-lg">Ven y visítanos ¡Te esperamos!</p>
                    </div>
                </div>
                <!-- Agrega el formulario de contacto aquí -->
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 MasterCut. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.5.0/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script>
        let map = L.map('mi_mapa').setView([20.48621, -99.21711], 15);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([20.48623, -99.21709]).addTo(map).bindPopup("Barberia MasterCut").openPopup();

        // Inicialización del carrusel Swiper
        const swiper = new Swiper('.swiper', {
            loop: true,
            autoplay: {
                delay: 3000,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>

    <script>
        document.getElementById('reserve-appointment').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Verifica si el usuario está autenticado (esto puede variar dependiendo de cómo manejas la autenticación)
            @auth
                // Si el usuario está autenticado, redirige a la página de agendar cita
                window.location.href = '{{ route('citas.create') }}';  // Cambia la ruta según sea necesario
            @else
                // Si el usuario no está autenticado, redirige a la página de inicio de sesión
                window.location.href = '{{ route('login') }}';  // Cambia la ruta según sea necesario
            @endauth
        });
    </script>
</body>
</html>