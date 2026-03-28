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

    {{-- Encabezado --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900 mb-1">Gestión de Libros</h1>
        <p class="text-gray-500 text-sm">Administra el catálogo completo y el estado de los ejemplares.</p>
    </div>

    {{-- Tarjetas de Libros --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        {{-- Total Libros --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-book"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Libros Totales</p>
                <p class="text-2xl font-black text-gray-900 leading-none">{{ $total }}</p>
                <p class="text-[9px] text-blue-500 font-bold mt-1 flex items-center gap-1 italic uppercase tracking-tighter">
                    <i class="fa-solid fa-arrows-rotate text-[8px] animate-spin-slow"></i> Actualizado ahora
                </p>
            </div>
        </div>

        {{-- Disponibles --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-check-double"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Disponibles</p>
                <p class="text-2xl font-black text-gray-900 leading-none">{{ $disponibles }}</p>
                <p class="text-[9px] text-green-600 font-bold mt-1 flex items-center gap-1 italic uppercase tracking-tighter">
                    <i class="fa-solid fa-circle-check text-[8px]"></i> Listos para préstamo
                </p>
            </div>
        </div>

        {{-- Prestados --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-hand-holding-heart"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">En Préstamo</p>
                <p class="text-2xl font-black text-gray-900 leading-none">{{ $prestados }}</p>
                <p class="text-[9px] text-amber-500 font-bold mt-1 flex items-center gap-1 italic uppercase tracking-tighter">
                    <i class="fa-solid fa-arrow-right-arrow-left text-[8px]"></i> En circulación
                </p>
            </div>
        </div>

        {{-- Ocupados --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-full flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Ocupados</p>
                <p class="text-2xl font-black text-gray-900 leading-none">{{ $ocupados }}</p>
                <p class="text-[9px] text-orange-500 font-bold mt-1 flex items-center gap-1 italic uppercase tracking-tighter">
                    <i class="fa-solid fa-location-dot text-[8px]"></i> En sala de lectura
                </p>
            </div>
        </div>

        {{-- Perdidos --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-red-50 text-red-600 rounded-full flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-circle-exclamation"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Inactivos</p>
                <p class="text-2xl font-black text-gray-900 leading-none">{{ $perdidos }}</p>
                <p class="text-[9px] text-red-500 font-bold mt-1 flex items-center gap-1 italic uppercase tracking-tighter">
                    <i class="fa-solid fa-triangle-exclamation text-[8px]"></i> Requieren revisión
                </p>
            </div>
        </div>

        {{-- Usuarios activos --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-user-check"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Usuarios Activos</p>
                <p class="text-2xl font-black text-gray-900 leading-none">543</p>
                <p class="text-[9px] text-green-600 font-bold mt-1 flex items-center gap-1 italic uppercase tracking-tighter">
                    <i class="fa-solid fa-arrow-up text-[8px]"></i> 12.7% este mes
                </p>
            </div>
        </div>

        {{-- Devoluciones pendientes --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-rotate-left"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Pendientes</p>
                <p class="text-2xl font-black text-gray-900 leading-none">24</p>
                <p class="text-[9px] text-indigo-500 font-bold mt-1 flex items-center gap-1 italic uppercase tracking-tighter">
                    <i class="fa-solid fa-clock text-[8px]"></i> Devolución atrasada
                </p>
            </div>
        </div>

        {{-- Tip de Admin (Igual al de Categorías) --}}
        <div class="bg-gray-900 p-6 rounded-xl shadow-lg flex items-center gap-4">
            <div class="w-10 h-10 bg-white/10 text-white rounded-lg flex items-center justify-center text-lg">
                <i class="fa-solid fa-circle-info"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest italic">Tip de Inventario</p>
                <p class="text-[11px] text-gray-300 leading-tight">Mantén el estatus actualizado para evitar conflictos en préstamos.</p>
            </div>
        </div>
    </div>

    {{-- Filtros Rápidos--}}
    <div class="flex flex-wrap gap-2 mb-5">
        <button class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-xs font-bold shadow-sm">Todos los libros</button>
        <button class="bg-white border border-gray-200 text-gray-500 px-4 py-1.5 rounded-full text-xs font-bold hover:bg-gray-50 transition">Disponibles</button>
        <button class="bg-white border border-gray-200 text-gray-500 px-4 py-1.5 rounded-full text-xs font-bold hover:bg-gray-50 transition">En Préstamo</button>
        <button class="bg-white border border-gray-200 text-gray-500 px-4 py-1.5 rounded-full text-xs font-bold hover:bg-gray-50 transition">Ocupado</button>
        <button class="bg-white border border-gray-200 text-gray-500 px-4 py-1.5 rounded-full text-xs font-bold hover:bg-gray-50 transition">Perdidos y Dañados</button>
        <button class="bg-white border border-gray-200 text-gray-400 px-4 py-1.5 rounded-full text-xs font-bold cursor-not-allowed ml-auto flex items-center gap-2">
            <i class="fa-solid fa-file-pdf"></i> Reporte PDF
        </button>
    </div>

    {{-- Contenedor de Tabla --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Lista de Libros</h2>
            <a href = "{{ route('libros.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold flex items-center gap-2 hover:bg-blue-700 transition">
                <i class="fa-solid fa-plus"></i> Agregar libro
            </a>
    </div>
        
        <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50/50 border-b border-gray-100">
                <tr class="text-gray-400 text-[10px] uppercase font-black tracking-widest">
                    <th class="px-6 py-4">Nombre del Libro</th>
                    <th class="px-6 py-4">Autor</th>
                    <th class="px-6 py-4">ISBN</th>
                    <th class="px-6 py-4">Editorial</th>
                    <th class="px-6 py-4 text-center">Categoría</th>
                    <th class="px-6 py-4 text-center">Estado</th>
                    <th class="px-6 py-4 text-center">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 text-sm text-gray-600 font-medium">
                @foreach($libros as $libro)
                <tr class="hover:bg-blue-50/30 transition group">
                    {{-- Nombre --}}
                    <td class="px-6 py-4">
                        <span class="text-gray-900 font-bold group-hover:text-blue-600 transition">
                            {{ $libro->nombre }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $libro->autor }}</td>
                    <td class="px-6 py-4 font-mono text-xs text-gray-400">{{ $libro->isbn }}</td>
                    <td class="px-6 py-4">{{ $libro->editorial }}</td>
                    
                    {{-- Categoría--}}
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-widest border border-blue-100">
                            <i class="fa-solid fa-tag text-[9px]"></i>
                            {{ $libro->categoria->nombre ?? 'Sin categoría' }}
                        </span>
                    </td>

                    {{-- Estado --}}
                    <td class="px-6 py-4">
                        @switch($libro->estatus)
                            @case(0)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-50 text-green-600 text-[10px] font-bold uppercase tracking-widest border border-green-100">
                                    <i class="fa-solid fa-circle-check text-[9px]"></i> Disponible
                                </span>
                                @break
                            @case(1)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-[10px] font-bold uppercase tracking-widest border border-amber-100">
                                    <i class="fa-solid fa-exchange-alt text-[9px]"></i> Prestado
                                </span>
                                @break
                            @case(2)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 text-[10px] font-bold uppercase tracking-widest border border-indigo-100">
                                    <i class="fa-solid fa-users text-[9px]"></i> Ocupado
                                </span>
                                @break
                            @case(3)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-600 text-[10px] font-bold uppercase tracking-widest border border-red-100">
                                    <i class="fa-solid fa-circle-exclamation text-[9px]"></i> Perdido
                                </span>
                                @break
                        @endswitch
                    </td>

                    {{-- Acciones --}}
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('libros.edit', $libro->id) }}" 
                                class="p-2 hover:bg-white rounded-lg text-blue-600 shadow-sm transition border border-transparent hover:border-gray-100"
                                title="Editar libro">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('¿Estás seguro de eliminar este libro?')"
                                        class="p-2 hover:bg-white rounded-lg text-red-500 shadow-sm transition border border-transparent hover:border-gray-100"
                                        title="Eliminar libro">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
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

        <div class="mt-6 flex justify-between items-center text-[10px] text-gray-400 uppercase tracking-widest font-bold">        <div class="flex items-center gap-2">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                Sincronización de libros en curso
            </div>
            <div>
                Último registro: {{ now()->format('d/m/Y H:i A') }}
            </div>
        </div>

    </div> 
@endsection