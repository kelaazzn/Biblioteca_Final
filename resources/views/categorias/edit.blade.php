@extends('layout.admin')

@section('content') 
<div class="p-8">
    <nav class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-gray-400 mb-4">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Inicio</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-blue-600 font-bold">Categorías</span>
    </nav>

    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900 mb-1">Gestión de Categorías</h1>
        <p class="text-gray-500 text-sm">Administra las clasificaciones para organizar los libros de la biblioteca.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-white">
            <div>
                <h2 class="text-xl font-black text-gray-800">Editar Categoría</h2>
                <p class="text-xs text-gray-400 mt-1">Organización del catálogo</p>
            </div>
            <a href="{{ route('categorias') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 hover:bg-blue-700 hover:shadow-lg transition-all text-sm">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>
        </div>

        <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="p-6 border-b border-gray-50">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de la Categoría</label>
                <input type="text" 
                    name="nombre" 
                    id="nombre" 
                    value="{{ $categoria->nombre }}" 
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                    required>
            </div>

            <div class="p-6">
                <button type="submit" class="w-full bg-blue-600 text-white px-5 py-2.5 rounded-xl font-bold flex justify-center items-center gap-2 hover:bg-blue-700 hover:shadow-lg transition-all text-sm">
                    <i class="fa-solid fa-save"></i> Actualizar Categoría
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 

