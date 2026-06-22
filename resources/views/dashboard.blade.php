<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Sección de Alertas -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Alertas Recientes</h3>
                    @if($alerts->isEmpty())
                        <p class="text-gray-500">No hay alertas pendientes.</p>
                    @else
                        <ul class="space-y-2">
                            @foreach($alerts as $alert)
                                <li class="flex items-start gap-2 text-sm {{ $alert->read ? 'text-gray-400' : 'text-red-600' }}">
                                    <span class="font-semibold uppercase">[{{ $alert->type }}]</span>
                                    <span>{{ $alert->message }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <!-- Tarjetas de Resumen -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total de Equipos -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold">Total Equipos</h3>
                        <p class="text-3xl">{{ $totalEquipos }}</p>
                    </div>
                </div>

                <!-- Equipos en Mantenimiento -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold">En Mantenimiento</h3>
                        <p class="text-3xl">{{ $enMantenimiento }}</p>
                    </div>
                </div>

                <!-- Componentes Disponibles -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold">Componentes Disponibles</h3>
                        <p class="text-3xl">{{ $componentesDisponibles }}</p>
                    </div>
                </div>
            </div>

            <!-- Opcional: Enlaces rápidos -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Accesos Rápidos</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('equipment.index') }}" class="text-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                            <span class="block text-2xl">🖥️</span>
                            <span class="text-sm mt-1">Equipos</span>
                        </a>
                        <a href="{{ route('components.index') }}" class="text-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                            <span class="block text-2xl">🔧</span>
                            <span class="text-sm mt-1">Componentes</span>
                        </a>
                        <a href="{{ route('peripherals.index') }}" class="text-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition">
                            <span class="block text-2xl">🖱️</span>
                            <span class="text-sm mt-1">Periféricos</span>
                        </a>
                        <a href="{{ route('reports.inventory') }}" class="text-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                            <span class="block text-2xl">📊</span>
                            <span class="text-sm mt-1">Reportes</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>