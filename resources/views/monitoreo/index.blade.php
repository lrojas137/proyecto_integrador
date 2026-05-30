<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:22px; font-weight:bold; color:#1f2937;">
            Monitoreo del sistema
        </h2>
    </x-slot>

    <div style="padding:30px; max-width:1200px; margin:auto;">

        <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:16px; margin-bottom:24px;">
            <div style="background:white; padding:20px; border-radius:8px; box-shadow:0 1px 4px #ccc;">
                <h3 style="font-weight:bold;">Productos activos</h3>
                <p style="font-size:28px; margin-top:8px;">{{ $totalProductos }}</p>
            </div>

            <div style="background:white; padding:20px; border-radius:8px; box-shadow:0 1px 4px #ccc;">
                <h3 style="font-weight:bold;">Productos con stock bajo</h3>
                <p style="font-size:28px; margin-top:8px; color:#dc2626;">{{ $productosStockBajo }}</p>
            </div>

            <div style="background:white; padding:20px; border-radius:8px; box-shadow:0 1px 4px #ccc;">
                <h3 style="font-weight:bold;">Movimientos de hoy</h3>
                <p style="font-size:28px; margin-top:8px;">{{ $movimientosHoy }}</p>
            </div>
        </div>

        <div style="background:white; padding:20px; border-radius:8px; box-shadow:0 1px 4px #ccc;">
            <h3 style="font-size:18px; font-weight:bold; margin-bottom:16px;">
                Últimos movimientos registrados
            </h3>

            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:#f3f4f6;">
                        <th style="border:1px solid #ddd; padding:8px;">Fecha</th>
                        <th style="border:1px solid #ddd; padding:8px;">Producto</th>
                        <th style="border:1px solid #ddd; padding:8px;">Usuario</th>
                        <th style="border:1px solid #ddd; padding:8px;">Tipo</th>
                        <th style="border:1px solid #ddd; padding:8px;">Stock anterior</th>
                        <th style="border:1px solid #ddd; padding:8px;">Stock nuevo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ultimosMovimientos as $movimiento)
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
                                {{ $movimiento->stock_anterior }}
                            </td>
                            <td style="border:1px solid #ddd; padding:8px;">
                                {{ $movimiento->stock_nuevo }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="border:1px solid #ddd; padding:12px; text-align:center;">
                                No hay movimientos recientes.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>