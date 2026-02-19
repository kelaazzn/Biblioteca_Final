@extends('layout.admin')

@section('content')
<div class="p-8">
    <nav class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-gray-400 mb-4">
        <a href="#" class="hover:text-blue-600 transition">Inicio</a>
        <i class="fa-solid fa-chevron-right text-[8px]"></i>
        <span class="text-blue-600 font-bold">Libros</span>
    </nav>

    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900 mb-1">Gestión de Libros</h1>
        <p class="text-gray-500 text-sm">Administra el catálogo completo y el estado de los ejemplares.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative overflow-hidden">
            <p class="text-gray-500 text-sm font-medium">Total de libros</p>
            <p class="text-2xl font-bold text-gray-800">1,247</p>
            <p class="text-green-500 text-xs mt-2 flex items-center gap-1">
                <i class="fa-solid fa-arrow-up"></i> 5.2% desde el mes pasado
            </p>
            <i class="fa-solid fa-book absolute right-4 top-1/2 -translate-y-1/2 text-blue-100 text-4xl"></i>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative overflow-hidden">
            <p class="text-gray-500 text-sm font-medium">Libros prestados</p>
            <p class="text-2xl font-bold text-gray-800">189</p>
            <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                <i class="fa-solid fa-arrow-down"></i> 2.1% desde el mes pasado
            </p>
            <i class="fa-solid fa-exchange-alt absolute right-4 top-1/2 -translate-y-1/2 text-yellow-100 text-4xl"></i>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative overflow-hidden">
            <p class="text-gray-500 text-sm font-medium">Usuarios activos</p>
            <p class="text-2xl font-bold text-gray-800">543</p>
            <p class="text-green-500 text-xs mt-2 flex items-center gap-1">
                <i class="fa-solid fa-arrow-up"></i> 12.7% desde el mes pasado
            </p>
            <i class="fa-solid fa-users absolute right-4 top-1/2 -translate-y-1/2 text-green-100 text-4xl"></i>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative overflow-hidden">
            <p class="text-gray-500 text-sm font-medium">Devoluciones pendientes</p>
            <p class="text-2xl font-bold text-gray-800">24</p>
            <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                <i class="fa-solid fa-arrow-up"></i> 3.4% desde ayer
            </p>
            <i class="fa-solid fa-clock absolute right-4 top-1/2 -translate-y-1/2 text-red-100 text-4xl"></i>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Lista de Libros</h2>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold flex items-center gap-2 hover:bg-blue-700 transition">
                <i class="fa-solid fa-plus"></i> Agregar libro
            </button>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">Título</th>
                        <th class="px-6 py-4">Autor</th>
                        <th class="px-6 py-4">ISBN</th>
                        <th class="px-6 py-4">Categoría</th>
                        <th class="px-6 py-4">Disponibilidad</th>
                        <th class="px-6 py-4">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-800">Cien años de soledad</td>
                        <td class="px-6 py-4">Gabriel García Márquez</td>
                        <td class="px-6 py-4">978-0307474728</td>
                        <td class="px-6 py-4"><span class="bg-blue-100 text-blue-600 px-2 py-1 rounded text-xs">Literatura</span></td>
                        <td class="px-6 py-4"><span class="text-green-500 font-bold">Disponible</span></td>
                        <td class="px-6 py-4 flex gap-3 text-blue-600 font-bold">
                            <a href="#" class="hover:underline">Editar</a>
                            <a href="#" class="text-red-500 hover:underline">Eliminar</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-800">1984</td>
                        <td class="px-6 py-4">George Orwell</td>
                        <td class="px-6 py-4">978-0451524935</td>
                        <td class="px-6 py-4"><span class="bg-purple-100 text-purple-600 px-2 py-1 rounded text-xs">Ciencia Ficción</span></td>
                        <td class="px-6 py-4"><span class="text-red-500 font-bold">Prestado</span></td>
                        <td class="px-6 py-4 flex gap-3 text-blue-600 font-bold">
                            <a href="#" class="hover:underline">Editar</a>
                            <a href="#" class="text-red-500 hover:underline">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection