<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Biblioteca Municipal')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Estilo suave para el scroll */
                html { scroll-behavior: smooth; }
            </style>
        @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style type="text/tailwindcss">
        /* Importante incluir el @layer para que reconozca tus clases del maestro */
        @layer components {
            .form-container {
                @apply bg-white rounded-xl shadow-lg p-8 max-w-md w-full mx-auto border border-gray-100;
            }
            .form-title {
                @apply text-2xl font-bold text-gray-800 mb-2 text-center;
            }
            .form-subtitle {
                @apply text-sm text-gray-500 mb-6 text-center;
            }
            .input-group {
                @apply mb-4 relative;
            }
            .input-label {
                @apply block text-sm font-medium text-gray-700 mb-1;
            }
            .input-field {
                @apply w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition;
            }
            .input-icon {
                @apply absolute left-3 top-[34px] text-gray-400;
            }
            .btn-primary {
                @apply w-full bg-blue-600 text-white py-2.5 rounded-full font-bold hover:bg-blue-700 transition flex items-center justify-center gap-2 mt-4;
            }
            .btn-social {
                @apply flex-1 flex items-center justify-center gap-2 border border-gray-300 py-2 rounded-lg hover:bg-gray-50 transition text-sm font-medium;
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center p-4">

    @yield('content')

    @include('partials.auth.footer')

</body>
</html>