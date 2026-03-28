<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categoria::paginate(10);

        $categoriaMasUtilizada = Categoria::withCount('libros')
        ->get()
        ->sortByDesc('libros_count')
        ->first();

        return view('categorias.index', compact('categorias', 'categoriaMasUtilizada'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->save();

        return redirect()->route('categorias')->with('success', 'Categoria creada exitosamente');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->nombre = $request->nombre;
        $categoria->save();

        return redirect()->route('categorias')->with('success', 'Categoria actualizada exitosamente');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categorias')->with('success', 'Categoría eliminada exitosamente');
    }
}



