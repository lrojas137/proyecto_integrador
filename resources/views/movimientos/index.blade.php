<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:22px; font-weight:bold; color:#1f2937;">
            Historial de movimientos
        </h2>
    </x-slot>

    <div style="padding:30px; max-width:1200px; margin:auto;">

        @if(session('success'))
            <div style="margin-bottom:16px; padding:12px; background-color:#dcfce7; color:#166534; border-radius:6px;">
                {{ session('success') }}
            </div>
        @endif

        @if(in_array(Auth::user()->role, ['admin', 'operador']))
            <a href="{{ route('movimientos.create') }}"
               style="background-color:#2563eb; color:white; padding:8px 16px; border-radius:6px; display:inline-block; text-decoration:none;">
                Nuevo movimiento
            </a>
        @endif

        <div style="margin-top:24px; background:white; box-shadow:0 1px 4px #ccc; border-radius:6px; padding:16px;">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background-color:#f3f4f6;">
                        <th style="border:1px solid #ddd; padding:8px;">Fecha</th>
                        <th style="border:1px solid #ddd; padding:8px;">Producto</th>
                        <th style="border:1px solid #ddd; padding:8px;">Usuario</th>
                        <th style="border:1px solid #ddd; padding:8px;">Tipo</th>
                        <th style="border:1px solid #ddd; padding:8px;">Cantidad</th>
                        <th style="border:1px solid #ddd; padding:8px;">Stock anterior</th>
                        <th style="border:1px solid #ddd; padding:8px;">Stock nuevo</th>
                        <th style="border:1px solid #ddd; padding:8px;">Observación</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movimientos as $movimiento)
                        <tr>
                            <td style="border:1px solid #ddd; padding:8px;">
                                {{ $movimiento->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td style="border:1px solid #ddd; padding:8px;">
                                {{ $movimiento->producto->nombre ?? 'Producto no disponible' }}
                            </td>
                            <td style="border:1px solid #ddd; padding:8px;">
                                {{ $movimiento->usuario->name ?? 'Usuario no disponible' }}
                            </td>
                            <td style="border:1px solid #ddd; padding:8px;">
                                {{ ucfirst($movimiento->tipo) }}
                            </td>
                            <td style="border:1px solid #ddd; padding:8px;">
                                {{ $movimiento->cantidad }}
                            </td>
                            <td style="border:1px solid #ddd; padding:8px;">
                                {{ $movimiento->stock_anterior }}
                            </td>
                            <td style="border:1px solid #ddd; padding:8px;">
                                {{ $movimiento->stock_nuevo }}
                            </td>
                            <td style="border:1px solid #ddd; padding:8px;">
                                {{ $movimiento->observacion }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="border:1px solid #ddd; padding:12px; text-align:center;">
                                No hay movimientos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div style="margin-top:16px;">
                {{ $movimientos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>