@extends('layout.admin')

@section('title', 'Gestión de Categorías')

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

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition">
            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Total Categorías</p>
            <p class="text-3xl font-black text-gray-800 mt-1">12</p>
            <i class="fa-solid fa-tags absolute -right-2 -bottom-2 text-blue-50 text-6xl group-hover:text-blue-100 transition"></i>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition">
            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Más Utilizada</p>
            <p class="text-xl font-black text-gray-800 mt-1 uppercase">Literatura</p>
            <i class="fa-solid fa-star absolute -right-2 -bottom-2 text-yellow-50 text-6xl group-hover:text-yellow-100 transition"></i>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition">
            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Libros sin categoría</p>
            <p class="text-3xl font-black text-gray-800 mt-1">0</p>
            <i class="fa-solid fa-circle-exclamation absolute -right-2 -bottom-2 text-green-50 text-6xl group-hover:text-green-100 transition"></i>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-white">
            <div>
                <h2 class="text-xl font-black text-gray-800">Listado de Categorías</h2>
                <p class="text-xs text-gray-400 mt-1">Organización del catálogo</p>
            </div>
            <a href="{{ route('categorias.create') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 hover:bg-blue-700 hover:shadow-lg transition-all text-sm">
                <i class="fa-solid fa-plus"></i> Nueva Categoría
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 text-gray-400 text-[10px] uppercase font-black tracking-widest">
                    <tr>
                        <th class="px-6 py-4 w-20">ID</th>
                        <th class="px-6 py-4">Nombre de la Categoría</th>
                        <th class="px-6 py-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-600 font-medium">
                    @foreach($categorias as $categoria)
                        <tr class="hover:bg-blue-50/30 transition group">
                            <td class="px-6 py-4 font-mono text-blue-600 font-bold">
                                #{{ str_pad($categoria->id, 3, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-gray-900 font-bold group-hover:text-blue-600 transition">
                                    {{ $categoria->nombre }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button class="p-2 hover:bg-white rounded-lg text-blue-600 shadow-sm transition">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="p-2 hover:bg-white rounded-lg text-red-500 shadow-sm transition">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection