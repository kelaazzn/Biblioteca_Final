@extends('layout.user')

@section('title', 'Inicio - Usuario')

@section('content')
<div class="p-8">
    {{-- Encabezado de Bienvenida --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900 mb-1">¡Bienvenido, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-500 text-sm">Desde aquí puedes gestionar tus libros y consultar el acervo bibliográfico disponible.</p>
    </div>

    {{-- Tarjetas de Resumen Estáticas (Solo Diseño) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Tarjeta: Mis Préstamos --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 hover:border-blue-200 transition-colors">
            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600">
                <i class="fa-solid fa-book-bookmark text-xl"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Estado</p>
                <p class="text-sm font-bold text-gray-900 leading-none">Mis Préstamos</p>
            </div>
        </div>

        {{-- Tarjeta: Calendario --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 hover:border-amber-200 transition-colors">
            <div class="w-12 h-12 bg-amber-50 rounded-lg flex items-center justify-center text-amber-600">
                <i class="fa-solid fa-calendar-day text-xl"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Próximas</p>
                <p class="text-sm font-bold text-gray-900 leading-none">Fechas de Entrega</p>
            </div>
        </div>

        {{-- Tarjeta: Catálogo --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 hover:border-green-200 transition-colors">
            <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center text-green-600">
                <i class="fa-solid fa-magnifying-glass text-xl"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Explorar</p>
                <p class="text-sm font-bold text-gray-900 leading-none">Catálogo Completo</p>
            </div>
        </div>
    </div>

    {{-- Secciones de Acceso (Botones que no dan error) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="#" class="group p-8 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <div class="w-14 h-14 bg-blue-600 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-100">
                        <i class="fa-solid fa-list-check text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-gray-800">Ver mis Préstamos</h3>
                    <p class="text-gray-500 text-sm mt-1">Revisa el historial y los libros que tienes actualmente.</p>
                </div>
                <i class="fa-solid fa-chevron-right text-gray-300 group-hover:text-blue-600 group-hover:translate-x-2 transition-all"></i>
            </div>
        </a>

        <a href="#" class="group p-8 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <div class="w-14 h-14 bg-green-600 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-green-100">
                        <i class="fa-solid fa-search text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-gray-800">Consultar Catálogo</h3>
                    <p class="text-gray-500 text-sm mt-1">Busca títulos disponibles para tu siguiente solicitud.</p>
                </div>
                <i class="fa-solid fa-chevron-right text-gray-300 group-hover:text-green-600 group-hover:translate-x-2 transition-all"></i>
            </div>
        </a>
    </div>
</div>
@endsection