<footer class="w-full max-w-6xl mx-auto mt-12 pb-10 border-t border-gray-200 pt-8">
    <div class="flex flex-col md:row justify-between items-center px-4">
        <div class="text-sm text-gray-500">
            &copy; 2026 <span class="font-bold text-blue-600">BiblioTech Admin</span>. 
            Panel de Gestión Municipal.
        </div>
        <div class="flex gap-8 text-xs font-medium text-gray-500 mt-4 md:mt-0">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
            <a href="{{ route('usuarios.index') }}" class="hover:text-blue-600">Usuarios</a>
            <a href="{{ route('categorias') }}" class="hover:text-blue-600">Categorias</a>
            <a href="{{ route('libros') }}" class="hover:text-blue-600">Libros</a>
            <a href="{{ route('prestamos.index') }}" class="hover:text-blue-600">Préstamos</a>
        </div>
    </div>
</footer>