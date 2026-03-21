@extends('layout.admin')

@section('content')
<div class="p-8">
    <nav class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-gray-400 mb-4">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Inicio</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-blue-600 font-bold">Préstamos</span>
    </nav>

    @if(session()->has('success'))
        <div class="bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 relative" role="alert">
            <strong class="font-bold">✓ {{ session('success') }}</strong>
        </div>
    @endif

    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900 mb-1">Gestión de Préstamos</h1>
        <p class="text-gray-500 text-sm">Registro detallado de movimientos de libros y fechas de retorno.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Listado de Préstamos</h2>
            <a href="{{ route('prestamos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold flex items-center gap-2 hover:bg-blue-700 transition">
                <i class="fa-solid fa-plus-circle"></i> Registrar Préstamo
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Usuario</th>
                        <th class="px-6 py-4">Libro</th>
                        <th class="px-6 py-4">Fecha Préstamo</th>
                        <th class="px-6 py-4">Fecha Entrega</th>
                        <th class="px-6 py-4">Estatus</th>
                        <th class="px-6 py-4">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                    @foreach($prestamos as $prestamo)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-bold text-gray-400">#{{ $prestamo->id }}</td>
                        
                        {{-- Usuario --}}
                        <td class="px-6 py-4">
                            <span class="font-medium text-gray-800">
                                {{ $prestamo->usuario->name ?? $prestamo->usuario->nombre ?? 'ID: '.$prestamo->usuario_id }}
                            </span>
                        </td>

                        {{-- Libro --}}
                        <td class="px-6 py-4 text-gray-800">
                            {{-- Verifica si en tu tabla Libros es 'titulo' o 'nombre' --}}
                            {{ $prestamo->libro->titulo ?? $prestamo->libro->nombre ?? 'ID: '.$prestamo->libro_id }}
                        </td>

                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($prestamo->fecha)->format('d/m/Y H:i') }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="{{ strtotime($prestamo->fecha_entrega) < time() && $prestamo->estatus != 'entregado' ? 'text-red-500 font-bold' : '' }}">
                                {{ \Carbon\Carbon::parse($prestamo->fecha_entrega)->format('d/m/Y H:i') }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            @if($prestamo->estado == 'activo')
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                    <i class="fa-solid fa-clock mr-1"></i> Pendiente
                                </span>
                            @elseif($prestamo->estado == 'entregado')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                    <i class="fa-solid fa-check-circle mr-1"></i> Entregado
                                </span>
                            @else
                                <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                    {{ $prestamo->estado }}
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 flex gap-3">
                            @if($prestamo->estado == 'activo')
                                <a href="{{ route('prestamos.entregar', $prestamo->id) }}" 
                                class="bg-green-100 text-green-700 px-3 py-1.5 rounded-lg text-xs font-black uppercase hover:bg-green-200 transition flex items-center gap-2">
                                    <i class="fa-solid fa-hand-holding-hand"></i>
                                    Entregar
                                </a>
                            @endif

                            <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('¿Eliminar registro de préstamo?')"
                                        class="text-red-500 hover:text-red-700 transition font-bold">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>                
            </table>
        </div>

        {{-- Footer de paginación --}}
        <div class="p-6 border-t border-gray-100 flex justify-between items-center bg-gray-50">
            <p class="text-sm text-gray-500">
                Mostrando <span class="font-semibold text-gray-700">{{ $prestamos->firstItem() }}</span> a 
                <span class="font-semibold text-gray-700">{{ $prestamos->lastItem() }}</span> de 
                <span class="font-semibold text-gray-700">{{ $prestamos->total() }}</span> registros
            </p>
            <div>
                {{ $prestamos->links() }}
            </div>
        </div>
    </div> 
</div> 
@endsection