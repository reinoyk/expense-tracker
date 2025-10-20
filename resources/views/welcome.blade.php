<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Expense Tracker</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet"/>

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-50 font-['Inter',_sans-serif] text-gray-800 antialiased">
<div class="flex flex-col min-h-screen">
    <header class="w-full">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a class="flex items-center gap-3" href="/">
                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 14H5V17H2V5H5V8H7V5H9V8H11V5H13V8H15V5H17V8H19V5H22V17H19V14H17V17H15V14H13V17H11V14H9V17H7V14Z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold">Expense Tracker</span>
                </a>
                
                @if (Route::has('login'))
                <nav class="hidden md:flex items-center gap-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-blue-500 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-blue-500 transition-colors">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-medium text-gray-600 hover:text-blue-500 transition-colors">Register</a>
                        @endif
                    @endauth
                </nav>
                @endif
                
                <button class="md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
        </div>
    </header>
    <main class="flex-grow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 lg:py-32">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="flex flex-col gap-6 text-center lg:text-left">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-tight">
                        Take Control of Your Finances
                    </h1>
                    <p class="text-base sm:text-lg text-gray-600">
                        Expense Tracker is designed to help students and young professionals easily manage their daily expenses. Record, categorize, and analyze your spending with clarity and ease.
                    </p>
                    <div class="mt-4 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a class="inline-flex items-center justify-center px-6 py-3 rounded-lg bg-blue-500 text-white text-base font-bold shadow-lg hover:bg-blue-600 transition-colors" href="{{ route('register') }}">
                            Get Started
                        </a>
                    </div>
                </div>
                <div class="w-full aspect-square lg:aspect-[4/3] rounded-xl bg-cover bg-center shadow-xl" style="background-image: url('{{ asset('img/expenses-img.png') }}');"></div>
            </div>
        </div>
    </main>
</div>
</body>
</html>

