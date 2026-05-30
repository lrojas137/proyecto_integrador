<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Movimiento;

class MonitorController extends Controller
{
    public function index()
    {
        $totalProductos = Producto::where('estado', true)->count();

        $productosStockBajo = Producto::where('estado', true)
            ->whereColumn('stock', '<=', 'stock_minimo')
            ->count();

        $movimientosHoy = Movimiento::whereDate('created_at', today())->count();

        $ultimosMovimientos = Movimiento::with(['producto', 'usuario'])
            ->latest()
            ->take(5)
            ->get();

        return view('monitoreo.index', compact(
            'totalProductos',
            'productosStockBajo',
            'movimientosHoy',
            'ultimosMovimientos'
        ));
    }
}