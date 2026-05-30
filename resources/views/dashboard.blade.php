<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Principal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold">
                    Bienvenido, {{ Auth::user()->name }}
                </h3>

                <p class="mt-2 text-gray-600">
                    Rol asignado: <strong>{{ Auth::user()->role }}</strong>
                </p>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">
                    Accesos disponibles
                </h3>

                <div class="space-y-3">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block text-blue-600 hover:underline">
                            Ir al panel de administrador
                        </a>
                    @endif

                    @if(in_array(Auth::user()->role, ['admin', 'operador']))
                        <a href="{{ route('operador.dashboard') }}" class="block text-blue-600 hover:underline">
                            Ir al panel de operador
                        </a>
                    @endif

                    @if(in_array(Auth::user()->role, ['admin', 'operador', 'consulta']))
                        <a href="{{ route('consulta.dashboard') }}" class="block text-blue-600 hover:underline">
                            Ir al panel de consulta
                        </a>
                    @endif
                    @if(in_array(Auth::user()->role, ['admin', 'operador']))
                        <a href="{{ route('categorias.index') }}" class="block text-blue-600 hover:underline">
                            Gestionar categorías
                        </a>

                        <a href="{{ route('proveedores.index') }}" class="block text-blue-600 hover:underline">
                            Gestionar proveedores
                        </a>
                    @endif

                    @if(in_array(Auth::user()->role, ['admin', 'operador', 'consulta']))
                        <a href="{{ route('productos.index') }}" class="block text-blue-600 hover:underline">
                            Consultar productos
                        </a>
                    @endif

                    @if(in_array(Auth::user()->role, ['admin', 'operador', 'consulta']))
                        <a href="{{ route('movimientos.index') }}" class="block text-blue-600 hover:underline">
                            Historial de movimientos
                        </a>
                    @endif

                    @if(in_array(Auth::user()->role, ['admin', 'operador']))
                        <a href="{{ route('movimientos.create') }}" class="block text-blue-600 hover:underline">
                            Registrar movimiento de inventario
                        </a>
                    @endif

                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('monitoreo.index') }}" class="block text-blue-600 hover:underline">
                            Monitoreo del sistema
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>