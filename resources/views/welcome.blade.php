<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriNotes - Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center" style="background: linear-gradient(135deg, #2a2a2a, #3b3b3b);">
    <!-- Particules d'arrière-plan -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="max-w-md w-full space-y-8 p-6 relative z-10">
        <!-- Logo et titre avec animation -->
        <div class="text-center animate-fade-in">
            <div class="logo-container">
                <div class="logo-icon">🥗</div>
                <h1 class="text-4xl font-bold gradient-text">NutriNotes</h1>
                <p class="subtitle">Votre compagnon nutrition</p>
            </div>
        </div>

        <!-- AJOUTE ÇA ICI -->
        @if(session('auth_required'))
            <div class="auth-message animate-bounce-in">
                <div class="message-content">
                    <svg class="message-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('auth_required') }}</span>
                </div>
            </div>
        @endif

        <!-- Conteneur principal avec animations -->
        <div class="auth-container animate-slide-up">
            <!-- Onglets stylisés -->
            <div class="tabs-container">
                <button onclick="showLogin()" id="loginTab" class="tab-button tab-active">
                    <svg class="tab-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    🔐 Connexion
                </button>
                <button onclick="showRegister()" id="registerTab" class="tab-button">
                    <svg class="tab-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                    </svg>
                    ➕ Inscription
                </button>
            </div>

            <!-- Formulaire Login -->
            <div id="loginForm" class="form-container">
                <div class="form-header">
                    <h2 class="form-title">Content de vous revoir ! 👋</h2>
                    <p class="form-subtitle">Connectez-vous à votre compte</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="auth-form">
                    @csrf
                    
                    <!-- Email -->
                    <div class="input-group">
                        <label for="email" class="input-label">
                            📧 Email
                        </label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            <input type="email" name="email" id="email" required 
                                   class="modern-input"
                                   placeholder="votre@email.com"
                                   value="{{ old('email') }}">
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div class="input-group">
                        <label for="password" class="input-label">
                            🔒 Mot de passe
                        </label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            <input type="password" name="password" id="password" required 
                                   class="modern-input"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Se souvenir -->
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember" class="modern-checkbox">
                            <span class="checkbox-text">Se souvenir de moi</span>
                        </label>
                    </div>

                    <!-- Bouton de connexion -->
                    <button type="submit" class="submit-btn submit-btn-primary">
                        <svg class="btn-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Se connecter
                    </button>
                </form>
            </div>

            <!-- Formulaire Register -->
            <div id="registerForm" class="form-container hidden">
                <div class="form-header">
                    <h2 class="form-title">Bienvenue ! 🎉</h2>
                    <p class="form-subtitle">Créez votre compte NutriNotes</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="auth-form">
                    @csrf
                    
                    <!-- Nom -->
                    <div class="input-group">
                        <label for="name" class="input-label">
                            👤 Nom complet
                        </label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                            <input type="text" name="name" id="name" required 
                                   class="modern-input"
                                   placeholder="Votre nom"
                                   value="{{ old('name') }}">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="input-group">
                        <label for="register_email" class="input-label">
                            📧 Email
                        </label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            <input type="email" name="email" id="register_email" required 
                                   class="modern-input"
                                   placeholder="votre@email.com"
                                   value="{{ old('email') }}">
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div class="input-group">
                        <label for="register_password" class="input-label">
                            🔒 Mot de passe
                        </label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            <input type="password" name="password" id="register_password" required 
                                   class="modern-input"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Confirmation -->
                    <div class="input-group">
                        <label for="password_confirmation" class="input-label">
                            🔐 Confirmer le mot de passe
                        </label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            <input type="password" name="password_confirmation" id="password_confirmation" required 
                                   class="modern-input"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Bouton d'inscription -->
                    <button type="submit" class="submit-btn submit-btn-secondary">
                        <svg class="btn-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                        </svg>
                        Créer mon compte
                    </button>
                </form>
            </div>
        </div>

        <!-- Affichage des erreurs stylisé -->
        @if ($errors->any())
            <div class="error-container animate-shake">
                <div class="error-header">
                    <svg class="error-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span>Oups ! Quelques erreurs à corriger</span>
                </div>
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li class="error-item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <script>
        function showLogin() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const loginTab = document.getElementById('loginTab');
            const registerTab = document.getElementById('registerTab');

            // Animation de transition
            registerForm.style.opacity = '0';
            registerForm.style.transform = 'translateX(30px)';
            
            setTimeout(() => {
                registerForm.classList.add('hidden');
                loginForm.classList.remove('hidden');
                
                setTimeout(() => {
                    loginForm.style.opacity = '1';
                    loginForm.style.transform = 'translateX(0)';
                }, 50);
            }, 150);

            // Changement des onglets
            loginTab.classList.add('tab-active');
            registerTab.classList.remove('tab-active');
        }

        function showRegister() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const loginTab = document.getElementById('loginTab');
            const registerTab = document.getElementById('registerTab');

            // Animation de transition
            loginForm.style.opacity = '0';
            loginForm.style.transform = 'translateX(-30px)';
            
            setTimeout(() => {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                
                setTimeout(() => {
                    registerForm.style.opacity = '1';
                    registerForm.style.transform = 'translateX(0)';
                }, 50);
            }, 150);

            // Changement des onglets
            registerTab.classList.add('tab-active');
            loginTab.classList.remove('tab-active');
        }

        // Animation des particules
        function createParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDuration = (Math.random() * 3 + 2) + 's';
            document.querySelector('.particles').appendChild(particle);
            
            setTimeout(() => {
                particle.remove();
            }, 5000);
        }

        setInterval(createParticle, 300);
    </script>

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        /* Animations de base */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes particleFloat {
            0% { transform: translateY(100vh) scale(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) scale(1); opacity: 0; }
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3) translateY(-20px);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 1s ease-out 0.3s both;
        }

        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }

        .animate-bounce-in {
            animation: bounceIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        /* Particules d'arrière-plan */
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
            animation: particleFloat linear infinite;
            opacity: 0.6;
        }

        /* Logo et titre */
        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            animation: float 3s ease-in-out infinite;
        }

        .gradient-text {
            background: linear-gradient(135deg, #bf0000, #ff0000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #cccccc;
            font-size: 1rem;
            font-weight: 400;
        }

        /* Conteneur principal */
        .auth-container {
            background: linear-gradient(135deg, #3b3b3b, #2a2a2a);
            border: 2px solid #bf0000;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(191, 0, 0, 0.2);
            position: relative;
        }

        .auth-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #bf0000, transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        /* Onglets */
        .tabs-container {
            display: flex;
            background: #2a2a2a;
            border-bottom: 2px solid #bf0000;
        }

        .tab-button {
            flex: 1;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #3b3b3b;
            color: #cccccc;
            border: none;
            cursor: pointer;
        }

        .tab-button:hover {
            background: #4a4a4a;
            transform: translateY(-2px);
        }

        .tab-active {
            background: linear-gradient(135deg, #bf0000, #ff0000) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(191, 0, 0, 0.3);
        }

        .tab-icon {
            width: 1.25rem;
            height: 1.25rem;
        }

        /* Formulaires */
        .form-container {
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: #cccccc;
            font-size: 0.875rem;
        }

        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Groupes d'input */
        .input-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .input-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1.25rem;
            height: 1.25rem;
            color: #bf0000;
            z-index: 1;
        }

        .modern-input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            background: #2a2a2a;
            border: 2px solid #555555;
            border-radius: 12px;
            color: #ffffff;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .modern-input::placeholder {
            color: #888888;
        }

        .modern-input:focus {
            outline: none;
            border-color: #bf0000;
            background: #3b3b3b;
            box-shadow: 0 0 0 3px rgba(191, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .modern-input:focus + .input-icon {
            color: #ff0000;
        }

        /* Checkbox */
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .modern-checkbox {
            width: 1.125rem;
            height: 1.125rem;
            background: #2a2a2a;
            border: 2px solid #555555;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modern-checkbox:checked {
            background: #bf0000;
            border-color: #bf0000;
        }

        .checkbox-text {
            color: #cccccc;
            font-size: 0.875rem;
        }

        /* Boutons */
        .submit-btn {
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border: 2px solid;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 1rem;
        }

        .submit-btn-primary {
            background: linear-gradient(135deg, #bf0000, #ff0000);
            border-color: #bf0000;
            color: #ffffff;
        }

        .submit-btn-primary:hover {
            background: linear-gradient(135deg, #ff0000, #bf0000);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(191, 0, 0, 0.3);
        }

        .submit-btn-secondary {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            border-color: #4facfe;
            color: #ffffff;
        }

        .submit-btn-secondary:hover {
            background: linear-gradient(135deg, #00f2fe, #4facfe);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(79, 172, 254, 0.3);
        }

        .btn-icon {
            width: 1.125rem;
            height: 1.125rem;
        }

        /* Messages d'erreur */
        .error-container {
            background: linear-gradient(135deg, #bf0000, #ff0000);
            border: 2px solid #ff0000;
            border-radius: 12px;
            padding: 1rem;
            color: #ffffff;
            margin-top: 1rem;
        }

        .error-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .error-icon {
            width: 1.25rem;
            height: 1.25rem;
        }

        .error-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .error-item {
            padding: 0.25rem 0;
            font-size: 0.875rem;
            opacity: 0.9;
        }

        .error-item::before {
            content: '• ';
            margin-right: 0.5rem;
        }

        /* Message d'authentification */
        .auth-message {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            border: 2px solid #ff6b35;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            color: #ffffff;
            text-align: center;
        }

        .message-content {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .message-icon {
            width: 1.25rem;
            height: 1.25rem;
            flex-shrink: 0;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .auth-container {
                margin: 1rem;
            }
            
            .form-container {
                padding: 1.5rem;
            }
            
            .tab-button {
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
            }
        }
    </style>
</body>
</html>