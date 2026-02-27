@extends('layout.admin')

@section('title', 'Nuevo Libro')

@section('content')
<div class="p-8 max-w-2xl">
    <nav class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-gray-400 mb-4">
        <a href="{{ route('libros') }}" class="hover:text-blue-600 transition">Inicio</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <a href="#" class="hover:text-blue-600 transition">Libros</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-blue-600 font-bold">Nuevo Libro</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50">
            <h2 class="text-xl font-black text-gray-800">Registrar Nuevo Libro</h2>
            <p class="text-xs text-gray-400 mt-1">Añade un nuevo ejemplar a la colección de la biblioteca.</p>
        </div>

        <form action="{{ route('libros.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-700 text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Título</label>
                <input type="text" name="nombre" required placeholder="Ej. Cien años de soledad" 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
            </div>

            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Autor</label>
                <input type="text" name="autor" required placeholder="Ej. Gabriel García Márquez" 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
            </div>

            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Editorial</label>
                <input type="text" name="editorial" required placeholder="Ej. Penguin Random House" 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
            </div>

            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">ISBN</label>
                <input type="text" name="isbn" required placeholder="Ej. 978-0307474728" 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
            </div>

            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Categoría</label>
                <select name="categoria_id" required 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all appearance-none">
                    <option value="">Selecciona una clasificación</option>

                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Estado de Disponibilidad</label>
                <select name="estatus" required 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all appearance-none">
                    <option value="0" selected>Disponible</option>
                    <option value="1">Prestado</option>
                    <option value="2">Ocupado (En sala)</option>
                    <option value="3">Perdido / Dañado</option>
                </select>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition-all text-sm">
                    Guardar Libro
                </button>
                <a href="{{ route('home') }}" class="bg-gray-100 text-gray-600 px-6 py-3 rounded-xl font-bold hover:bg-gray-200 transition-all text-sm">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection