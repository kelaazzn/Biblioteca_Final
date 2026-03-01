@extends('layout.admin')

@section('content')
<div class="p-8">
    <nav class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-gray-400 mb-4">
        <a href="{{ route('libros') }}" class="hover:text-blue-600 transition">Inicio</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-blue-600 font-bold">Libros</span>
    </nav>

    @if(session()->has('success'))
        <div class="bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">✓ {{ session('success') }}</strong>
        </div>
    @endif

    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900 mb-1">Gestión de Libros</h1>
        <p class="text-gray-500 text-sm">Administra el catálogo completo y el estado de los ejemplares.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative overflow-hidden">
            <p class="text-gray-500 text-sm font-medium">Total de libros</p>
            <p class="text-2xl font-bold text-gray-800">{{ $total }}</p> 
            <i class="fa-solid fa-book absolute right-4 top-1/2 -translate-y-1/2 text-blue-100 text-4xl"></i>
            <p class="text-green-500 text-xs mt-2 flex items-center gap-1">
                <i class="fa-solid fa-clock"></i> Actualizado ahora
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative overflow-hidden">
            <p class="text-gray-500 text-sm font-medium">Libros Disponibles</p>
            <p class="text-2xl font-bold text-gray-800">{{ $disponibles }}</p>
            <i class="fa-solid fa-check-circle absolute right-4 top-1/2 -translate-y-1/2 text-green-100 text-4xl"></i>
            <p class="text-green-500 text-xs mt-2 flex items-center gap-1">
                <i class="fa-solid fa-check-circle"></i> Listos para prestamo
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative overflow-hidden">
            <p class="text-gray-500 text-sm font-medium">Libros prestados</p>
            <p class="text-2xl font-bold text-gray-800">{{ $prestados }}</p> 
            <p class="text-yellow-500 text-xs mt-2 flex items-center gap-1">
                <i class="fa-solid fa-exchange-alt"></i> En circulación
            </p>
            <i class="fa-solid fa-exchange-alt absolute right-4 top-1/2 -translate-y-1/2 text-yellow-100 text-4xl"></i>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative overflow-hidden">
            <p class="text-gray-500 text-sm font-medium">Ocupados</p>
            <p class="text-2xl font-bold text-gray-800">{{ $ocupados }}</p>
            <i class="fa-solid fa-users absolute right-4 top-1/2 -translate-y-1/2 text-green-100 text-4xl"></i>
            <p class="text-orange-500 text-xs mt-2 flex items-center gap-1">
                <i class="fa-solid fa-users"></i> En sala de lectura
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative overflow-hidden">
            <p class="text-gray-500 text-sm font-medium">Perdidos / Dañados</p>
            <p class="text-2xl font-bold text-gray-800">{{ $perdidos }}</p>
            <i class="fa-solid fa-circle-exclamation absolute right-4 top-1/2 -translate-y-1/2 text-red-100 text-4xl"></i>
            <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                <i class="fa-solid fa-triangle-exclamation"></i> Requieren revision
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative overflow-hidden">
            <p class="text-gray-500 text-sm font-medium">Usuarios activos</p>
            <p class="text-2xl font-bold text-gray-800">543</p>
            <p class="text-green-500 text-xs mt-2 flex items-center gap-1">
                <i class="fa-solid fa-arrow-up"></i> 12.7% desde el mes pasado
            </p>
            <i class="fa-solid fa-users absolute right-4 top-1/2 -translate-y-1/2 text-green-100 text-4xl"></i>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative overflow-hidden">
            <p class="text-gray-500 text-sm font-medium">Devoluciones pendientes</p>
            <p class="text-2xl font-bold text-gray-800">24</p>
            <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                <i class="fa-solid fa-arrow-up"></i> 3.4% desde ayer
            </p>
            <i class="fa-solid fa-clock absolute right-4 top-1/2 -translate-y-1/2 text-red-100 text-4xl"></i>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Lista de Libros</h2>
            <a href = "{{ route('libros.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold flex items-center gap-2 hover:bg-blue-700 transition">
                <i class="fa-solid fa-plus"></i> Agregar libro
            </a>
    </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">Nombre del Libro</th>
                        <th class="px-6 py-4">Autor</th>
                        <th class="px-6 py-4">ISBN</th>
                        <th class="px-6 py-4">Editorial</th>
                        <th class="px-6 py-4">Categoría</th>
                        <th class="px-6 py-4">Estado</th>
                        <th class="px-6 py-4">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                    @foreach($libros as $libro)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $libro->nombre }}</td>
                        <td class="px-6 py-4">{{ $libro->autor }}</td>
                        <td class="px-6 py-4">{{ $libro->isbn }}</td>
                        <td class="px-6 py-4">{{ $libro->editorial }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded text-xs">
                                {{ $libro->categoria->nombre ?? 'Sin categoría' }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            @switch($libro->estatus)
                                @case(0)
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Disponible</span>
                                    @break
                                @case(1)
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Prestado</span>
                                    @break
                                @case(2)
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">Ocupado</span>
                                    @break
                                @case(3)
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">Perdido</span>
                                    @break
                                @default
                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-bold">Desconocido</span>
                            @endswitch
                        </td>

                        <td class="px-6 py-4 flex gap-3 text-blue-600 font-bold">
                            <a href="{{ route('libros.edit', $libro->id) }}" class="text-blue-600 hover:underline">Editar</a>
                            <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('¿Estás seguro de eliminar esta categoría?')"
                                                class="p-2 hover:bg-white rounded-lg text-red-500 shadow-sm transition">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>                
            </table>
            </div> <div class="p-6 border-t border-gray-100 flex justify-between items-center bg-gray-50">
                <p class="text-sm text-gray-500">
                    Mostrando <span class="font-semibold text-gray-700">{{ $libros->firstItem() }}</span> a 
                    <span class="font-semibold text-gray-700">{{ $libros->lastItem() }}</span> de 
                    <span class="font-semibold text-gray-700">{{ $libros->total() }}</span> resultados
                </p>
                
                <div class="flex gap-2">
                    {{ $libros->links() }}
                </div>
            </div>
        </div> 
    </div> 
@endsection