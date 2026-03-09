@extends('layout.admin')

@section('content')
<div class="p-8">
    <nav class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-gray-400 mb-4">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Inicio</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-blue-600 font-bold">Usuarios</span>
    </nav>

    @if(session()->has('success'))
        <div class="bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 relative" role="alert">
            <strong class="font-bold">✓ {{ session('success') }}</strong>
        </div>
    @endif

    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900 mb-1">Gestión de Usuarios</h1>
        <p class="text-gray-500 text-sm">Administra los permisos y accesos de los usuarios al sistema.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Listado de Usuarios</h2>
            <a href="{{ route('usuarios.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold flex items-center gap-2 hover:bg-blue-700 transition">
                <i class="fa-solid fa-user-plus"></i> Nuevo Usuario
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Nombre Completo</th>
                        <th class="px-6 py-4">Correo Electrónico</th>
                        <th class="px-6 py-4">Tipo de Usuario</th>
                        <th class="px-6 py-4">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                    @foreach($usuarios as $usuario)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-bold text-gray-400">#{{ $usuario->id }}</td>
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $usuario->name }}</td>
                        <td class="px-6 py-4">{{ $usuario->email }}</td>
                        <td class="px-6 py-4">
                            @if($usuario->user_type == 'admin')
                                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                    <i class="fa-solid fa-user-shield mr-1"></i> Admin
                                </span>
                            @else
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                    <i class="fa-solid fa-user mr-1"></i> Usuario
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 flex gap-3">
                            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="text-blue-600 hover:text-blue-800 transition font-bold">
                                <i class="fa-solid fa-pen-to-square"></i> Editar
                            </a>

                            <a href="{{ route('usuarios.delete_confirm', $usuario->id) }}" class="text-red-500 hover:text-red-700 transition font-bold">
                                <i class="fa-solid fa-trash-can"></i> Eliminar
                            </a>
                            <!--
                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('¿Estás seguro de eliminar a este usuario?')"
                                        class="text-red-500 hover:text-red-700 transition">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                            -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>                
            </table>
        </div>

        <div class="p-6 border-t border-gray-100 flex justify-between items-center bg-gray-50">
            <p class="text-sm text-gray-500">
                Mostrando <span class="font-semibold text-gray-700">{{ $usuarios->firstItem() }}</span> a 
                <span class="font-semibold text-gray-700">{{ $usuarios->lastItem() }}</span> de 
                <span class="font-semibold text-gray-700">{{ $usuarios->total() }}</span> usuarios
            </p>
            
            <div class="flex gap-2">
                {{ $usuarios->links() }}
            </div>
        </div>
    </div> 
</div> 
@endsection