<div className="max-w-4xl mx-auto p-6 sm:p-8">
    <h1 className="text-2xl font-bold mb-6">Citas</h1>
    <div className="bg-white rounded-lg shadow-md p-4">
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <div className="grid gap-2">
                    <a
                        href="{{ route('citas.index') }}"
                        className="w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-opacity-50">
                        Agendar Cita
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
