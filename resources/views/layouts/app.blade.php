<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NutriNotes')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Police Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Animations pour les liens de navigation */
        .nav-link {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(191, 0, 0, 0.3), transparent);
            transition: left 0.5s;
        }
        
        .nav-link:hover::before {
            left: 100%;
        }
        
        .nav-link:hover {
            transform: translateX(8px);
            box-shadow: 0 4px 12px rgba(191, 0, 0, 0.3);
        }
        
        /* Animation spéciale pour "Nouvelle Stat" - ISOLATION COMPLÈTE */
        .add-button {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
            position: relative !important;
            background-color: transparent !important;
            color: #bf0000 !important;
            border-color: #bf0000 !important;
        }
        
        /* Empêcher TOUS les autres styles de s'appliquer */
        .add-button:hover,
        .add-button:focus,
        .add-button:active {
            transform: scale(1.05) rotate(2deg) !important;
            box-shadow: 0 8px 25px rgba(191, 0, 0, 0.4) !important;
            background-color: #bf0000 !important;
            color: #ffffff !important;
            border-color: #bf0000 !important;
        }
        
        /* Empêcher les styles nav-link de s'appliquer sur add-button */
        .add-button::before {
            display: none !important;
        }

        /* Animation spéciale pour "Déconnexion" */
        .logout-button {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .logout-button:hover {
            transform: translateX(-5px);
            background-color: #bf0000 !important;
        }
        
        .logout-button svg {
            transition: transform 0.3s ease;
        }
        
        .logout-button:hover svg {
            transform: translateX(5px);
        }
        
        /* Pulse pour le bouton actif */
        .active-nav {
            background-color: #bf0000 !important;
            animation: pulse-glow 2s infinite;
        }
        
        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 5px rgba(191, 0, 0, 0.5);
            }
            50% {
                box-shadow: 0 0 20px rgba(191, 0, 0, 0.8);
            }
        }
    </style>
</head>

<body class="min-h-screen flex" style="background-color: #3b3b3b;">
    
    <!-- Sidebar verticale -->
    <div class="w-64 shadow-lg border-r-2 flex flex-col" style="background-color: #3b3b3b; border-color: #bf0000;">
        <!-- Logo/Titre -->
        <div class="p-6 border-b-2" style="border-color: #bf0000;">
            <h1 class="text-2xl font-bold" style="color: #ffffff;">NutriNotes</h1>
            <p class="text-sm mt-1" style="color: #ffffff;">Salut, {{ auth()->user()->name }} !</p>
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 p-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}" 
                       class="nav-link flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'active-nav' : '' }}"
                       style="color: #ffffff;">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        Dashboard
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('stats.index') }}" 
                       class="nav-link flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('stats.*') ? 'active-nav' : '' }}"
                       style="color: #ffffff;">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                        Mes Stats
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('goals.index') }}" 
                       class="nav-link flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('goals.*') ? 'active-nav' : '' }}"
                       style="color: #ffffff;">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"/>
                        </svg>
                        Objectifs
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('stats.create') }}" 
                       class="add-button flex items-center px-4 py-3 rounded-lg border-2"
                       style="background-color: transparent !important; color: #bf0000 !important; border-color: #bf0000 !important;"
                       onmouseover="this.style.setProperty('background-color', '#bf0000', 'important'); this.style.setProperty('color', '#ffffff', 'important');" 
                       onmouseout="this.style.setProperty('background-color', 'transparent', 'important'); this.style.setProperty('color', '#bf0000', 'important');">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        Nouvelle Stat
                    </a>
                </li>
            </ul>
        </nav>
        
        <!-- Déconnexion en bas -->
        <div class="p-4 border-t-2" style="border-color: #bf0000;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="logout-button w-full flex items-center px-4 py-3 rounded-lg"
                        style="color: #ffffff;">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                    </svg>
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
    
    <!-- Contenu principal -->
    <div class="flex-1 flex flex-col">
        <!-- Messages de succès globaux -->
        @if(session('success'))
            <div class="mx-6 mt-6 border-2 px-4 py-3 rounded" style="background-color: #bf0000; border-color: #ff0000; color: #ffffff;">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Contenu de la page -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>