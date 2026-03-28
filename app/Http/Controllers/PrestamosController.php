<?php

namespace App\Http\Controllers;
use App\Models\Prestamo;
use App\Models\Libro;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PrestamosController extends Controller
{
    public function index()
    {
        $prestamos = Prestamo::with(['usuario', 'libro'])->latest()->paginate(10);
        $totalPrestamos = Prestamo::count();        
        
        // 1. Atrasados: Cualquier cosa NO entregada que ya venció
        $prestamosAtrasados = Prestamo::where('estado', '!=', 'entregado')
            ->where('fecha_entrega', '<', Carbon::now())
            ->count();

        // 2. Activos: Solo los que están a tiempo y no se han entregado
        $prestamosActivos = Prestamo::where('estado', '!=', 'entregado')
            ->where('fecha_entrega', '>=', Carbon::now())
            ->count();
        
        // 3. Entregas Hoy: Los que vencen hoy y siguen fuera
        $entregasHoy = Prestamo::where('estado', '!=', 'entregado')
            ->whereDate('fecha_entrega', Carbon::today())
            ->count();

        return view('prestamos.index', compact(
            'prestamos', 
            'totalPrestamos', 
            'prestamosActivos', 
            'prestamosAtrasados', 
            'entregasHoy'
        ));
    }

    public function create()
    {
        $usuarios = User::all();
        $libros = Libro::all();
        return view('prestamos.create', compact('usuarios', 'libros'));
    }

    public function buscar_usuario(Request $request)
    {
        $usuario_id = $request->input('usuario_id');
        $usuario_nombre = $request->input('usuario_nombre');

        if(!empty($usuario_id))
        {
            $usuario = User::findOrFail($usuario_id);
            return view('prestamos.create', compact('usuario'));
        }
        
        if (!empty($usuario_nombre)) 
        {
            $usuario = User::where('name', 'like', '%'.$usuario_nombre.'%')->first();

            return view('prestamos.create', compact('usuario'));
        }
    }

    public function select_libro(Request $request)
    {
        $usuario_id = $request->input('usuario_id');
        $usuario = User::findOrFail($usuario_id);

        $libros = Libro::where('estatus', 0)->get();

        return view('prestamos.select_libro', compact('usuario', 'libros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'libro_id' => 'required|exists:libros,id',
        ]);

        # Crear transacción de préstamo
        \DB::beginTransaction();

        try {
            $prestamo = new Prestamo();
            $prestamo->usuario_id = $request->input('usuario_id');
            $prestamo->libro_id = $request->input('libro_id');
            
            $prestamo->fecha = Carbon::now();
            $prestamo->fecha_entrega = Carbon::now()->addDays(7);
            $prestamo->estado = 'activo';
            $prestamo->save();

            $libro = Libro::findOrFail($request->input('libro_id'));
            $libro->estatus = 1;
            $libro->save();

            \DB::commit();

            return redirect()->route('prestamos.index')->with('success', 'Se ha realizado el préstamo correctamente');

        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->route('prestamos.index')->with('error', 'Ha ocurrido un error al realizar el préstamo');
        }
    }

    public function entregar($id)
    {
        \DB::beginTransaction();
        try
        {
            $prestamo = Prestamo::findOrFail($id);
            $prestamo->estado = 'entregado';
            $prestamo->fecha_entrega = Carbon::now();
            $prestamo->save();

            $libro = Libro::findOrFail($prestamo->libro_id);
            $libro->estatus = 0;
            $libro->save();

            \DB::commit();
            return redirect()->route('prestamos.index')->with('success', 'Se ha realizado la entrega correctamente');

        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->route('prestamos.index')->with('error', 'Ha ocurrido un error al realizar la entrega');
        }
    }

    public function destroy($id)
    {
        $prestamo = \App\Models\Prestamo::findOrFail($id);
        $prestamo->delete();

        return redirect()->route('prestamos.index')
                        ->with('success', 'El registro del préstamo ha sido eliminado correctamente.');
    }
}
