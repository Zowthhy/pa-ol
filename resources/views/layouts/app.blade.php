
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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-300">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
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
            </main>
        </div>
    </body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const toast = document.getElementById('toast-message');
        if (toast) {
            // Añadir la clase "show" para activar la animación
            setTimeout(() => {
                toast.classList.add('show');
            }, 100); // retraso para permitir que se aplique el estilo inicial

            // Ocultar el toast después de 3 segundos
            setTimeout(() => {
                toast.classList.remove('show');
            }, 6000); // tiempo en milisegundos
        }
    });
    </script>
</html>

