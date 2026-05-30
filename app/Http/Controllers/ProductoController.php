<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['categoria', 'proveedor'])
            ->where('estado', true)
            ->orderBy('nombre')
            ->paginate(10);

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::where('estado', true)->orderBy('nombre')->get();
        $proveedores = Proveedor::where('estado', true)->orderBy('nombre')->get();

        return view('productos.create', compact('categorias', 'proveedores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'nullable|exists:proveedores,id',
            'nombre' => 'required|string|max:150',
            'codigo' => 'required|string|max:50|unique:productos,codigo',
            'descripcion' => 'nullable|string|max:500',
            'stock' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        $producto = Producto::create($validated);

        Log::info('Producto creado', [
            'user_id' => auth()->id(),
            'producto_id' => $producto->id,
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::where('estado', true)->orderBy('nombre')->get();
        $proveedores = Proveedor::where('estado', true)->orderBy('nombre')->get();

        return view('productos.edit', compact('producto', 'categorias', 'proveedores'));
    }

    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'nullable|exists:proveedores,id',
            'nombre' => 'required|string|max:150',
            'codigo' => 'required|string|max:50|unique:productos,codigo,' . $producto->id,
            'descripcion' => 'nullable|string|max:500',
            'stock' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        $producto->update($validated);

        Log::info('Producto actualizado', [
            'user_id' => auth()->id(),
            'producto_id' => $producto->id,
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->update(['estado' => false]);

        Log::warning('Producto desactivado', [
            'user_id' => auth()->id(),
            'producto_id' => $producto->id,
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto desactivado correctamente.');
    }
}