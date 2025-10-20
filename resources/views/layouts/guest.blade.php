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
    <body class="font-sans text-gray-900 antialiased bg-gray-100">
        <div class="flex flex-col min-h-screen">
            {{-- Header Kustom --}}
            <header class="flex items-center justify-center py-6 px-4 sm:px-6 lg:px-8 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <a href="/">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M7 14H5V17H2V5H5V8H7V5H9V8H11V5H13V8H15V5H17V8H19V5H22V17H19V14H17V17H15V14H13V17H11V14H9V17H7V14Z"></path></svg>
                        </div>
                    </a>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-800">Expense Tracker</h1>
                </div>
            </header>
    
            {{-- Konten Utama (Form) --}}
            <main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
                <div class="w-full max-w-md">
                    <div class="bg-white p-8 shadow-md rounded-xl">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
