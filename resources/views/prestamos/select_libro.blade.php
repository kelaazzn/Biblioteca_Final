@extends('layout.admin')

@section('title', 'Seleccionar Libro')

@section('content')
<div class="p-8 max-w-2xl">
    {{-- Navegación --}}
    <nav class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-gray-400 mb-4">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Inicio</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <a href="{{ route('prestamos.index') }}" class="hover:text-blue-600 transition">Préstamos</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-blue-600 font-bold">Seleccionar Libro</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        {{-- Encabezado con datos detallados del usuario --}}
        <div class="p-6 border-b border-gray-50 bg-gray-50/50">
            <h2 class="text-xl font-black text-gray-800">Finalizar Préstamo</h2>
            
            <div class="mt-4 p-4 bg-white rounded-2xl border border-gray-100 flex items-start gap-4">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-id-card text-lg"></i>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2 w-full">
                    <div class="col-span-1 md:col-span-2">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Prestado a:</p>
                        <p class="text-sm font-bold text-gray-800">{{ $usuario->name ?? $usuario->nombre }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">ID Usuario:</p>
                        <p class="text-xs font-medium text-blue-600">#{{ $usuario->id }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Email:</p>
                        <p class="text-xs font-medium text-gray-600">{{ $usuario->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Formulario para registrar el préstamo --}}
        <form action="{{ route('prestamos.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            {{-- IDs Ocultos para la transacción --}}
            <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">

            <div>
                <label for="libro_id" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 block">
                    Seleccionar Libro del Catálogo
                </label>
                <div class="relative">
                    <select name="libro_id" id="libro_id" required 
                        class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 outline-none appearance-none transition-all">
                        <option value="" disabled selected>Elija un libro disponible...</option>
                        {{-- Lista de Libros Real --}}
                        @foreach($libros as $libro)
                            <option value="{{ $libro->id }}">
                                {{ $libro->titulo ?? $libro->nombre }} — {{ $libro->autor }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </div>
                <p class="text-[10px] text-gray-400 mt-2 italic">Solo se muestran libros con estatus disponible.</p>
            </div>

            <div class="flex items-center justify-between pt-4">
                <button type="submit" class="bg-blue-600 text-white px-10 py-3 rounded-xl font-bold hover:bg-blue-700 transition-all text-sm shadow-lg shadow-blue-100 flex items-center gap-2">
                    <i class="fa-solid fa-check-circle"></i>
                    Realizar Préstamo
                </button>
                <a href="{{ route('prestamos.create') }}" class="text-gray-400 hover:text-gray-600 text-sm font-bold transition-all">
                    Volver atrás
                </a>
            </div>
        </form>
    </div>
</div>
@endsection