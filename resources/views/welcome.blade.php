    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
        <link rel="stylesheet"
            href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <link href="https://cdn.jsdelivr.net/npm/flowbite@1.5.0/dist/flowbite.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    </head>
    <body>
    <!-- component -->

    <header class="bg-black text-white w-full py-6"> <!-- Cambiado py-4 a py-5 -->
        <div class="container mx-auto px-4 flex justify-between items-center">
            <a href="/" class="text-5xl font-bold">MasterCut</a>
            <nav class="space-x-4 hidden md:flex">
                <a href="#home" class="hover:text-red-500">Inicio</a>
                <a href="#about" class="hover:text-red-500">Sobre Nosotros</a>
                <a href="#services" class="hover:text-red-500">Servicios</a>
                <a href="#barberos" class="hover:text-red-500">Barberos</a>
                <a href="#footer" class="hover:text-red-500">Información</a>
            </nav>
            <div class="order-3 md:order-2">
                <a href="{{ route('login') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl flex items-center gap-2">
                    <!-- Icono de Login -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Iniciar Sesión</span>
                </a>
            </div>
        </div>
    </header>

    <main class="bg-gray-100 min-h-screen">
        <section id="home" class="text-center py-12 bg-cover bg-center relative" style="background-image: url('/images/barber_mastercut_HD.jpeg');">
            <div class="absolute inset-0 bg-black opacity-60"></div>
            <div class="relative z-10 container mx-auto">
                <h1 class="text-4xl font-bold text-white mb-4">Bienvenido a Barber MasterCut</h1>
                <p class="text-lg text-white mb-8">La mejor experiencia de barbería en Ixmiquilpan. ¡Reserva tu cita hoy!</p>
                <a id="reserve-appointment" href="#" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Reserva una Cita</a>
            </div>
        </section>

        <section id="about" class="py-12 bg-gray-200">
            <div class="container mx-auto flex flex-col md:flex-row items-center md:space-x-8">
                <div class="w-full md:w-1/2 mb-8 md:mb-0">
                    <img src="{{ asset('images/sobre_nosotros_HD.jpeg') }}" alt="Imagen de la Barbería" class="w-full h-auto object-cover rounded-lg shadow-lg">
                </div>
                <div class="w-full md:w-1/2">
                    <h2 class="text-3xl font-semibold mb-4 text-center">Sobre Nosotros</h2>
                    <p class="text-lg mb-4 mb-8">En Barbería MasterCut, ofrecemos la mejor experiencia de barbería en Ixmiquilpan. Nuestro equipo de profesionales está altamente capacitado para proporcionarte el mejor servicio posible, asegurando que te sientas y luzcas increíble. Desde cortes de cabello clásicos hasta estilos modernos, estamos aquí para cumplir con tus expectativas.</p>
                    <p class="text-lg">Nuestra barbería no es solo un lugar para cortar el cabello, es un espacio donde puedes relajarte, disfrutar de una conversación amena y recibir un servicio de calidad superior. Ven y conoce el ambiente único que hemos creado para ti.</p>
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
                        @foreach ($servicios as $servicio)
                            <div class="swiper-slide">
                                @if ($servicio->foto)
                                    <img src="{{ asset('storage/' . $servicio->foto) }}" alt="{{ $servicio->nombre }}">
                                @else
                                    <img src="https://via.placeholder.com/800x400" alt="{{ $servicio->nombre }}">
                                @endif
                                <div class="service-name">{{ $servicio->nombre }}</div>
                            </div> @endforeach
                    </div>
                    <!-- Agregar botones de navegación si se desea -->
                    <div class="swiper-pagination">
        </div>
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
                    @foreach ($barberos as $barbero)
                        <div class="bg-red-600 rounded-lg shadow-md p-6 text-center flex flex-col items-center text-black">
                            <img src="{{ $barbero->foto ? asset('storage/' . $barbero->foto) : 'https://via.placeholder.com/150' }}"
                                alt="{{ $barbero->nombre_completo }}" class="rounded-full h-64 w-64 object-cover mb-4">
                            <h3 class="text-xl font-semibold">{{ $barbero->nombre_completo }}</h3>
                            <p class="text-black">{{ $barbero->especialidad }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <div class="flex items-center justify-center h-full">
            <div class="w-full max-w-4xl h-96 bg-gray-200 rounded-lg shadow-lg overflow-hidden" id="mi_mapa" allowfullscreen="" height: 400px;></div>
        </div>

        <footer id="footer" class="relative bg-black pt-8 pb-6">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap text-left lg:text-left">
                    <div class="w-full lg:w-6/12 px-4">
                        <h4 class="text-3xl font-semibold text-red-600">MASTER CUT BARBER SHOP</h4>
                        <h5 class="text-lg mt-0 mb-2 text-white">
                            Estilo y precisión en cada corte
                        </h5>
                        <div class="mt-6 lg:mb-0 mb-6">
                            <button
                                class="bg-white text-red-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                                type="button">
                                <i class="fab fa-twitter"></i></button><button
                                class="bg-white text-red-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                                type="button">
                                <i class="fab fa-facebook-square"></i></button><button
                                class="bg-white text-red-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                                type="button">
                                <i class="fab fa-instagram"></i></button>
                        </div>
                    </div>
                    <div class="w-full lg:w-6/12 px-4">
                        <div class="flex flex-wrap items-top mb-6">
                            <div class="w-full lg:w-4/12 px-4 ml-auto">
                                <span class="block uppercase text-white text-sm font-semibold mb-2">Encuéntranos</span>
                                <ul class="list-unstyled">
                                    <li>
                                        <p class="text-white font-semibold block pb-2 text-sm">Frente Sr. Paste y Sra.
                                            Pizza
                                            y un costado de Farmasana, 42302, Av. Benito Pablo Juárez García 24, San
                                            Antonio
                                        </p>
                                    </li>
                                    <li>
                                        <p class="text-white font-semibold block pb-2 text-sm"> Ixmiquilpan, Hgo., CP
                                            42300
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <span class="block uppercase text-white text-sm font-semibold mb-2">Contáctanos</span>
                                <ul class="list-unstyled">
                                    <li>
                                        <p class="text-white font-semibold block pb-2 text-sm">📞 Teléfono: (123)
                                            456-7890
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <span class="block uppercase text-white text-sm font-semibold mb-2">Horarios</span>
                                <ul class="list-unstyled">
                                    <li>
                                        <p class="text-white font-semibold block pb-2 text-sm">Lunes a Viernes: 6:00 AM
                                            -
                                            9:00 PM
                                        </p>
                                    </li>
                                    <li>
                                        <p class="text-white font-semibold block pb-2 text-sm">Sáb: 6:00 AM - 9:00 PM
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-white">
                <div class="flex flex-wrap items-center md:justify-between justify-center">
                    <div class="w-full md:w-4/12 px-4 mx-auto text-center">
                        <div class="text-sm text-white font-semibold py-1">
                            © 2024 Master Cut Barber Shop | Todos los derechos reservados.
                        </div>
                    </div>
                </div>
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

<<<<<<< Updated upstream
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
=======
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
        </body>
    </html>
>>>>>>> Stashed changes
