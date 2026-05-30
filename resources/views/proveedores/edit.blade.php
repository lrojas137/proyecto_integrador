<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Editar proveedor</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">
            <form method="POST" action="{{ route('proveedores.update', $proveedor) }}">
                @csrf
                @method('PUT')

                <label class="block mb-2">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $proveedor->nombre) }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">NIT</label>
                <input type="text" name="nit" value="{{ old('nit', $proveedor->nit) }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono', $proveedor->telefono) }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">Correo</label>
                <input type="email" name="correo" value="{{ old('correo', $proveedor->correo) }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">Dirección</label>
                <input type="text" name="direccion" value="{{ old('direccion', $proveedor->direccion) }}" class="w-full border rounded p-2 mb-4">

                @if($errors->any())
                    <div class="mb-4 text-red-600">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
                <a href="{{ route('proveedores.index') }}" class="ml-2 text-gray-600">Cancelar</a>
            </form>
        </div>
    </div>
</x-app-layout>