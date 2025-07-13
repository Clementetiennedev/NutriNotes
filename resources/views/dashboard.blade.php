@extends('layouts.app')

@section('title', 'Dashboard - NutriNotes')

@section('content')
    <!-- Titre avec animation -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-2 animate-fade-in" style="color: #ffffff;">
            Tableau de bord
        </h1>
        <p class="text-lg animate-slide-up" style="color: #cccccc;">
            Bienvenue {{ auth()->user()->name }}, voici un aperçu de vos données
        </p>
    </div>

    <!-- Sélecteur de période stylisé -->
    <div class="mb-8">
        <div class="custom-select-wrapper">
            <form method="GET" action="{{ route('dashboard') }}" id="periodForm">
                <label for="period" class="block text-sm font-medium mb-3" style="color: #ffffff;">
                    📊 Période pour les moyennes
                </label>
                <div class="relative">
                    <select name="period" id="period" onchange="document.getElementById('periodForm').submit()" 
                            class="custom-select appearance-none w-full px-4 py-3 pr-10 rounded-lg border-2 focus:outline-none focus:ring-2 transition-all duration-300"
                            style="background-color: #3b3b3b; border-color: #bf0000; color: #ffffff; --tw-ring-color: #bf0000;">
                        <option value="7" {{ $period == '7' ? 'selected' : '' }}>📅 7 derniers jours</option>
                        <option value="30" {{ $period == '30' ? 'selected' : '' }}>📅 30 derniers jours</option>
                        <option value="all" {{ $period == 'all' ? 'selected' : '' }}>📅 Toutes les données</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
                        <svg class="w-5 h-5 transition-transform duration-300" fill="currentColor" style="color: #bf0000;" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Statistiques rapides avec animations -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Poids avec tendance -->
        <div class="stats-card">
            <div class="stats-card-content">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="stats-icon" style="background: linear-gradient(135deg, #bf0000, #ff0000);">
                            <!-- Balance emoji 3D -->
                            <span class="text-xl">⚖️</span>
                        </div>
                        <div class="ml-4">
                            <p class="stats-label">Dernier poids</p>
                            <p class="stats-value">
                                {{ $latestWeight ? $latestWeight . ' kg' : 'N/A' }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- Flèche de tendance avec animation -->
                    @if($weightTrend)
                        @php
                            $userGoal = auth()->user()->goal ?? 'maintain';
                            
                            if ($weightTrend['direction'] === 'up') {
                                $color = ($userGoal === 'bulk') ? '#00ff00' : '#ff0000';
                            } elseif ($weightTrend['direction'] === 'down') {
                                $color = ($userGoal === 'cut') ? '#00ff00' : '#ff0000';
                            } else {
                                $color = ($userGoal === 'maintain') ? '#00ff00' : '#ffffff';
                            }
                        @endphp
                        
                        <div class="trend-indicator">
                            @if($weightTrend['direction'] === 'up')
                                <svg class="trend-arrow trend-up" fill="currentColor" style="color: {{ $color }};" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="trend-value" style="color: {{ $color }};">+{{ number_format($weightTrend['value'], 1) }}</span>
                            @elseif($weightTrend['direction'] === 'down')
                                <svg class="trend-arrow trend-down" fill="currentColor" style="color: {{ $color }};" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="trend-value" style="color: {{ $color }};">-{{ number_format($weightTrend['value'], 1) }}</span>
                            @else
                                <svg class="trend-arrow" fill="currentColor" style="color: {{ $color }};" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <span class="trend-value" style="color: {{ $color }};">stable</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Calories moyennes -->
        <div class="stats-card" style="animation-delay: 0.1s;">
            <div class="stats-card-content">
                <div class="flex items-center">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #ff6b35, #f7931e);">
                        <!-- Burger emoji 3D -->
                        <span class="text-xl">🍔</span>
                    </div>
                    <div class="ml-4">
                        <p class="stats-label">Calories moyennes ({{ $periodLabel }})</p>
                        <p class="stats-value">
                            {{ $avgCalories ? round($avgCalories) . ' kcal' : 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pas moyens -->
        <div class="stats-card" style="animation-delay: 0.2s;">
            <div class="stats-card-content">
                <div class="flex items-center">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                        <span class="text-lg">👟</span>
                    </div>
                    <div class="ml-4">
                        <p class="stats-label">Pas moyens ({{ $periodLabel }})</p>
                        <p class="stats-value">
                            {{ $avgSteps ? number_format(round($avgSteps)) : 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total entrées -->
        <div class="stats-card" style="animation-delay: 0.3s;">
            <div class="stats-card-content">
                <div class="flex items-center">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #a8edea, #fed6e3);">
                        <svg class="w-5 h-5" fill="currentColor" style="color: #bf0000;" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="stats-label">Total entrées</p>
                        <p class="stats-value">{{ $totalEntries }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides avec animations -->
    <div class="action-card mb-8">
        <div class="action-header">
            <h2 class="text-xl font-semibold flex items-center" style="color: #ffffff;">
                ⚡ Actions rapides
            </h2>
        </div>
        <div class="action-content">
            <a href="{{ route('stats.create') }}" class="action-btn action-btn-primary">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                Ajouter une nouvelle stat
            </a>
            <a href="{{ route('stats.index') }}" class="action-btn action-btn-secondary">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v6h-4.586l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 1.414L13.414 11H16V5z" clip-rule="evenodd"/>
                </svg>
                Voir toutes mes stats
            </a>
        </div>
    </div>

    <!-- Dernières entrées avec style moderne -->
    <div class="data-table-card">
        <div class="data-table-header">
            <h2 class="text-xl font-semibold flex items-center" style="color: #ffffff;">
                📋 Dernières entrées
            </h2>
        </div>
        <div class="data-table-content">
            @if($stats->count() > 0)
                <!-- Version desktop/tablette -->
                <div class="desktop-table-view overflow-x-auto">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>📅 Date</th>
                                <th>⚖️ Poids</th>
                                <th>🍔 Calories</th>
                                <th>👟 Pas</th>
                                <th>📝 Notes</th>
                                <th>🔧 Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stats as $index => $stat)
                                <tr class="table-row" style="animation-delay: {{ $index * 0.05 }}s;">
                                    <td>{{ $stat->date->format('d/m/Y') }}</td>
                                    <td>{{ $stat->weight ? $stat->weight . ' kg' : '-' }}</td>
                                    <td>{{ $stat->calories ? $stat->calories . ' kcal' : '-' }}</td>
                                    <td>{{ $stat->steps ? number_format($stat->steps) . ' pas' : '-' }}</td>
                                    <td>{{ $stat->notes ? Str::limit($stat->notes, 50) : '-' }}</td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="{{ route('stats.edit', $stat) }}" class="edit-btn">✏️ Modifier</a>
                                            <form method="POST" action="{{ route('stats.destroy', $stat) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Supprimer cette entrée ?')"
                                                        class="delete-btn">🗑️</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Version mobile avec cartes -->
                <div class="mobile-card-view" style="display: none;">
                    @foreach($stats as $stat)
                        <div class="mobile-stat-card">
                            <div class="mobile-stat-header">
                                <span>📅 {{ $stat->date->format('d/m/Y') }}</span>
                                <div class="mobile-stat-actions">
                                    <a href="{{ route('stats.edit', $stat) }}" class="edit-btn">✏️</a>
                                    <form method="POST" action="{{ route('stats.destroy', $stat) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Supprimer ?')"
                                                class="delete-btn">🗑️</button>
                                    </form>
                                </div>
                            </div>
                            <div class="mobile-stat-content">
                                <div class="mobile-stat-item">
                                    <strong>⚖️ Poids:</strong><br>
                                    {{ $stat->weight ? $stat->weight . ' kg' : '-' }}
                                </div>
                                <div class="mobile-stat-item">
                                    <strong>🍔 Calories:</strong><br>
                                    {{ $stat->calories ? $stat->calories . ' kcal' : '-' }}
                                </div>
                                <div class="mobile-stat-item">
                                    <strong>👟 Pas:</strong><br>
                                    {{ $stat->steps ? number_format($stat->steps) : '-' }}
                                </div>
                                @if($stat->notes)
                                <div class="mobile-stat-item">
                                    <strong>📝 Notes:</strong><br>
                                    {{ Str::limit($stat->notes, 100) }}
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- État vide reste pareil -->
                <div class="empty-state">
                    <div class="empty-icon">📊</div>
                    <h3>Aucune statistique</h3>
                    <p>Commencez dès maintenant</p>
                    <a href="{{ route('stats.create') }}" class="empty-action">
                        Ajoutez votre première entrée !
                    </a>
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Animations de base */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.8s ease-out 0.2s both;
        }

        /* Sélecteur personnalisé */
        .custom-select-wrapper {
            animation: fadeIn 0.8s ease-out 0.4s both;
        }

        .custom-select:focus {
            transform: scale(1.02);
            box-shadow: 0 0 20px rgba(191, 0, 0, 0.3);
        }

        .custom-select-wrapper:hover svg {
            transform: rotate(180deg);
        }

        /* Cartes de statistiques */
        .stats-card {
            background: linear-gradient(135deg, #3b3b3b, #2a2a2a);
            border: 2px solid #bf0000;
            border-radius: 16px;
            padding: 24px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            animation: fadeIn 0.8s ease-out both;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(191, 0, 0, 0.1), transparent);
            transition: left 0.6s;
        }

        .stats-card:hover::before {
            left: 100%;
        }

        .stats-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(191, 0, 0, 0.2);
            border-color: #ff0000;
        }

        .stats-card-content {
            position: relative;
            z-index: 1;
        }

        .stats-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .stats-card:hover .stats-icon {
            transform: rotate(5deg) scale(1.1);
        }

        .stats-label {
            font-size: 14px;
            color: #cccccc;
            margin-bottom: 4px;
        }

        .stats-value {
            font-size: 24px;
            font-weight: 700;
            color: #ffffff;
        }

        /* Indicateurs de tendance */
        .trend-indicator {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .trend-arrow {
            width: 24px;
            height: 24px;
            transition: transform 0.3s ease;
        }

        .trend-up {
            animation: bounce 2s infinite;
        }

        .trend-down {
            animation: bounce 2s infinite reverse;
        }

        .trend-value {
            font-size: 12px;
            font-weight: 600;
        }

        /* Carte d'actions */
        .action-card {
            background: linear-gradient(135deg, #3b3b3b, #2a2a2a);
            border: 2px solid #bf0000;
            border-radius: 16px;
            overflow: hidden;
            animation: fadeIn 0.8s ease-out 0.6s both;
        }

        .action-header {
            padding: 20px 24px;
            border-bottom: 2px solid #bf0000;
            background: linear-gradient(90deg, #3b3b3b, #2a2a2a);
        }

        .action-content {
            padding: 24px;
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid;
        }

        .action-btn-primary {
            background: linear-gradient(135deg, #bf0000, #ff0000);
            color: #ffffff;
            border-color: #bf0000;
        }

        .action-btn-primary:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 10px 20px rgba(191, 0, 0, 0.3);
            background: linear-gradient(135deg, #ff0000, #bf0000);
        }

        .action-btn-secondary {
            background: transparent;
            color: #ffffff;
            border-color: #bf0000;
        }

        .action-btn-secondary:hover {
            background: #bf0000;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(191, 0, 0, 0.2);
        }

        /* Table moderne */
        .data-table-card {
            background: linear-gradient(135deg, #3b3b3b, #2a2a2a);
            border: 2px solid #bf0000;
            border-radius: 16px;
            overflow: hidden;
            animation: fadeIn 0.8s ease-out 0.8s both;
        }

        .data-table-header {
            padding: 20px 24px;
            border-bottom: 2px solid #bf0000;
            background: linear-gradient(90deg, #3b3b3b, #2a2a2a);
        }

        .data-table-content {
            padding: 0;
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
        }

        .modern-table th {
            padding: 16px 24px;
            text-align: left;
            font-weight: 600;
            color: #ffffff;
            background: #2a2a2a;
            border-bottom: 2px solid #bf0000;
        }

        .modern-table td {
            padding: 16px 24px;
            color: #ffffff;
            border-bottom: 1px solid #bf0000;
        }

        .table-row {
            transition: all 0.3s ease;
            animation: fadeIn 0.8s ease-out both;
        }

        .table-row:hover {
            background: rgba(191, 0, 0, 0.1);
            transform: scale(1.01);
        }

        .delete-btn {
            color: #bf0000;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .delete-btn:hover {
            background: #bf0000;
            color: #ffffff;
            transform: scale(1.05);
        }

        /* Bouton d'édition */
        .edit-btn {
            color: #4facfe;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .edit-btn:hover {
            background: #4facfe;
            color: #ffffff;
            transform: scale(1.05);
        }

        /* État vide */
        .empty-state {
            padding: 60px 24px;
            text-align: center;
            color: #ffffff;
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 16px;
            animation: pulse 2s infinite;
        }

        .empty-state h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: #cccccc;
            margin-bottom: 24px;
        }

        .empty-action {
            display: inline-block;
            padding: 12px 24px;
            background: #bf0000;
            color: #ffffff;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .empty-action:hover {
            background: #ff0000;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(191, 0, 0, 0.3);
        }

        /* === RESPONSIVE MOBILE FIRST === */
        @media (max-width: 640px) {
            /* Titre principal */
            .mb-8 h1 {
                font-size: 2rem !important;
                line-height: 1.2;
            }
            
            .mb-8 p {
                font-size: 1rem !important;
            }

            /* Sélecteur de période */
            .custom-select {
                font-size: 16px !important; /* Évite le zoom iOS */
            }

            /* Grille des stats - 1 colonne sur mobile */
            .grid-cols-1.md\:grid-cols-2.lg\:grid-cols-4 {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
            }

            /* Cartes de stats plus compactes */
            .stats-card {
                padding: 16px !important;
            }

            .stats-card:hover {
                transform: none !important; /* Pas d'animation sur mobile */
            }

            .stats-value {
                font-size: 20px !important;
            }

            .stats-icon {
                width: 40px !important;
                height: 40px !important;
            }

            /* Tendance plus petite */
            .trend-indicator {
                display: none; /* Cache les tendances sur très petit écran */
            }

            /* Actions rapides */
            .action-content {
                flex-direction: column !important;
                gap: 12px !important;
                padding: 16px !important;
            }
            
            .action-btn {
                width: 100% !important;
                justify-content: center !important;
                padding: 14px 20px !important;
                font-size: 16px !important;
            }

            /* Tableau responsive */
            .data-table-content {
                overflow-x: auto !important;
            }

            .modern-table {
                min-width: 600px; /* Force le scroll horizontal */
                font-size: 14px !important;
            }

            .modern-table th,
            .modern-table td {
                padding: 12px 8px !important;
                white-space: nowrap;
            }

            /* Cache certaines colonnes sur mobile */
            .modern-table th:nth-child(5),
            .modern-table td:nth-child(5) {
                display: none; /* Cache les notes */
            }

            /* Boutons d'action plus gros */
            .edit-btn,
            .delete-btn {
                padding: 10px 12px !important;
                font-size: 12px !important;
                display: block !important;
                margin-bottom: 4px !important;
            }

            /* État vide */
            .empty-state {
                padding: 40px 16px !important;
            }

            .empty-icon {
                font-size: 48px !important;
            }

            .empty-state h3 {
                font-size: 20px !important;
            }
        }

        /* === TABLETTES (641px à 768px) === */
        @media (min-width: 641px) and (max-width: 768px) {
            /* Grille 2 colonnes sur tablette */
            .grid-cols-1.md\:grid-cols-2.lg\:grid-cols-4 {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            /* Tableau avec plus d'espace */
            .modern-table th,
            .modern-table td {
                padding: 14px 16px !important;
            }

            /* Actions en ligne */
            .action-content {
                flex-direction: row !important;
                flex-wrap: wrap !important;
            }

            .action-btn {
                flex: 1 !important;
                min-width: 200px !important;
            }
        }

        /* === GRANDES TABLETTES ET PLUS (769px+) === */
        @media (min-width: 769px) {
            /* Réafficher les tendances */
            .trend-indicator {
                display: flex !important;
            }

            /* Réafficher les notes */
            .modern-table th:nth-child(5),
            .modern-table td:nth-child(5) {
                display: table-cell !important;
            }
        }

        /* === AMÉLIORATION TACTILE === */
        @media (hover: none) {
            /* Supprime les hover effects sur tactile */
            .stats-card:hover,
            .action-btn:hover,
            .table-row:hover {
                transform: none !important;
            }

            /* Boutons plus gros pour les doigts */
            .action-btn,
            .edit-btn,
            .delete-btn {
                min-height: 44px !important; /* Taille tactile recommandée */
            }
        }

        /* === TABLE MOBILE ALTERNATIVE === */
        @media (max-width: 640px) {
            /* Version carte pour mobile */
            .mobile-card-view {
                display: block !important;
            }

            .desktop-table-view {
                display: none !important;
            }

            .mobile-stat-card {
                background: rgba(191, 0, 0, 0.1);
                border: 1px solid #bf0000;
                border-radius: 12px;
                padding: 16px;
                margin-bottom: 12px;
            }

            .mobile-stat-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 12px;
                font-weight: 600;
                color: #ffffff;
            }

            .mobile-stat-content {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 8px;
                margin-bottom: 12px;
            }

            .mobile-stat-item {
                color: #cccccc;
                font-size: 14px;
            }

            .mobile-stat-actions {
                display: flex;
                gap: 8px;
                justify-content: flex-end;
            }
        }
    </style>
@endsection