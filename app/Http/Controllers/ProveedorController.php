<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::orderBy('nombre')->paginate(10);
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'nit' => 'nullable|string|max:30|unique:proveedores,nit',
            'telefono' => 'nullable|string|max:30',
            'correo' => 'nullable|email|max:150',
            'direccion' => 'nullable|string|max:200',
        ]);

        $proveedor = Proveedor::create($validated);

        Log::info('Proveedor creado', [
            'user_id' => auth()->id(),
            'proveedor_id' => $proveedor->id,
        ]);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor creado correctamente.');
    }

    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'nit' => 'nullable|string|max:30|unique:proveedores,nit,' . $proveedor->id,
            'telefono' => 'nullable|string|max:30',
            'correo' => 'nullable|email|max:150',
            'direccion' => 'nullable|string|max:200',
        ]);

        $proveedor->update($validated);

        Log::info('Proveedor actualizado', [
            'user_id' => auth()->id(),
            'proveedor_id' => $proveedor->id,
        ]);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor actualizado correctamente.');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->update(['estado' => false]);

        Log::warning('Proveedor desactivado', [
            'user_id' => auth()->id(),
            'proveedor_id' => $proveedor->id,
        ]);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor desactivado correctamente.');
    }
}