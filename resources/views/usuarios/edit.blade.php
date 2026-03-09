@extends('layout.admin')

@section('title', 'Editar Usuario')

@section('content')
<div class="p-8 max-w-2xl">
    <nav class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-gray-400 mb-4">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Inicio</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <a href="{{ route('usuarios.index') }}" class="hover:text-blue-600 transition">Usuarios</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-blue-600 font-bold">Editar Usuario</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-black text-gray-800">Editar Usuario</h2>
                <p class="text-xs text-gray-400 mt-1">Modificando perfil de: <b>{{ $usuario->name }}</b></p>
            </div>
            <a href="{{ route('usuarios.index') }}" class="bg-gray-100 text-gray-600 px-4 py-2 rounded-xl font-bold flex items-center gap-2 hover:bg-gray-200 transition-all text-xs">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>
        </div>

        {{-- La ruta apunta a update con el ID del usuario --}}
        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-700 text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Nombre Completo --}}
            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Nombre Completo</label>
                <input type="text" name="name" value="{{ old('name', $usuario->name) }}" required 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
            </div>

            {{-- Correo Electrónico --}}
            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
            </div>

            {{-- Tipo de Usuario --}}
            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Tipo de Usuario (Rol)</label>
                <select name="user_type" required 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all appearance-none">
                    <option value="admin" {{ (old('user_type', $usuario->user_type) == 'admin') ? 'selected' : '' }}>Administrador</option>
                    <option value="user" {{ (old('user_type', $usuario->user_type) == 'user') ? 'selected' : '' }}>Usuario</option>
                </select>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 transition-all text-sm flex items-center gap-2">
                    <i class="fa-solid fa-save"></i> Actualizar Usuario
                </button>
                <a href="{{ route('usuarios.index') }}" class="bg-gray-100 text-gray-600 px-6 py-3 rounded-xl font-bold hover:bg-gray-200 transition-all text-sm">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection