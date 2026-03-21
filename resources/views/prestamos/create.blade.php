@extends('layout.admin')

@section('title', 'Nuevo Préstamo')

@section('content')
<div class="p-8 max-w-2xl">
    <nav class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-gray-400 mb-4">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Inicio</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <a href="{{ route('prestamos.index') }}" class="hover:text-blue-600 transition">Préstamos</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-blue-600 font-bold">Registrar Préstamo</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50">
            <h2 class="text-xl font-black text-gray-800">Registrar Nuevo Préstamo</h2>
            <p class="text-xs text-gray-400 mt-1">Busque al usuario por ID o Nombre para validar sus datos antes del préstamo.</p>
        </div>

        {{-- Formulario de Búsqueda --}}
        <form action="{{ route('prestamos.buscar_usuario') }}" method="POST" class="p-6 space-y-4">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Campo ID Usuario --}}
                <div>
                    <label for="usuario_id" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">ID Usuario</label>
                    <input type="text" name="usuario_id" id="usuario_id" 
                        placeholder="Ej. 1"
                        value=""
                        class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                </div>

                <div>
                    <label for="usuario_nombre" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Nombre Usuario</label>
                    <input type="text" name="usuario_nombre" id="usuario_nombre" 
                        placeholder="Buscar por nombre..."
                        value=""
                        class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                </div>
            </div>

            <div class="flex items-center justify-between pt-2">
                <div class="flex gap-3">
                    <button type="submit" class="bg-blue-600 text-white px-8 py-2.5 rounded-xl font-bold hover:bg-blue-700 transition-all text-sm shadow-md shadow-blue-100">
                        <i class="fa-solid fa-magnifying-glass mr-2"></i> Buscar Usuario
                    </button>
                    <a href="{{ route('prestamos.index') }}" class="bg-gray-100 text-gray-500 px-8 py-2.5 rounded-xl font-bold hover:bg-gray-200 transition-all text-sm">
                        Cancelar
                    </a>
                </div>
            </div>
        </form>

        {{-- Muestra información solo si el controlador encontró al usuario --}}
        @isset($usuario)
        <div class="mx-6 mb-6 p-5 bg-blue-50/50 rounded-2xl border border-blue-100 animate-fade-in">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-xs">
                    <i class="fa-solid fa-user-check"></i>
                </div>
                <h3 class="text-[10px] font-black text-blue-600 uppercase tracking-widest">Usuario Encontrado</h3>
            </div>
            
            <div class="grid grid-cols-2 gap-y-2">
                <p class="text-xs text-gray-500 font-bold uppercase">ID:</p>
                <p class="text-sm text-gray-800 font-medium">{{ $usuario->id }}</p>
                
                <p class="text-xs text-gray-500 font-bold uppercase">Nombre Completo:</p>
                <p class="text-sm text-gray-800 font-medium">{{ $usuario->name }}</p>
                
                <p class="text-xs text-gray-500 font-bold uppercase">Correo Electrónico:</p>
                <p class="text-sm text-gray-800 font-medium">{{ $usuario->email }}</p>
            </div>
        </div>

        {{-- Formulario para pasar al siguiente paso --}}
        <form action="{{ route('prestamos.select_libro') }}" method="POST">
            @csrf
            {{-- Enviamos el ID del usuario de forma oculta --}}
            <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">
            
            <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-xl font-bold hover:bg-green-700 transition-all text-sm shadow-lg shadow-green-100 flex items-center justify-center gap-2">
                <i class="fa-solid fa-book"></i>
                Seleccionar Libro
            </button>
        </form>

        @endisset
    </div>
</div>
@endsection