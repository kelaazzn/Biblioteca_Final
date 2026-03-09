<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Libro;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->user_type == 'admin'){

            $libros = Libro::paginate(4);

            $total = Libro::count();
            $disponibles = Libro::where('estatus', 0)->count();
            $prestados = Libro::where('estatus', 1)->count();
            $ocupados = Libro::where('estatus', 2)->count();
            $perdidos = Libro::where('estatus', 3)->count();

            return view('home.index', compact('libros', 'total', 'prestados', 'disponibles', 'ocupados', 'perdidos'));
        } else{
            return view('home.index_user');
        }
    }
}
