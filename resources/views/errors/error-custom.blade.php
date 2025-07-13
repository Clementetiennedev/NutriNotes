<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée - NutriNotes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center" style="background: linear-gradient(135deg, #2a2a2a, #3b3b3b); font-family: 'Inter', sans-serif;">
    
    <!-- Particules d'arrière-plan -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="max-w-lg w-full text-center p-6 relative z-10">
        <!-- Conteneur d'erreur -->
        <div class="error-container animate-fade-in">
            <div class="error-icon">🤖</div>
            <h1 class="error-code">404</h1>
            <h2 class="error-title">Page non trouvée</h2>
            <p class="error-message">
                Oups ! Cette page n'existe pas ou a été déplacée.
            </p>
            
            <!-- Boutons d'action -->
            <div class="error-actions">
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <svg class="btn-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L9 5.414V17a1 1 0 102 0V5.414l5.293 5.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    🏠 Retour à l'accueil
                </a>
                
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <svg class="btn-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        📊 Dashboard
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes particleFloat {
            0% { transform: translateY(100vh) scale(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) scale(1); opacity: 0; }
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-out;
        }

        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #bf0000;
            border-radius: 50%;
            animation: particleFloat 3s linear infinite;
            opacity: 0.6;
        }

        .particle:nth-child(1) { left: 20%; animation-delay: 0s; }
        .particle:nth-child(2) { left: 50%; animation-delay: 1s; }
        .particle:nth-child(3) { left: 80%; animation-delay: 2s; }

        .error-container {
            background: linear-gradient(135deg, #3b3b3b, #2a2a2a);
            border: 2px solid #bf0000;
            border-radius: 20px;
            padding: 3rem 2rem;
            box-shadow: 0 20px 40px rgba(191, 0, 0, 0.2);
        }

        .error-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            animation: float 3s ease-in-out infinite;
        }

        .error-code {
            font-size: 6rem;
            font-weight: 800;
            color: #bf0000;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #bf0000, #ff0000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .error-title {
            font-size: 2rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 1rem;
        }

        .error-message {
            font-size: 1.125rem;
            color: #cccccc;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .error-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.875rem;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid;
            min-width: 200px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #bf0000, #ff0000);
            border-color: #bf0000;
            color: #ffffff;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #ff0000, #bf0000);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(191, 0, 0, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            border-color: #4facfe;
            color: #ffffff;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #00f2fe, #4facfe);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(79, 172, 254, 0.3);
        }

        .btn-icon {
            width: 1.125rem;
            height: 1.125rem;
        }

        @media (min-width: 640px) {
            .error-actions {
                flex-direction: row;
                justify-content: center;
            }
        }
    </style>
</body>
</html>