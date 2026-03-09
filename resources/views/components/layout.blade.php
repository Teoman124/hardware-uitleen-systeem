<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Hardware Uitleen Systeem' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <a href="/" class="text-xl font-bold text-blue-600">Hardware Uitleen</a>
            <nav class="flex items-center gap-4">
                <a href="{{ route('hardware.index') }}"
                    class="text-gray-600 hover:text-blue-600 font-medium">Hardware</a>
                @auth
                    <span class="text-gray-500 text-sm">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-blue-600 font-medium">Uitloggen</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-medium">Inloggen</a>
                    <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600 font-medium">Registreren</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        {{ $slot }}
    </main>

    <footer class="bg-white border-t mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Hardware Uitleen Systeem
        </div>
    </footer>
</body>

</html>