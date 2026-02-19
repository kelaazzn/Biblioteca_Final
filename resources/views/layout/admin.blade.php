<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Biblioteca')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style type="text/tailwindcss">
        @layer components {
            .form-container { @apply bg-white rounded-xl shadow-lg p-8 max-w-md w-full mx-auto border border-gray-100; }
            .form-title { @apply text-2xl font-bold text-gray-800 mb-2 text-center; }
            .form-subtitle { @apply text-sm text-gray-500 mb-6 text-center; }
            .input-group { @apply mb-4 relative; }
            .input-label { @apply block text-sm font-medium text-gray-700 mb-1; }
            .input-field { @apply w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition; }
            .input-icon { @apply absolute left-3 top-[34px] text-gray-400; }
            .btn-primary { @apply w-full bg-blue-600 text-white py-2.5 rounded-full font-bold hover:bg-blue-700 transition flex items-center justify-center gap-2 mt-4; }
            .btn-social { @apply flex-1 flex items-center justify-center gap-2 border border-gray-300 py-2 rounded-lg hover:bg-gray-50 transition text-sm font-medium; }
        }
    
        /* El sidebar empieza pequeño */
        #sidebar {
            width: 5rem; /* w-20 */
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Al pasar el mouse, se expande */
        #sidebar:hover {
            width: 16rem; /* w-64 */
        }

        /* Los textos están invisibles por defecto */
        .menu-text {
            opacity: 0;
            display: none;
            transition: opacity 0.2s ease;
        }

        /* Cuando el sidebar se expande, mostramos el texto */
        #sidebar:hover .menu-text {
            display: block;
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex">

    <aside id="sidebar" class="bg-[#111827] text-gray-400 flex-shrink-0 flex flex-col min-h-screen z-50 overflow-hidden shadow-2xl">
        
        <div class="p-6 flex items-center gap-4">
            <i class="fa-solid fa-book-bookmark text-blue-500 text-3xl min-w-[32px] text-center"></i>
            <div class="menu-text">
                <h1 class="text-white text-xl font-black italic tracking-tighter">BiblioTech</h1>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Administración</p>
            </div>
        </div>

        <nav class="flex-grow px-4 space-y-3 mt-4">
            <a href="{{ route('home') }}" class="flex items-center gap-4 px-3 py-3 rounded-xl hover:bg-gray-800 hover:text-white transition-all group">
                <i class="fa-solid fa-house text-xl min-w-[32px] text-center group-hover:scale-110 transition"></i>
                <span class="menu-text font-bold whitespace-nowrap">Inicio</span>
            </a>

            <a href="#" class="flex items-center gap-4 px-3 py-3 rounded-xl hover:bg-gray-800 hover:text-white transition-all group">
                <i class="fa-solid fa-users text-xl min-w-[32px] text-center group-hover:scale-110 transition"></i>
                <span class="menu-text font-bold whitespace-nowrap">Usuarios</span>
            </a>

            <a href="{{ route('categorias') }}" class="flex items-center gap-4 px-3 py-3 rounded-xl transition-all group {{ request()->routeIs('categorias') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/40' : 'hover:bg-gray-800 hover:text-white text-gray-400' }}">
                <i class="fa-solid fa-tags text-xl min-w-[32px] text-center group-hover:scale-110 transition"></i>
                <span class="menu-text font-bold whitespace-nowrap">Categorías</span>
            </a>

            <a href="#" class="flex items-center gap-4 px-3 py-3 rounded-xl transition-all group {{ request()->routeIs('libros.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/40' : 'hover:bg-gray-800 hover:text-white text-gray-400' }}">
                <i class="fa-solid fa-book text-xl min-w-[32px] text-center group-hover:scale-110 transition"></i>
                <span class="menu-text font-bold whitespace-nowrap">Libros</span>
            </a>

            <a href="#" class="flex items-center gap-4 px-3 py-3 rounded-xl hover:bg-gray-800 hover:text-white transition-all group">
                <i class="fa-solid fa-exchange-alt text-xl min-w-[32px] text-center group-hover:scale-110 transition"></i>
                <span class="menu-text font-bold whitespace-nowrap">Préstamos</span>
            </a>

            <div class="border-t border-gray-800/50 my-6 mx-2"></div>

            <a href="{{ route('logout') }}" class="flex items-center gap-4 px-3 py-3 rounded-xl text-red-400 hover:bg-red-900/30 transition-all group">
                <i class="fa-solid fa-right-from-bracket text-xl min-w-[32px] text-center group-hover:-translate-x-1 transition"></i>
                <span class="menu-text font-bold whitespace-nowrap">Salir</span>
            </a>
        </nav>
    </aside>

    <div class="flex-grow flex flex-col min-w-0">
        <header class="bg-white h-16 flex justify-between items-center px-8 border-b border-gray-100 shadow-sm">
            <div class="flex items-center gap-3">
                <span class="text-xl font-black text-blue-600 tracking-tight">BiblioTech <span class="text-gray-800 font-light">Admin</span></span>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="hidden md:flex items-center bg-gray-100 px-3 py-1.5 rounded-full border border-gray-200">
                    <i class="fa-solid fa-magnifying-glass text-gray-400 text-xs"></i>
                    <input type="text" placeholder="Buscar..." class="bg-transparent border-none text-xs focus:outline-none ml-2 w-32">
                </div>

                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-gray-800">Administrador</p>
                        <p class="text-[10px] text-gray-400">En línea</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 shadow-sm border border-gray-200 overflow-hidden">
                        <i class="fa-solid fa-user text-lg"></i>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-grow overflow-y-auto">
            @yield('content')
        </main>

        @include('partials.admin.footer')
    </div>

</body>
</html>