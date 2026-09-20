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

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">

<div class="min-h-screen flex">

    <!-- SIDEBAR (ADMIN + MODERATOR) -->
    @if(auth()->user()->role === 'administrator' || auth()->user()->role === 'moderator')
        <aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 min-h-screen p-6">

            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">
                Panel nawigacji
            </h3>

            <ul class="space-y-3">

                <!-- Pracownicy -->
                <li>
                    <a href="{{ route('employees.index') }}"
                       class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                        👤 Pracownicy
                    </a>
                </li>

                <!-- Pojazdy -->
                <li>
                    <a href="{{ route('vehicles.index') }}"
                       class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                        🚗 Pojazdy
                    </a>
                </li>

                <!-- Utwórz konto (ADMIN ONLY) -->
                @if(auth()->user()->role === 'administrator')
                    <li>
                        <a href="{{ route('registerNewUser') }}"
                           class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                            ➕ Utwórz konto
                        </a>
                    </li>

                    <!-- Nadaj uprawnienia (ADMIN ONLY) -->
                
                    <li>
                        <a href="{{ route('employees.givePrivileges') }}"
                           class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                            ➕ Nadaj uprawnienia
                        </a>
                    </li>

                    <!-- Ustawienia aplikacji -->
                    <li>
                        <a href="#"
                           class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                            ⚙️ Ustawienia aplikacji
                        </a>
                    </li>
                @endif

            </ul>
        </aside>
    @endif

    <!-- MAIN CONTENT WRAPPER -->
    <div class="flex-1 flex flex-col">

        <!-- TOP NAVIGATION (Breeze default) -->
        @include('layouts.navigation')

        <!-- HEADER -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- PAGE CONTENT -->
        <main class="flex-1 p-8">
            {{ $slot }}
        </main>

    </div>

</div>

</body>
</html>