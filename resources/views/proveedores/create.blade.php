<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Nuevo proveedor</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">
            <form method="POST" action="{{ route('proveedores.store') }}">
                @csrf

                <label class="block mb-2">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">NIT</label>
                <input type="text" name="nit" value="{{ old('nit') }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">Correo</label>
                <input type="email" name="correo" value="{{ old('correo') }}" class="w-full border rounded p-2 mb-4">

                <label class="block mb-2">Dirección</label>
                <input type="text" name="direccion" value="{{ old('direccion') }}" class="w-full border rounded p-2 mb-4">

                @if($errors->any())
                    <div class="mb-4 text-red-600">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit"
                        style="background-color:#2563eb; color:white; padding:8px 16px; border-radius:6px; display:inline-block; border:none; cursor:pointer;">
                    Guardar
                </button>

                <a href="{{ route('proveedores.index') }}"
                style="margin-left:12px; color:#4b5563; text-decoration:none;">
                    Cancelar
            </form>
        </div>
    </div>
</x-app-layout>