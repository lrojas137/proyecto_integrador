<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Validation\ValidationException;
use Throwable;

class MovimientoController extends Controller




{
    public function index()
    {
        $movimientos = Movimiento::with(['producto', 'usuario'])
            ->latest()
            ->paginate(10);

        return view('movimientos.index', compact('movimientos'));
    }

    public function create()
    {
        $productos = Producto::where('estado', true)
            ->orderBy('nombre')
            ->get();

        return view('movimientos.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'tipo' => 'required|in:entrada,salida,ajuste',
            'cantidad' => 'required|integer|min:0',
            'observacion' => 'nullable|string|max:500',
        ]);

        if (in_array($validated['tipo'], ['entrada', 'salida']) && $validated['cantidad'] < 1) {
            return back()
                ->withErrors(['cantidad' => 'La cantidad debe ser mayor a cero para entradas y salidas.'])
                ->withInput();
        }

        try {
            DB::transaction(function () use ($validated) {
                $producto = Producto::lockForUpdate()->findOrFail($validated['producto_id']);

                $stockAnterior = $producto->stock;

                if ($validated['tipo'] === 'entrada') {
                    $stockNuevo = $stockAnterior + $validated['cantidad'];
                } elseif ($validated['tipo'] === 'salida') {
                    if ($validated['cantidad'] > $stockAnterior) {
                        throw ValidationException::withMessages([
                            'cantidad' => 'No hay stock suficiente para realizar la salida.',
                        ]);
                    }

                    $stockNuevo = $stockAnterior - $validated['cantidad'];
                } else {
                    $stockNuevo = $validated['cantidad'];
                }

                $producto->update([
                    'stock' => $stockNuevo,
                ]);

                $movimiento = Movimiento::create([
                    'producto_id' => $producto->id,
                    'user_id' => auth()->id(),
                    'tipo' => $validated['tipo'],
                    'cantidad' => $validated['cantidad'],
                    'stock_anterior' => $stockAnterior,
                    'stock_nuevo' => $stockNuevo,
                    'observacion' => $validated['observacion'] ?? null,
                ]);

                Log::info('Movimiento de inventario registrado', [
                    'user_id' => auth()->id(),
                    'movimiento_id' => $movimiento->id,
                    'producto_id' => $producto->id,
                    'tipo' => $validated['tipo'],
                    'stock_anterior' => $stockAnterior,
                    'stock_nuevo' => $stockNuevo,
                ]);
            });

            return redirect()->route('movimientos.index')
                ->with('success', 'Movimiento registrado correctamente.');

        } catch (ValidationException $e) {
            throw $e;

        } catch (Throwable $e) {
            Log::error('Error al registrar movimiento de inventario', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withErrors(['general' => 'No fue posible registrar el movimiento. Intente nuevamente.'])
                ->withInput();
        }
    }
}