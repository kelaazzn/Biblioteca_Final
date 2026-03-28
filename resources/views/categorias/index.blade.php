@extends('layout.admin')

@section('title', 'Gestión de Categorías')

@section('content')
<div class="p-8">
    <nav class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-gray-400 mb-4">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Inicio</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-blue-600 font-bold">Categorías</span>
    </nav>

    @if(session()->has('success'))
        <div class="bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 relative" role="alert">
            <strong class="font-bold">✓ {{ session('success') }}</strong>
        </div>
    @endif

    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900 mb-1">Gestión de Categorías</h1>
        <p class="text-gray-500 text-sm">Administra las clasificaciones para organizar los libros de la biblioteca.</p>
    </div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xl">
                <i class="fa-solid fa-tags"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Categorías</p>
                <p class="text-2xl font-black text-gray-900">{{ $categorias->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center text-xl">
                <i class="fa-solid fa-star"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Más Utilizada</p>
                <p class="text-xl font-black text-gray-900 uppercase">
                    {{ $categoriaMasUtilizada && $categoriaMasUtilizada->libros_count > 0 ? $categoriaMasUtilizada->nombre : 'Sin registros' }}
                </p>
            </div>
        </div>

        <div class="bg-gray-900 p-6 rounded-xl shadow-lg flex items-center gap-4">
            <div class="w-10 h-10 bg-white/10 text-white rounded-lg flex items-center justify-center text-lg">
                <i class="fa-solid fa-circle-info"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest italic">Tip de Admin</p>
                <p class="text-[11px] text-gray-300 leading-tight">Usa nombres cortos y claros para que el catálogo sea fácil de navegar.</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4 bg-white">
            <div>
                <h2 class="text-xl font-black text-gray-800">Listado de Categorías</h2>
                <p class="text-xs text-gray-400 mt-1">Gestión del catálogo central</p>
            </div>

            <div class="flex items-center gap-3 w-full md:w-auto">
                <div class="relative w-full md:w-64">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input type="text" 
                           placeholder="Buscar categoría..." 
                           class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                </div>

                <a href="{{ route('categorias.create') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 hover:bg-blue-700 hover:shadow-lg transition-all text-sm whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> Nueva Categoría
                </a>
            </div>
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
                            <td class="px-6 py-4 font-mono text-gray-400 font-bold">
                                #{{ $categoria->id }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-gray-900 font-bold group-hover:text-blue-600 transition">
                                    {{ $categoria->nombre }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('categorias.edit', $categoria->id) }}" 
                                    class="p-2 hover:bg-white rounded-lg text-blue-600 shadow-sm transition border border-transparent hover:border-gray-100">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('¿Estás seguro de eliminar esta categoría?')"
                                                class="p-2 hover:bg-white rounded-lg text-red-500 shadow-sm transition border border-transparent hover:border-gray-100">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($categorias->hasPages())
        <div class="p-6 border-t border-gray-50 bg-gray-50/30">
            {{ $categorias->links() }}
        </div>
        @endif
    </div>

    <div class="mt-6 flex justify-between items-center text-[10px] text-gray-400 uppercase tracking-widest font-bold">        <div class="flex items-center gap-2">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            Sincronización de categorias en curso
        </div>
        <div>
            Último registro: {{ now()->format('d/m/Y H:i A') }}
        </div>
    </div>
</div>
@endsection