@extends('layout.admin')

@section('title', 'Eliminar Usuario')

@section('content')
<div class="p-8 max-w-2xl">
    <nav class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-gray-400 mb-4">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Inicio</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <a href="{{ route('usuarios.index') }}" class="hover:text-blue-600 transition">Usuarios</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-red-600 font-bold">Eliminar Usuario</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden">
        <div class="p-8 text-center">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fa-solid fa-triangle-exclamation text-4xl"></i>
            </div>

            <h2 class="text-2xl font-black text-gray-800">¿Confirmar eliminación?</h2>
            <p class="text-gray-500 mt-2">
                Estás a punto de eliminar permanentemente al usuario: <br>
                <span class="font-bold text-gray-800 text-lg">{{ $usuario->name }}</span>
            </p>
            <p class="text-xs text-red-400 mt-4 bg-red-50 inline-block px-4 py-2 rounded-lg border border-red-100">
                <i class="fa-solid fa-circle-info"></i> Esta acción no se puede deshacer.
            </p>
        </div>

        <div class="bg-gray-50 p-6 flex justify-center gap-4">
            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-red-700 transition-all text-sm flex items-center gap-2 shadow-lg shadow-red-200">
                    <i class="fa-solid fa-trash"></i> Sí, eliminar usuario
                </button>
            </form>

            <a href="{{ route('usuarios.index') }}" class="bg-white text-gray-600 border border-gray-200 px-8 py-3 rounded-xl font-bold hover:bg-gray-100 transition-all text-sm flex items-center gap-2">
                Cancelar
            </a>
        </div>
    </div>
</div>
@endsection