@if($citas->isEmpty())
    <p>No tienes citas pendientes.</p>
@else
    <h2 class="text-lg font-medium text-gray-900">Mis citas</h2>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre Completo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Servicios</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Costo</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($citas as $cita)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $cita->nombre_completo }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $cita->fecha }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $cita->hora }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $cita->servicios }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${{ number_format($cita->costo, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
