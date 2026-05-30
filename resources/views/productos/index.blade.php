<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Productos</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(in_array(Auth::user()->role, ['admin', 'operador']))
            <a href="{{ route('productos.create') }}" 
                style="background-color:#2563eb; color:white; padding:8px 16px; border-radius:6px; display:inline-block; text-decoration:none;">
                Nuevo producto
            </a>
        @endif

        <div class="mt-6 bg-white shadow rounded p-4">
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">Código</th>
                        <th class="border p-2">Producto</th>
                        <th class="border p-2">Categoría</th>
                        <th class="border p-2">Proveedor</th>
                        <th class="border p-2">Stock</th>
                        <th class="border p-2">Stock mínimo</th>
                        <th class="border p-2">Precio</th>
                        <th class="border p-2">Estado</th>
                        @if(in_array(Auth::user()->role, ['admin', 'operador']))
                            <th class="border p-2">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <td class="border p-2">{{ $producto->codigo }}</td>
                            <td class="border p-2">{{ $producto->nombre }}</td>
                            <td class="border p-2">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                            <td class="border p-2">{{ $producto->proveedor->nombre ?? 'Sin proveedor' }}</td>
                            <td class="border p-2">
                                {{ $producto->stock }}

                                @if($producto->stock <= $producto->stock_minimo)
                                    <span class="text-red-600 font-semibold">(Stock bajo)</span>
                                @endif
                            </td>
                            <td class="border p-2">{{ $producto->stock_minimo }}</td>
                            <td class="border p-2">${{ number_format($producto->precio, 2) }}</td>
                            <td class="border p-2">{{ $producto->estado ? 'Activo' : 'Inactivo' }}</td>

                            @if(in_array(Auth::user()->role, ['admin', 'operador']))
                                <td class="border p-2">
                                    <a href="{{ route('productos.edit', $producto) }}" class="text-blue-600">Editar</a>

                                    <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 ml-2" onclick="return confirm('¿Desactivar producto?')">
                                            Desactivar
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $productos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>