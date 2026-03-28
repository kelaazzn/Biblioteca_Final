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

    {{-- Tarjetas de Préstamos (Estilo Libros) --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        {{-- Total Préstamos --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-exchange-alt"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Historial de Préstamos</p>
                <p class="text-2xl font-black text-gray-900 leading-none">{{ $totalPrestamos }}</p>
                <p class="text-[9px] text-blue-500 font-bold mt-1 flex items-center gap-1 italic uppercase tracking-tighter">
                    <i class="fa-solid fa-layer-group text-[8px]"></i> Prestamos registrados
                </p>
            </div>
        </div>

        {{-- Préstamos Activos --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">En Curso</p>
                <p class="text-2xl font-black text-gray-900 leading-none">{{ $prestamosActivos }}</p>
                <p class="text-[9px] text-green-600 font-bold mt-1 flex items-center gap-1 italic uppercase tracking-tighter">
                    <i class="fa-solid fa-circle-check text-[8px]"></i> Libros fuera
                </p>
            </div>
        </div>

        {{-- Atrasados --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border {{ $prestamosAtrasados > 0 ? 'border-red-100 bg-red-50/30' : 'border-gray-100' }} flex items-center gap-4 group hover:shadow-md transition-all">
            <div class="w-12 h-12 {{ $prestamosAtrasados > 0 ? 'bg-red-100 text-red-600' : 'bg-gray-50 text-gray-400' }} rounded-full flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <div>
                <p class="text-[10px] font-black {{ $prestamosAtrasados > 0 ? 'text-red-500' : 'text-gray-400' }} uppercase tracking-widest">Atrasados</p>
                <p class="text-2xl font-black {{ $prestamosAtrasados > 0 ? 'text-red-600' : 'text-gray-900' }} leading-none">{{ $prestamosAtrasados }}</p>
                <p class="text-[9px] {{ $prestamosAtrasados > 0 ? 'text-red-500' : 'text-gray-400' }} font-bold mt-1 flex items-center gap-1 italic uppercase tracking-tighter">
                    <i class="fa-solid fa-triangle-exclamation text-[8px]"></i> Fuera de tiempo
                </p>
            </div>
        </div>

        {{-- Entregas Hoy --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-calendar-day"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Entregas Hoy</p>
                <p class="text-2xl font-black text-gray-900 leading-none">{{ $entregasHoy }}</p>
                <p class="text-[9px] text-amber-500 font-bold mt-1 flex items-center gap-1 italic uppercase tracking-tighter">
                    <i class="fa-solid fa-bell text-[8px]"></i> Por recibir hoy
                </p>
            </div>
        </div>
    </div>

    {{-- Filtros Rápidos--}}
    <div class="flex flex-wrap items-center gap-2 mb-6">
        <button class="bg-blue-600 text-white px-5 py-2 rounded-full text-xs font-bold shadow-sm transition hover:bg-blue-700">
            Todos los préstamos
        </button>
        
        <button class="bg-white border border-gray-200 text-gray-500 px-5 py-2 rounded-full text-xs font-bold hover:bg-gray-50 hover:border-blue-300 transition flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-blue-400"></span> Activos
        </button>

        <button class="bg-white border border-gray-200 text-gray-500 px-5 py-2 rounded-full text-xs font-bold hover:bg-gray-50 hover:border-green-300 transition flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-green-400"></span> Entregados
        </button>

        <button class="bg-white border border-gray-200 text-gray-500 px-5 py-2 rounded-full text-xs font-bold hover:bg-gray-50 hover:border-red-300 transition flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-red-400"></span> Atrasados
        </button>

        <button class="bg-white border border-gray-200 text-gray-400 px-5 py-2 rounded-full text-xs font-bold cursor-not-allowed ml-auto flex items-center gap-2 hover:bg-gray-50 transition">
            <i class="fa-solid fa-file-pdf"></i> Exportar PDF
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Listado de Préstamos</h2>
                <p class="text-xs text-gray-400 mt-1">Gestión del prestamos central</p>
            </div>

        <div class="flex flex-col md:flex-row items-center gap-3 w-full md:w-auto">    
                <div class="relative w-full md:w-64">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input type="text" 
                        placeholder="Buscar por libro o usuario..." 
                        class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                </div>
                
                <a href="{{ route('prestamos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold flex items-center gap-2 hover:bg-blue-700 transition">
                    <i class="fa-solid fa-plus-circle"></i> Registrar Préstamo
                </a>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 text-gray-400 text-[10px] uppercase font-black tracking-widest">
                    <tr>
                        <th class="px-6 py-4 w-20">ID</th>
                        <th class="px-6 py-4">Usuario</th>
                        <th class="px-6 py-4">Libro</th>
                        <th class="px-6 py-4">Fecha Préstamo</th>
                        <th class="px-6 py-4">Fecha Entrega</th>
                        <th class="px-6 py-4">Estatus</th>
                        <th class="px-6 py-4 text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 text-sm text-gray-600 font-medium">
                    @foreach($prestamos as $prestamo)
                    <tr class="hover:bg-blue-50/30 transition group">
                        <td class="px-6 py-4 font-mono text-xs font-bold text-gray-400">#{{ $prestamo->id }}</td>
                        
                        {{-- Usuario con efecto hover azul --}}
                        <td class="px-6 py-4">
                            <span class="text-gray-900 font-bold group-hover:text-blue-600 transition">
                                {{ $prestamo->usuario->name ?? $prestamo->usuario->nombre ?? 'ID: '.$prestamo->usuario_id }}
                            </span>
                        </td>

                        {{-- Libro --}}
                        <td class="px-6 py-4 text-gray-700">
                            {{ $prestamo->libro->titulo ?? $prestamo->libro->nombre ?? 'ID: '.$prestamo->libro_id }}
                        </td>

                        <td class="px-6 py-4 text-gray-500 italic">{{ \Carbon\Carbon::parse($prestamo->fecha)->format('d/m/Y H:i') }}</td>

                        <td class="px-6 py-4">
                            <span class="{{ strtotime($prestamo->fecha_entrega) < time() && $prestamo->estado != 'entregado' ? 'text-red-500 font-black underline decoration-2' : 'text-gray-500' }}">
                                {{ \Carbon\Carbon::parse($prestamo->fecha_entrega)->format('d/m/Y H:i') }}
                            </span>
                        </td>

                        {{-- Estatus con el estilo EXACTO de Usuarios/Libros --}}
                        <td class="px-6 py-4">
                            @php
                                // Lógica: Si la fecha de entrega ya pasó y el libro NO ha sido entregado
                                $esAtrasado = strtotime($prestamo->fecha_entrega) < time() && $prestamo->estado != 'entregado';
                            @endphp

                            @if($esAtrasado)
                                {{-- Badge de ATRASADO --}}
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-600 text-[10px] font-bold uppercase tracking-widest border border-red-100 shadow-sm">
                                    <i class="fa-solid fa-triangle-exclamation text-[9px]"></i> Atrasado
                                </span>
                            @else
                                @switch($prestamo->estado)
                                    @case('activo')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-widest border border-blue-100 shadow-sm">
                                            <i class="fa-solid fa-clock text-[9px]"></i> Pendiente
                                        </span>
                                        @break

                                    @case('entregado')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-50 text-green-600 text-[10px] font-bold uppercase tracking-widest border border-green-100 shadow-sm">
                                            <i class="fa-solid fa-circle-check text-[9px]"></i> Entregado
                                        </span>
                                        @break

                                    @default
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-[10px] font-bold uppercase tracking-widest border border-amber-100 shadow-sm">
                                            <i class="fa-solid fa-circle-exclamation text-[9px]"></i> {{ $prestamo->estado }}
                                        </span>
                                @endswitch
                            @endif
                        </td>

                        {{-- Acciones con botones estilo "Libros" --}}
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2">
                                @php
                                    $esAtrasado = strtotime($prestamo->fecha_entrega) < time() && $prestamo->estado != 'entregado';
                                @endphp

                                {{-- CASO: EL LIBRO NO SE HA ENTREGADO (Activo o Atrasado) --}}
                                @if($prestamo->estado != 'entregado')
                                    
                                    {{-- Acción: Entregar Libro (Siempre visible si no se ha entregado) --}}
                                    <a href="{{ route('prestamos.entregar', $prestamo->id) }}" 
                                    class="p-2 hover:bg-white rounded-lg text-green-600 shadow-sm transition border border-transparent hover:border-gray-100"
                                    title="Marcar como entregado">
                                        <i class="fa-solid fa-hand-holding-hand"></i>
                                    </a>

                                    @if($esAtrasado)
                                        {{-- ACCIONES ESPECÍFICAS PARA ATRASADOS --}}
                                        
                                        {{-- Acción: Aviso de Urgencia (WhatsApp con mensaje de atraso) --}}
                                        <a href="https://wa.me/?text=Hola, el libro '{{ $prestamo->libro->titulo }}' tiene un retraso. Favor de entregarlo." 
                                        target="_blank"
                                        class="p-2 hover:bg-red-50 rounded-lg text-red-600 shadow-sm transition border border-red-100"
                                        title="Enviar aviso de retraso urgente">
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                        </a>

                                        {{-- Acción: Ver Multa (Calculada al vuelo) --}}
                                        <button onclick="alechrt('Días de retraso: {{ now()->diffInDays($prestamo->fecha_entrega) }} \nMulta sugerida: ${{ now()->diffInDays($prestamo->fecha_entrega) * 5 }} MXN')" 
                                                class="p-2 hover:bg-amber-50 rounded-lg text-amber-600 shadow-sm transition border border-amber-100"
                                                title="Calcular multa">
                                            <i class="fa-solid fa-file-invoice-dollar"></i>
                                        </button>

                                    @else
                                        {{-- ACCIONES PARA PRÉSTAMOS A TIEMPO --}}
                                        
                                        {{-- Acción: Extender Tiempo --}}
                                        <a href="#" 
                                        class="p-2 hover:bg-white rounded-lg text-amber-500 shadow-sm transition border border-transparent hover:border-gray-100"
                                        title="Extender fecha de entrega">
                                            <i class="fa-solid fa-calendar-plus"></i>
                                        </a>

                                        {{-- Acción: Enviar Recordatorio Amigable --}}
                                        <a href="#" 
                                        class="p-2 hover:bg-white rounded-lg text-blue-500 shadow-sm transition border border-transparent hover:border-gray-100"
                                        title="Enviar recordatorio amigable">
                                            <i class="fa-solid fa-bell"></i>
                                        </a>
                                    @endif
                                @endif

                                {{-- ACCIONES COMUNES (Siempre visibles) --}}
                                
                                {{-- Ver Detalles --}}
                                <a href="#" 
                                class="p-2 hover:bg-white rounded-lg text-gray-500 shadow-sm transition border border-transparent hover:border-gray-100"
                                title="Ver detalles del préstamo">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                {{-- Eliminar --}}
                                <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('¿Eliminar registro?')"
                                            class="p-2 hover:bg-white rounded-lg text-red-500 shadow-sm transition border border-transparent hover:border-gray-100"
                                            title="Eliminar registro">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
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

    <div class="mt-6 flex justify-between items-center text-[10px] text-gray-400 uppercase tracking-widest font-bold">        <div class="flex items-center gap-2">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            Sincronización de prestamos en curso
        </div>
        <div>
            Último registro: {{ now()->format('d/m/Y H:i A') }}
        </div>
    </div>

</div> 
@endsection