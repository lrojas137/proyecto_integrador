<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Categorías</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('categorias.create') }}" 
            style="background-color:#2563eb; color:white; padding:8px 16px; border-radius:6px; display:inline-block; text-decoration:none;">
            Nueva categoría
        </a>

        <div class="mt-6 bg-white shadow rounded p-4">
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">Nombre</th>
                        <th class="border p-2">Descripción</th>
                        <th class="border p-2">Estado</th>
                        <th class="border p-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $categoria)
                        <tr>
                            <td class="border p-2">{{ $categoria->nombre }}</td>
                            <td class="border p-2">{{ $categoria->descripcion }}</td>
                            <td class="border p-2">{{ $categoria->estado ? 'Activa' : 'Inactiva' }}</td>
                            <td class="border p-2">
                                <a href="{{ route('categorias.edit', $categoria) }}" class="text-blue-600">Editar</a>

                                <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 ml-2" onclick="return confirm('¿Desactivar categoría?')">
                                        Desactivar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $categorias->links() }}
            </div>
        </div>
    </div>
</x-app-layout>