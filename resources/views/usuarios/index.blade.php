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

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xl">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Usuarios</p>
                <p class="text-xl font-black text-gray-900">{{ $usuarios->total() }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center text-xl">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-wider">Administradores</p>
                <p class="text-xl font-black text-gray-900 uppercase">
                    {{ $usuarios->where('user_type', 'admin')->count() }}
                </p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center text-xl">
                <i class="fa-solid fa-user"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-wider">Usuarios Finales</p>
                <p class="text-xl font-black text-gray-900 uppercase">
                    {{ $usuarios->where('user_type', 'user')->count() }}
                </p>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap gap-2 mb-5">
        <button class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-xs font-bold shadow-sm">Todos los registros</button>
        <button class="bg-white border border-gray-200 text-gray-500 px-4 py-1.5 rounded-full text-xs font-bold hover:bg-gray-50 transition">Solo Administradores</button>
        <button class="bg-white border border-gray-200 text-gray-500 px-4 py-1.5 rounded-full text-xs font-bold hover:bg-gray-50 transition">Usuarios Estándar</button>
        <button class="bg-white border border-gray-200 text-gray-400 px-4 py-1.5 rounded-full text-xs font-bold cursor-not-allowed ml-auto flex items-center gap-2">
            <i class="fa-solid fa-file-export"></i> Exportar
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="text-xl font-bold text-gray-800">Listado de Usuarios</h2>

            <div class="flex items-center gap-3 w-full md:w-auto">
                <div class="relative w-full md:w-64">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input type="text" 
                           placeholder="Buscar por nombre o correo..." 
                           class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                </div>

                <a href="{{ route('usuarios.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold flex items-center gap-2 hover:bg-blue-700 transition">
                    <i class="fa-solid fa-user-plus"></i> Nuevo Usuario
                </a>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 text-gray-400 text-[10px] uppercase font-black tracking-widest">
                    <tr>
                        <th class="px-6 py-4 w-20">ID</th>
                        <th class="px-6 py-4">Nombre Completo</th>
                        <th class="px-6 py-4">Correo Electrónico</th>
                        <th class="px-6 py-4">Tipo de Usuario</th>
                        <th class="px-6 py-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                    @foreach($usuarios as $usuario)
                    <tr class="hover:bg-gray-50 transition">
                        <tr class="hover:bg-blue-50/30 transition"> 
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

                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('usuarios.edit', $usuario->id) }}" 
                                class="p-2 hover:bg-white rounded-lg text-blue-600 shadow-sm transition border border-transparent hover:border-gray-100"
                                title="Editar Usuario">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <a href="{{ route('usuarios.delete_confirm', $usuario->id) }}" 
                                class="p-2 hover:bg-white rounded-lg text-red-500 shadow-sm transition border border-transparent hover:border-gray-100"
                                title="Eliminar Usuario">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
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

    <div class="mt-6 flex justify-between items-center text-[10px] text-gray-400 uppercase tracking-widest font-bold">
        <div class="flex items-center gap-2">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            Sistema en línea
        </div>
        <div>
            Última actualización: {{ now()->format('d/m/Y H:i A') }}
        </div>
    </div>
</div> 
@endsection