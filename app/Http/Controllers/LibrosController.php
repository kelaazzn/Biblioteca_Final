<?php

namespace App\Http\Controllers;
use App\Models\Categoria;

use Illuminate\Http\Request;
use App\Models\Libro;

class LibrosController extends Controller
{
    public function create()
    {
        $categorias = \App\Models\Categoria::all();
        return view('libros.create', compact('categorias'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'autor' => 'required|string|max:100',
            'isbn' => 'required|string|max:255',
            'editorial' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'estatus' => 'required|integer|in:0,1,2,3',
        ]);

        $libro = new Libro();
        $libro->nombre = $request->nombre;
        $libro->autor = $request->autor;
        $libro->isbn = $request->isbn;
        $libro->editorial = $request->editorial;
        $libro->categoria_id = $request->categoria_id;
        $libro->estatus = $request->estatus;
        $libro->save();

        return redirect()->route('home')->with('success', 'Libro creado exitosamente');
    }

    public function actualidarEstado(Request $request, Libro $libro)
    { 
        $libro->estatus(['estatus' => $request->nuevo_estado]);
        return back()->with('success', 'Estado actualizado correctamente');
    }

    public function edit($id)
    {
        $libro = Libro::find($id);
        $categorias = \App\Models\Categoria::all();
        return view('libros.edit', compact('libro', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        // 1. Validar los datos que vienen del formulario
        $request->validate([
            'nombre' => 'required|max:255',
            'autor' => 'required|max:255',
            'editorial' => 'required|max:255',
            'isbn' => 'required|max:20',
            'categoria_id' => 'required|exists:categorias,id',
            'estatus' => 'required|integer'
        ]);

        // 2. Buscar el libro en la base de datos
        $libro = Libro::findOrFail($id);

        // 3. Actualizar con los nuevos datos
        $libro->update($request->all());

        // 4. Redirigir al inicio con un mensaje de éxito
        return redirect()->route('home')->with('success', '¡Libro actualizado correctamente!');
    }

    public function destroy($id)
    {
        $libro = Libro::findOrFail($id);
        $libro->delete();
        return redirect()->route('home')->with('success', 'Libro eliminado correctamente');
    }

    public function index()
    {
        // 1. Obtenemos todos los libros para la tabla
        $libros = Libro::paginate(4); 

        // 2. Calculamos todas las variables que tu vista está pidiendo
        $total = Libro::count();
        
        // Asumimos: 1 = Disponible, 2 = Prestado, 3 = Dañado (Ajusta según tus estatus)
        $disponibles = Libro::where('estatus', 1)->count();
        $prestados = Libro::where('estatus', 2)->count();
        $danados = Libro::where('estatus', 3)->count();
        $ocupados = Libro::where('estatus', 4)->count();
        $perdidos = Libro::where('estatus', 5)->count();

        // 3. Enviamos todas las variables a la vista
        return view('libros.index', compact(
            'libros', 
            'total', 
            'disponibles', 
            'ocupados',
            'perdidos',
            'prestados', 
            'danados'
        ));
    }
}
