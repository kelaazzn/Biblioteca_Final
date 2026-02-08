<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ 'Biblioteca' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Estilo suave para el scroll */
                html { scroll-behavior: smooth; }
            </style>
        @endif
    </head>
    <body class="bg-gray-50 text-gray-800 font-sans">

        <header class="bg-white shadow-md fixed w-full z-50">
            <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <span class="text-2xl font-bold text-blue-600">Biblio<span class="text-gray-700">Tech</span></span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="hover:text-blue-600 transition duration-300 font-medium">Inicio</a>
                    <a href="#" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition duration-300 shadow-lg">Login</a>
                </div>

                <div class="md:hidden">
                    <button id="menu-btn" class="text-gray-700 focus:outline-none">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </nav>

            <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 px-6 py-4 space-y-4 shadow-xl">
                <a href="#" class="block text-gray-700 hover:text-blue-600 font-medium">Inicio</a>
                <a href="#" class="block w-full text-center bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">Login</a>
            </div>
        </header>

        <section class="relative h-screen flex items-center justify-center pt-16 overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=1920&q=80" 
                     alt="Fondo de Biblioteca" 
                     class="w-full h-full object-cover brightness-50">
            </div>

            <div class="relative z-10 text-center px-4 max-w-4xl">
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight">
                    Descubre un universo de <span class="text-blue-400">historias</span> y conocimiento
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-10 max-w-2xl mx-auto">
                    Accede a miles de libros, artículos y recursos digitales desde cualquier lugar. La lectura nunca fue tan accesible.
                </p>
                <div class="flex flex-col md:flex-row justify-center gap-4">
                    <button class="bg-blue-600 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-blue-700 transition transform hover:scale-105 shadow-xl">
                        Explorar Catálogo
                    </button>
                    <button class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-white hover:text-blue-900 transition transform hover:scale-105">
                        Saber Más
                    </button>
                </div>
            </div>
        </section>

        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="grid md:grid-cols-3 gap-12">
                    <div class="text-center p-6 bg-gray-50 rounded-2xl">
                        <img src="https://images.unsplash.com/photo-1481627569372-528a9a287bb7?auto=format&fit=crop&w=400&q=80" alt="Libros" class="w-full h-48 object-cover rounded-xl mb-4">
                        <h3 class="text-xl font-bold mb-2">Colección Vasta</h3>
                        <p class="text-gray-600">Desde clásicos literarios hasta las últimas tendencias tecnológicas.</p>
                    </div>
                    <div class="text-center p-6 bg-gray-50 rounded-2xl">
                        <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=400&q=80" alt="Lectura" class="w-full h-48 object-cover rounded-xl mb-4">
                        <h3 class="text-xl font-bold mb-2">Acceso 24/7</h3>
                        <p class="text-gray-600">Lee en línea o descarga para disfrutar offline en cualquier momento.</p>
                    </div>
                    <div class="text-center p-6 bg-gray-50 rounded-2xl">
                        <img src="https://images.unsplash.com/photo-1532012197367-2d5978460f1f?auto=format&fit=crop&w=400&q=80" alt="Comunidad" class="w-full h-48 object-cover rounded-xl mb-4">
                        <h3 class="text-xl font-bold mb-2">Comunidad Viva</h3>
                        <p class="text-gray-600">Únete a clubes de lectura y foros de discusión especializados.</p>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-gray-900 text-white py-12">
            <div class="container mx-auto px-6">
                <div class="grid md:grid-cols-3 gap-8 mb-8 border-b border-gray-800 pb-8">
                    <div>
                        <h4 class="text-2xl font-bold text-blue-500 mb-4">BiblioTech</h4>
                        <p class="text-gray-400">Expandiendo las fronteras del conocimiento a través de la tecnología y la pasión por la lectura.</p>
                    </div>
                    <div>
                        <h5 class="text-lg font-semibold mb-4">Enlaces Rápidos</h5>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-blue-400 transition">Sobre Nosotros</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">Préstamos Digitales</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">Contacto</a></li>
                        </ul>
                    </div>
                <div>
                        <h5 class="text-lg font-semibold mb-4">Síguenos</h5>
                        <div class="flex space-x-4">
                            <a href="#" class="p-2 bg-gray-800 rounded-full hover:bg-blue-600 transition">FB</a>
                            <a href="#" class="p-2 bg-gray-800 rounded-full hover:bg-blue-400 transition">TW</a>
                            <a href="#" class="p-2 bg-gray-800 rounded-full hover:bg-pink-600 transition">IG</a>
                        </div>
                    </div>
                </div>
                <p class="text-center text-gray-500 text-sm">
                    &copy; 2024 BiblioTech. Todas las imágenes son de Unsplash (Libres de derechos).
                </p>
            </div>
        </footer>

        <script>
            const btn = document.getElementById('menu-btn');
            const menu = document.getElementById('mobile-menu');

            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });

            // Cerrar menú al hacer clic en un enlace (opcional)
            const links = menu.querySelectorAll('a');
            links.forEach(link => {
                link.addEventListener('click', () => {
                    menu.classList.add('hidden');
                });
            });
        </script>
    </body>
</html>
