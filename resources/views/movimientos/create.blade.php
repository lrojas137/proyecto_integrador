<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:22px; font-weight:bold; color:#1f2937;">
            Nuevo movimiento de inventario
        </h2>
    </x-slot>

    <div style="padding:30px; max-width:800px; margin:auto;">
        <div style="background:white; box-shadow:0 1px 4px #ccc; border-radius:6px; padding:24px;">

            <form method="POST" action="{{ route('movimientos.store') }}">
                @csrf

                <label style="display:block; margin-bottom:8px;">Producto</label>
                <select name="producto_id" style="width:100%; border:1px solid #ccc; border-radius:6px; padding:8px; margin-bottom:16px;">
                    <option value="">Seleccione un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}" @selected(old('producto_id') == $producto->id)>
                            {{ $producto->nombre }} - Stock actual: {{ $producto->stock }}
                        </option>
                    @endforeach
                </select>

                <label style="display:block; margin-bottom:8px;">Tipo de movimiento</label>
                <select name="tipo" style="width:100%; border:1px solid #ccc; border-radius:6px; padding:8px; margin-bottom:16px;">
                    <option value="">Seleccione una opción</option>
                    <option value="entrada" @selected(old('tipo') == 'entrada')>Entrada</option>
                    <option value="salida" @selected(old('tipo') == 'salida')>Salida</option>
                    <option value="ajuste" @selected(old('tipo') == 'ajuste')>Ajuste</option>
                </select>

                <label style="display:block; margin-bottom:8px;">Cantidad</label>
                <input type="number" name="cantidad" value="{{ old('cantidad') }}"
                       style="width:100%; border:1px solid #ccc; border-radius:6px; padding:8px; margin-bottom:16px;">

                <p style="font-size:14px; color:#4b5563; margin-bottom:16px;">
                    Nota: en entradas y salidas, la cantidad aumenta o disminuye el stock.
                    En ajustes, la cantidad será el nuevo stock total del producto.
                </p>

                <label style="display:block; margin-bottom:8px;">Observación</label>
                <textarea name="observacion"
                          style="width:100%; border:1px solid #ccc; border-radius:6px; padding:8px; margin-bottom:16px;">{{ old('observacion') }}</textarea>

                @if($errors->any())
                    <div style="margin-bottom:16px; color:#dc2626;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit"
                        style="background-color:#2563eb; color:white; padding:8px 16px; border-radius:6px; display:inline-block; border:none; cursor:pointer;">
                    Guardar movimiento
                </button>

                <a href="{{ route('movimientos.index') }}"
                   style="margin-left:12px; color:#4b5563; text-decoration:none;">
                    Cancelar
                </a>
            </form>
        </div>
    </div>
</x-app-layout>