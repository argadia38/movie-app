<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Movie App') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white font-sans">
    <nav class="bg-gray-800/50 backdrop-blur-sm border-b border-gray-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <a href="{{ route('movies.index') }}" class="text-2xl font-bold text-red-500 hover:text-red-400 transition-colors">
                        MovieApp
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <footer class="bg-gray-800 py-6 mt-12 border-t border-gray-700">
        <div class="text-center text-sm text-gray-400">
            Copyright &copy; {{ date('Y') }} {{ config('app.name', 'Movie App') }}.
        </div>
    </footer>
</body>
</html>
