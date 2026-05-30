<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Nuevo producto</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">
            <form method="POST" action="{{ route('productos.store') }}">
                @csrf

                <label class="block mb-2">Categoría</label>
                <select name="categoria_id" class="w-full border rounded p-2 mb-4">
                    <option value="">Seleccione una categoría</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>

                <label class="block mb-2">Proveedor</label>
                <select name="proveedor_id" class="w-full border rounded p-2 mb-4">
                    <option value="">Seleccione un proveedor</option>
                    @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>

                <label class="block mb-2">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">Código</label>
                <input type="text" name="codigo" value="{{ old('codigo') }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded p-2 mb-4">{{ old('descripcion') }}</textarea>

                <label class="block mb-2">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">Stock mínimo</label>
                <input type="number" name="stock_minimo" value="{{ old('stock_minimo', 5) }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">Precio</label>
                <input type="number" step="0.01" name="precio" value="{{ old('precio', 0) }}" class="w-full border rounded p-2 mb-4">

                @if($errors->any())
                    <div class="mb-4 text-red-600">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit"
                        style="background-color:#2563eb; color:white; padding:8px 16px; border-radius:6px; display:inline-block; border:none; cursor:pointer;">
                    Guardar
                </button>

                <a href="{{ route('productos.index') }}"
                style="margin-left:12px; color:#4b5563; text-decoration:none;">
    Cancelar
</a>
            </form>
        </div>
    </div>
</x-app-layout>