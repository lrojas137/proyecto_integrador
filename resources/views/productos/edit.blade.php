<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Editar producto</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">
            <form method="POST" action="{{ route('productos.update', $producto) }}">
                @csrf
                @method('PUT')

                <label class="block mb-2">Categoría</label>
                <select name="categoria_id" class="w-full border rounded p-2 mb-4">
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected($producto->categoria_id == $categoria->id)>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>

                <label class="block mb-2">Proveedor</label>
                <select name="proveedor_id" class="w-full border rounded p-2 mb-4">
                    <option value="">Sin proveedor</option>
                    @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" @selected($producto->proveedor_id == $proveedor->id)>
                            {{ $proveedor->nombre }}
                        </option>
                    @endforeach
                </select>

                <label class="block mb-2">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">Código</label>
                <input type="text" name="codigo" value="{{ old('codigo', $producto->codigo) }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded p-2 mb-4">{{ old('descripcion', $producto->descripcion) }}</textarea>

                <label class="block mb-2">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">Stock mínimo</label>
                <input type="number" name="stock_minimo" value="{{ old('stock_minimo', $producto->stock_minimo) }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">Precio</label>
                <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}" class="w-full border rounded p-2 mb-4">

                @if($errors->any())
                    <div class="mb-4 text-red-600">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
                <a href="{{ route('productos.index') }}" class="ml-2 text-gray-600">Cancelar</a>
            </form>
        </div>
    </div>
</x-app-layout>