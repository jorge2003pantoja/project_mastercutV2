<x-app-layout>
    <div class="relative min-h-screen bg-cover bg-center" style="background-image: url('/images/imagen de fondo.jpg');">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p- text-gray-900 dark:text-gray-100 ">
                    @if(auth()->user()->hasRole('admin'))
                        @include('admin.dashboard')
                    @elseif(auth()->user()->hasRole('barbero'))
                        @include('barber.index', ['citas' => $citas])
                    @elseif(auth()->user()->hasRole('user'))
                        @include('user.citas.index')
                    @else
                        <p>Access denied.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
