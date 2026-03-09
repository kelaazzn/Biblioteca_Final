@extends('layout.admin')

@section('title', 'Nuevo Usuario')

@section('content')
<div class="p-8 max-w-2xl">
    <nav class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-gray-400 mb-4">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Inicio</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <a href="{{ route('usuarios.index') }}" class="hover:text-blue-600 transition">Usuarios</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-blue-600 font-bold">Nuevo Usuario</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50">
            <h2 class="text-xl font-black text-gray-800">Registrar Nuevo Usuario</h2>
            <p class="text-xs text-gray-400 mt-1">Crea una nueva cuenta para acceder al sistema de la biblioteca.</p>
        </div>

        <form action="{{ route('usuarios.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-700 text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Nombre Completo</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Ej. Juan Pérez" 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
            </div>

            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="ejemplo@correo.com" 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
            </div>

            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Contraseña</label>
                <input type="password" name="password" required placeholder="Mínimo 8 caracteres" 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
            </div>

            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" required placeholder="Repite la contraseña" 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
            </div>

            <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">Tipo de Usuario (Rol)</label>
                <select name="user_type" required 
                    class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all appearance-none">
                    <option value="">Selecciona un nivel de acceso</option>
                    <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="user" {{ old('user_type') == 'user' ? 'selected' : '' }}>Usuario</option>
                </select>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition-all text-sm">
                    Guardar Usuario
                </button>
                <a href="{{ route('usuarios.index') }}" class="bg-gray-100 text-gray-600 px-6 py-3 rounded-xl font-bold hover:bg-gray-200 transition-all text-sm">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection