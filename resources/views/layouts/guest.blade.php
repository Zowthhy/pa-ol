<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
                @if (session('success'))
                    <div id="toast-message" class="fixed bottom-0 mb-4 mr-4 bg-green-500 text-white p-4 rounded shadow-lg transform transition-all duration-500 translate-y-10 opacity-0">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div id="toast-message" class="fixed bottom-0 mb-4 mr-4 bg-red-500 text-white p-4 rounded shadow-lg transform transition-all duration-500 translate-y-10 opacity-0">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const toast = document.getElementById('toast-message');
        if (toast) {
            // Añadir la clase "show" para activar la animación
            setTimeout(() => {
                toast.classList.add('show');
            }, 100); // Pequeño retraso para permitir que se aplique el estilo inicial

            // Ocultar el toast después de 3 segundos
            setTimeout(() => {
                toast.classList.remove('show');
            }, 6000); // tiempo en milisegundos
        }
    });
    </script>
</html>
