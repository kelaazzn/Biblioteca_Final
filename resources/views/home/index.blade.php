@extends('layout.admin')

@section('content')
<div class="p-8">
    {{-- Navegación simplificada --}}
    <nav class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-gray-400 mb-4">
        <span class="text-blue-600 font-bold">Panel de Control</span>
    </nav>

    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900 mb-1">Bienvenido, {{ Auth::user()->name }}</h1>
        <p class="text-gray-500 text-sm">Aquí tienes un resumen del estado actual de la biblioteca hoy.</p>
    </div>

    {{-- Grid de Estadísticas (Mantuvimos tus contadores pero con mejor estilo) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Libros --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                <i class="fa-solid fa-book text-xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Libros</p>
                <p class="text-2xl font-black text-gray-800">{{ $total }}</p>
            </div>
        </div>

        {{-- Disponibles --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600">
                <i class="fa-solid fa-check-circle text-xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Disponibles</p>
                <p class="text-2xl font-black text-gray-800">{{ $disponibles }}</p>
            </div>
        </div>

        {{-- Prestados --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center text-yellow-600">
                <i class="fa-solid fa-hand-holding-heart text-xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Prestados</p>
                <p class="text-2xl font-black text-gray-800">{{ $prestados }}</p>
            </div>
        </div>

        {{-- Perdidos --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-red-600">
                <i class="fa-solid fa-triangle-exclamation text-xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Bajas/Dañados</p>
                <p class="text-2xl font-black text-gray-800">{{ $perdidos }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
    
        {{-- COLUMNA IZQUIERDA Y CENTRAL (Más ancha: 2/3) --}}
        <div class="lg:col-span-2 space-y-8">
            
            {{-- Banner de Registro --}}
            <div class="bg-blue-50 rounded-3xl p-8 border border-blue-100 relative overflow-hidden shadow-sm">
                <div class="relative z-10">
                    <h2 class="text-2xl font-black mb-2 text-slate-900 italic uppercase tracking-tighter">¿Nuevo ejemplar en la colección?</h2>
                    <p class="text-slate-600 mb-6 text-sm font-medium max-w-md">
                        Registra los libros recién adquiridos para que aparezcan en el inventario disponible para los usuarios.
                    </p>
                    <a href="{{ route('libros.create') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-blue-700 transition-all shadow-md">
                        <i class="fa-solid fa-plus"></i> COMENZAR REGISTRO
                    </a>
                </div>
                <i class="fa-solid fa-book-medical absolute -right-4 -bottom-4 text-9xl text-blue-100/40 rotate-12"></i>
            </div>

            {{-- Lista de Recientes --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-black text-gray-800 text-sm flex items-center gap-2 uppercase tracking-widest">
                        <i class="fa-solid fa-clock text-blue-500"></i> Agregados recientemente
                    </h3>
                    <a href="{{ route('libros') }}" class="text-blue-600 text-[10px] font-black hover:underline uppercase">Ver todo el catálogo</a>
                </div>
                
                <div class="space-y-3">
                    @forelse($libros as $libro)
                        <div class="flex items-center justify-between p-4 bg-gray-50/50 rounded-2xl border border-transparent hover:border-blue-100 hover:bg-white transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm text-blue-600 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-book text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ $libro->nombre }}</p>
                                    <p class="text-[10px] text-gray-500 font-medium italic">{{ $libro->autor }} • {{ $libro->categoria->nombre ?? 'Sin categoría' }}</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-mono text-gray-400 bg-white px-2 py-1 rounded-lg border border-gray-100">
                                ID: #{{ str_pad($libro->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                    @empty
                        <div class="py-10 text-center">
                            <i class="fa-solid fa-folder-open text-gray-200 text-4xl mb-3"></i>
                            <p class="text-gray-400 text-xs italic">No hay movimientos recientes en el catálogo.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-gray-800 text-xs uppercase mb-1">Estado del Sistema</h3>
                        <p class="text-[10px] text-gray-400">Base de Datos: <span class="text-green-500 font-bold italic">● Online</span></p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] text-gray-400 uppercase font-bold">Última Sincronización</p>
                        <p class="text-xs font-black text-gray-700 italic">{{ now()->format('H:i') }}</p>
                    </div>
                </div>

                <div class="bg-slate-900 rounded-2xl p-6 shadow-lg flex items-center justify-between group cursor-pointer overflow-hidden relative">
                    <div class="relative z-10">
                        <h3 class="text-white font-bold text-xs uppercase mb-1 italic">Ayuda Rápida</h3>
                        <p class="text-slate-400 text-[10px]">¿Dudas con el ISBN o Categorías?</p>
                    </div>
                    <button class="relative z-10 bg-slate-800 text-white text-[10px] font-black px-4 py-2 rounded-lg group-hover:bg-blue-600 transition-colors uppercase">
                        Consultar Manual
                    </button>
                    <i class="fa-solid fa-circle-question absolute -right-2 -bottom-2 text-5xl text-slate-800 group-hover:text-blue-900/40 transition-colors"></i>
                </div>
            </div>
        </div>

        {{-- COLUMNA DERECHA (Lo que estaba abajo ahora va aquí: 1/3) --}}
        <div class="space-y-6">
            
            {{-- Alertas Críticas --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-gray-100 bg-red-50/30 flex items-center gap-2">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 text-xs"></i>
                    <h3 class="font-black text-gray-800 text-[11px] uppercase tracking-widest italic">Alertas de Inventario</h3>
                </div>
                <div class="divide-y divide-gray-50">
                    {{-- Fila 1 --}}
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex justify-between items-start mb-1">
                            <p class="text-xs font-bold text-gray-800">El Principito</p>
                            <span class="text-[9px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-black">DAÑADO</span>
                        </div>
                        <a href="#" class="text-[10px] text-blue-600 font-bold hover:underline">Ver detalles →</a>
                    </div>
                    {{-- Fila 2 --}}
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex justify-between items-start mb-1">
                            <p class="text-xs font-bold text-gray-800">Cien Años de Soledad</p>
                            <span class="text-[9px] bg-orange-100 text-orange-600 px-2 py-0.5 rounded-full font-black">PERDIDO</span>
                        </div>
                        <a href="#" class="text-[10px] text-blue-600 font-bold hover:underline">Ver detalles →</a>
                    </div>
                </div>
            </div>

            {{-- Acciones Rápidas (Iconos) --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="font-black text-gray-800 text-[11px] uppercase mb-4 tracking-widest italic border-b border-gray-50 pb-2">Herramientas</h3>
                <div class="grid grid-cols-1 gap-3">
                    <a href="{{ route('categorias.create') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-purple-50 transition border border-transparent hover:border-purple-100 group">
                        <div class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center group-hover:bg-purple-600 group-hover:text-white transition-all">
                            <i class="fa-solid fa-tags text-xs"></i>
                        </div>
                        <span class="text-[11px] font-bold text-gray-600 uppercase">Nueva Categoría</span>
                    </a>
                    
                    <a href="#" class="flex items-center gap-3 p-3 rounded-xl hover:bg-emerald-50 transition border border-transparent hover:border-emerald-100 group">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            <i class="fa-solid fa-file-invoice text-xs"></i>
                        </div>
                        <span class="text-[11px] font-bold text-gray-600 uppercase">Generar Reporte</span>
                    </a>
                </div>
            </div>

            {{-- Widget de Usuario Administrador Corregido --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-1 italic">Sesión Activa</p>
                    <p class="text-lg font-black italic text-slate-800">{{ Auth::user()->name }}</p>
                    
                    <div class="mt-4 pt-4 border-t border-gray-50 flex justify-between items-center">
                        <span class="text-[10px] font-bold text-slate-500 uppercase">Rol: Super Administrador</span>
                        <div class="w-6 h-6 rounded-full bg-blue-50 flex items-center justify-center">
                            <i class="fa-solid fa-shield-halved text-[10px] text-blue-600"></i>
                        </div>
                    </div>
                </div>
                {{-- Icono decorativo en el fondo con opacidad baja --}}
                <i class="fa-solid fa-user-tie absolute -right-2 -bottom-2 text-6xl text-gray-50 rotate-12"></i>
            </div>

        </div>
    </div>
</div>
@endsection