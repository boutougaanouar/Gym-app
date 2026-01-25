<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gym Manager') - Application de Gestion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-indigo-600 to-indigo-800 text-white shadow-xl">
            <div class="p-6">
                <div class="flex items-center space-x-3">
                    <div class="bg-white rounded-lg p-2">
                        <i class="fas fa-dumbbell text-indigo-600 text-xl"></i>
                    </div>
                    <h1 class="text-xl font-bold">Gym Manager</h1>
                </div>
            </div>
            
            <nav class="mt-6">
                <div class="px-4 space-y-2">
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-white text-indigo-600 shadow-lg' : 'hover:bg-indigo-700' }}">
                        <i class="fas fa-chart-line w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="{{ route('plans.index') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('plans.*') ? 'bg-white text-indigo-600 shadow-lg' : 'hover:bg-indigo-700' }}">
                        <i class="fas fa-clipboard-list w-5"></i>
                        <span>Plans d'abonnement</span>
                    </a>
                    
                    <a href="{{ route('clients.index') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('clients.*') ? 'bg-white text-indigo-600 shadow-lg' : 'hover:bg-indigo-700' }}">
                        <i class="fas fa-users w-5"></i>
                        <span>Clients</span>
                    </a>
                    
                    <a href="{{ route('coaches.index') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('coaches.*') ? 'bg-white text-indigo-600 shadow-lg' : 'hover:bg-indigo-700' }}">
                        <i class="fas fa-user-tie w-5"></i>
                        <span>Coachs</span>
                    </a>
                    
                    <a href="{{ route('calendar.index') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('calendar.*') ? 'bg-white text-indigo-600 shadow-lg' : 'hover:bg-indigo-700' }}">
                        <i class="fas fa-calendar-alt w-5"></i>
                        <span>Calendrier</span>
                    </a>
                </div>
            </nav>
            
            <!-- User menu at bottom -->
            <div class="absolute bottom-0 w-64 p-4 border-t border-indigo-700">
                <div class="flex items-center space-x-3">
                    <div class="bg-indigo-500 rounded-full w-10 h-10 flex items-center justify-center">
                        <span class="font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-indigo-200">Administrateur</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-indigo-200 hover:text-white transition-colors">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Top bar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                            <p class="text-gray-600 text-sm">@yield('page-subtitle', 'Gestion de votre salle de sport')</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">
                                <i class="far fa-clock mr-1"></i>
                                {{ now()->format('d/m/Y H:i') }}
                            </span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center space-x-2">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center space-x-2">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @stack('scripts')
</body>
</html>
