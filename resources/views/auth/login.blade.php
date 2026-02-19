@extends('layout.auth')

@section('content')
    <div class="text-center mb-8">
        <h1 class="text-4xl font-black text-gray-900 mb-2">Biblioteca Municipal</h1>
        <p class="text-gray-500">Accede a tu cuenta o regístrate para disfrutar de todos nuestros servicios</p>
    </div>

    <div class="flex flex-col md:flex-row gap-8 w-full max-w-6xl items-start">
        
        <div class="form-container">
            <h2 class="form-title text-left">Iniciar Sesión</h2>
            <p class="form-subtitle text-left">Accede a tu cuenta de la biblioteca</p>

            <form id="loginForm" action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label class="input-label">Correo electrónico</label>
                    <i class="fa-solid fa-envelope input-icon"></i>
                    <input type="email" name='email' class="input-field" placeholder="usuario@ejemplo.com">
                </div>

                <div class="input-group">
                    <div class="flex justify-between items-center mb-1">
                        <label class="text-sm font-medium text-gray-700">Contraseña</label>
                        <a href="#" class="text-xs text-blue-600 hover:underline">¿Olvidaste tu contraseña?</a>
                    </div>
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input type="password" name='password' class="input-field" placeholder="Introduce tu contraseña">
                </div>

                <div class="flex items-center gap-2 mb-6">
                    <input type="checkbox" id="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="remember" class="text-sm text-gray-600">Recordar sesión</label>
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fa-solid fa-sign-in-alt"></i> Iniciar Sesión
                </button>
            </form>

            <div class="relative flex py-5 items-center">
                <div class="flex-grow border-t border-gray-200"></div>
                <span class="flex-shrink mx-4 text-gray-400 text-xs font-bold uppercase">o</span>
                <div class="flex-grow border-t border-gray-200"></div>
            </div>

            <div class="flex gap-4">
                <button class="btn-social text-red-600"><i class="fa-brands fa-google"></i> Google</button>
                <button class="btn-social text-blue-800"><i class="fa-brands fa-facebook"></i> Facebook</button>
            </div>

            <p class="mt-6 text-center text-sm text-gray-600">
                ¿No tienes una cuenta? <a href="#" class="text-blue-600 font-bold hover:underline">Regístrate aquí</a>
            </p>

            <div class="info-card">
                <h3 class="text-blue-900 font-bold flex items-center gap-2 text-sm mb-1">
                    <i class="fa-solid fa-circle-info"></i> ¿Primera vez en la biblioteca?
                </h3>
                <p class="text-xs text-blue-800 leading-relaxed">
                    Si es la primera vez, necesitas registrarte para acceder a nuestros servicios de préstamo de libros, revistas y eventos.
                </p>
            </div>
        </div>

        <div class="form-container max-w-lg">
            <h2 class="form-title text-left">Crear Cuenta</h2>
            <p class="form-subtitle text-left">Regístrate para acceder a todos los servicios</p>

            <form id="registerForm" action="{{ route('register') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
                @csrf
                <div class="input-group">
                    <label class="input-label">Nombre</label>
                    <i class="fa-solid fa-user input-icon"></i>
                    <input type="text" name="name" class="input-field" placeholder="Tu nombre">
                </div>
                
                <div class="input-group md:col-span-2">
                    <label class="input-label">Correo electrónico</label>
                    <i class="fa-solid fa-envelope input-icon"></i>
                    <input type="email" name="email" class="input-field" placeholder="usuario@ejemplo.com">
                    <p class="text-[10px] text-gray-400 mt-1">Usaremos este email para contactarte</p>
                </div>
                <div class="input-group">
                    <label class="input-label">Contraseña</label>
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input type="password" name="password" class="input-field" placeholder="Crea una contraseña">
                </div>
                <div class="input-group">
                    <label class="input-label">Repetir Contraseña</label>
                    <i class="fa-solid fa-rotate-right input-icon"></i>
                    <input type="password" name="password_confirmation" class="input-field" placeholder="Repite tu contraseña">
                </div>
                
                <div class="md:col-span-2 mb-4">
                    <label class="flex items-start gap-2 text-[10px] text-gray-600">
                        <input type="checkbox" class="mt-0.5 rounded border-gray-300">
                        Acepto los términos y condiciones y la política de privacidad de la Biblioteca Municipal. Confirmo que soy mayor de 14 años.
                    </label>
                </div>

                <button type="submit" class="btn-primary md:col-span-2">
                    <i class="fa-solid fa-user-plus"></i> Crear Cuenta
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                ¿Ya tienes una cuenta? <a href="#" class="text-blue-600 font-bold hover:underline">Inicia sesión aquí</a>
            </p>

            <div class="bg-gray-100 p-5 rounded-xl border border-gray-200 mt-6">
                <h3 class="text-gray-800 font-bold flex items-center gap-2 text-sm mb-2">
                    <i class="fa-solid fa-gift text-blue-600"></i> Beneficios de registrarse
                </h3>
                <ul class="text-[11px] text-gray-600 space-y-1">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Préstamo de hasta 5 libros simultáneamente</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Acceso a recursos de lectura online</li>
                </ul>
            </div>
        </div>
    </div>

@endsection