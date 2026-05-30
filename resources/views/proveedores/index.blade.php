<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Proveedores</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('proveedores.create') }}" 
            style="background-color:#2563eb; color:white; padding:8px 16px; border-radius:6px; display:inline-block; text-decoration:none;">
            Nuevo proveedor
        </a>

        <div class="mt-6 bg-white shadow rounded p-4">
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">Nombre</th>
                        <th class="border p-2">NIT</th>
                        <th class="border p-2">Teléfono</th>
                        <th class="border p-2">Correo</th>
                        <th class="border p-2">Estado</th>
                        <th class="border p-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proveedores as $proveedor)
                        <tr>
                            <td class="border p-2">{{ $proveedor->nombre }}</td>
                            <td class="border p-2">{{ $proveedor->nit }}</td>
                            <td class="border p-2">{{ $proveedor->telefono }}</td>
                            <td class="border p-2">{{ $proveedor->correo }}</td>
                            <td class="border p-2">{{ $proveedor->estado ? 'Activo' : 'Inactivo' }}</td>
                            <td class="border p-2">
                                <a href="{{ route('proveedores.edit', $proveedor) }}" class="text-blue-600">Editar</a>

                                <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 ml-2" onclick="return confirm('¿Desactivar proveedor?')">
                                        Desactivar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $proveedores->links() }}
            </div>
        </div>
    </div>
</x-app-layout>