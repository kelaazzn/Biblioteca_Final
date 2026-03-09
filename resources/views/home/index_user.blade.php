@extends('layout.user')

@section('title', 'Inicio - Usuario')

@section('content')
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Bienvenido {{ auth()->user()->name }}</h2>
        <p class="text-gray-600">Desde aquí podrás consultar tus préstamos y ver el catálogo disponible.</p>
        
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 bg-blue-50 rounded-xl border border-blue-100">
                <i class="fa-solid fa-book-reader text-blue-500 text-3xl mb-4"></i>
                <h3 class="font-bold text-blue-900">Mis Préstamos</h3>
                <p class="text-sm text-blue-700">Revisa la fecha de entrega de tus libros.</p>
            </div>
            
            <div class="p-6 bg-green-50 rounded-xl border border-green-100">
                <i class="fa-solid fa-search text-green-500 text-3xl mb-4"></i>
                <h3 class="font-bold text-green-900">Catálogo</h3>
                <p class="text-sm text-green-700">Explora los libros que tenemos para ti.</p>
            </div>
        </div>
    </div>
@endsection