<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Biblioteca - Usuario')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style type="text/tailwindcss">
        @layer components {
            #sidebar { width: 5rem; transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
            #sidebar:hover { width: 16rem; }
            .menu-text { opacity: 0; display: none; transition: opacity 0.2s ease; }
            #sidebar:hover .menu-text { display: block; opacity: 1; }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex">

    <aside id="sidebar" class="bg-[#111827] text-gray-400 flex-shrink-0 flex flex-col min-h-screen z-50 overflow-hidden shadow-2xl">
        <div class="p-6 flex items-center gap-4">
            <i class="fa-solid fa-book-bookmark text-blue-500 text-3xl min-w-[32px] text-center"></i>
            <div class="menu-text">
                <h1 class="text-white text-xl font-black italic tracking-tighter">BiblioTech</h1>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Portal Usuario</p>
            </div>
        </div>

        <nav class="flex-grow px-4 space-y-3 mt-4">
            <a href="{{ route('home') }}" class="flex items-center gap-4 px-3 py-3 rounded-xl hover:bg-gray-800 hover:text-white transition-all group">
                <i class="fa-solid fa-house text-xl min-w-[32px] text-center group-hover:scale-110 transition"></i>
                <span class="menu-text font-bold whitespace-nowrap">Inicio</span>
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
                <span class="text-xl font-black text-blue-600 tracking-tight">BiblioTech <span class="text-gray-800 font-light">Usuario</span></span>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-gray-800">Bienvenido Usuario</p>
                        <p class="text-[10px] text-gray-400">En línea</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 shadow-sm border border-gray-200">
                        <i class="fa-solid fa-user text-lg"></i>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-grow p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>