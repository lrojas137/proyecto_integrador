<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('nombre')->paginate(10);
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $categoria = Categoria::create($validated);

        Log::info('Categoría creada', [
            'user_id' => auth()->id(),
            'categoria_id' => $categoria->id,
        ]);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre,' . $categoria->id,
            'descripcion' => 'nullable|string|max:255',
        ]);

        $categoria->update($validated);

        Log::info('Categoría actualizada', [
            'user_id' => auth()->id(),
            'categoria_id' => $categoria->id,
        ]);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->update(['estado' => false]);

        Log::warning('Categoría desactivada', [
            'user_id' => auth()->id(),
            'categoria_id' => $categoria->id,
        ]);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría desactivada correctamente.');
    }
}