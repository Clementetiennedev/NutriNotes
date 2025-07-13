<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée - NutriNotes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center" style="background: linear-gradient(135deg, #2a2a2a, #3b3b3b);">
    
    <div class="max-w-lg w-full text-center p-6">
        <div class="error-container">
            <div class="error-icon">🤖</div>
            <h1 class="error-code">404</h1>
            <h2 class="error-title">Page non trouvée</h2>
            <p class="error-message">
                Oups ! Cette page n'existe pas ou a été déplacée.
            </p>
            
            <div class="error-actions">
                <a href="{{ route('home') }}" class="btn btn-primary">
                    🏠 Retour à l'accueil
                </a>
            </div>
        </div>
    </div>

    <style>
        body { font-family: 'Inter', sans-serif; }
        
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
        }

        .error-code {
            font-size: 6rem;
            font-weight: 800;
            color: #bf0000;
            margin-bottom: 1rem;
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
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #bf0000, #ff0000);
            color: #ffffff;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(191, 0, 0, 0.3);
        }
    </style>
</body>
</html>