@extends('layout.admin')

@section('title', 'Editar Libro')

@section('content')
<div class="p-8 max-w-2xl">
    <nav class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-gray-400 mb-4">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Inicio</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-gray-400">Libros</span>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-blue-600 font-bold">Editar Libro</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-black text-gray-800">Editar Libro</h2>
                <p class="text-xs text-gray-400 mt-1">Modifica la información del ejemplar: <b>{{ $libro->nombre }}</b></p>
            </div>
            <a href="{{ route('home') }}" class="bg-gray-100 text-gray-600 px-4 py-2 rounded-xl font-bold flex items-center gap-2 hover:bg-gray-200 transition-all text-xs">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>
        </div>

        {{-- La ruta debe apuntar a update y pasar el ID del libro --}}
        <form action="{{ route('libros.update', $libro->id) }}" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT') {{-- Importante para que Laravel sepa que es una actualización --}}
            
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-700 text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Título --}}
            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Título</label>
                <input type="text" name="nombre" value="{{ old('nombre', $libro->nombre) }}" required 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
            </div>

            {{-- Autor --}}
            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Autor</label>
                <input type="text" name="autor" value="{{ old('autor', $libro->autor) }}" required 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
            </div>

            {{-- Editorial --}}
            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Editorial</label>
                <input type="text" name="editorial" value="{{ old('editorial', $libro->editorial) }}" required 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
            </div>

            {{-- ISBN --}}
            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn', $libro->isbn) }}" required 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
            </div>

            {{-- Categoría con lógica de selección --}}
            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Categoría</label>
                <select name="categoria_id" required 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all appearance-none">
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ $libro->categoria_id == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Estatus con lógica de selección --}}
            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Estado de Disponibilidad</label>
                <select name="estatus" required 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all appearance-none">
                    <option value="0" {{ $libro->estatus == 0 ? 'selected' : '' }}>Disponible</option>
                    <option value="1" {{ $libro->estatus == 1 ? 'selected' : '' }}>Prestado</option>
                    <option value="2" {{ $libro->estatus == 2 ? 'selected' : '' }}>Ocupado (En sala)</option>
                    <option value="3" {{ $libro->estatus == 3 ? 'selected' : '' }}>Perdido / Dañado</option>
                </select>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 transition-all text-sm flex items-center gap-2">
                    <i class="fa-solid fa-save"></i> Actualizar Libro
                </button>
                <a href="{{ route('home') }}" class="bg-gray-100 text-gray-600 px-6 py-3 rounded-xl font-bold hover:bg-gray-200 transition-all text-sm">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection