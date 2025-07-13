@extends('layouts.app')

@section('title', 'Mes Stats - NutriNotes')

@section('content')
    <!-- En-tête avec titre et bouton d'action -->
    <div class="flex justify-between items-center mb-8">
        <div class="animate-fade-in">
            <h2 class="text-4xl font-bold" style="color: #ffffff;">📊 Mes Statistiques</h2>
            <p class="mt-2 text-lg" style="color: #cccccc;">Analysez l'évolution de vos données dans le temps</p>
        </div>
        <a href="{{ route('stats.create') }}" 
           class="action-btn action-btn-primary animate-slide-left">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
            </svg>
            ➕ Nouvelle Stat
        </a>
    </div>

    <!-- Sélecteur de période stylisé -->
    <div class="mb-8">
        <div class="custom-select-wrapper">
            <form method="GET" action="{{ route('stats.index') }}" id="periodForm">
                <label for="period" class="block text-sm font-medium mb-3" style="color: #ffffff;">
                    📈 Période d'analyse
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
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total d'entrées -->
        <div class="stats-card">
            <div class="stats-card-content">
                <div class="flex items-center">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #a8edea, #fed6e3);">
                        <span class="text-xl">📈</span>
                    </div>
                    <div class="ml-4">
                        <p class="stats-label">Total d'entrées</p>
                        <p class="stats-value">{{ $totalEntries }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Première entrée -->
        <div class="stats-card" style="animation-delay: 0.1s;">
            <div class="stats-card-content">
                <div class="flex items-center">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                        <span class="text-xl">🚀</span>
                    </div>
                    <div class="ml-4">
                        <p class="stats-label">Première entrée</p>
                        <p class="stats-value">
                            {{ $firstEntry ? $firstEntry->date->format('d/m/Y') : 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dernière entrée -->
        <div class="stats-card" style="animation-delay: 0.2s;">
            <div class="stats-card-content">
                <div class="flex items-center">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #bf0000, #ff0000);">
                        <span class="text-xl">📅</span>
                    </div>
                    <div class="ml-4">
                        <p class="stats-label">Dernière entrée</p>
                        <p class="stats-value">
                            {{ $lastEntry ? $lastEntry->date->format('d/m/Y') : 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($stats->count() > 0)
        <!-- Section des graphiques -->
        <div class="chart-section mb-8">
            <div class="chart-header">
                <h2 class="text-2xl font-semibold flex items-center" style="color: #ffffff;">
                    📊 Évolution de vos données
                </h2>
                <p style="color: #cccccc;">Période : {{ $periodLabel }}</p>
            </div>
            
            <!-- Graphiques en grille responsive -->
            <div class="charts-grid">
                <!-- Graphique du poids -->
                <div class="chart-card">
                    <div class="chart-card-header">
                        <h3 class="text-lg font-medium flex items-center" style="color: #ffffff;">
                            ⚖️ Poids
                        </h3>
                    </div>
                    <div class="chart-card-content">
                        <div class="chart-container">
                            <canvas id="weightChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Graphique des calories -->
                <div class="chart-card" style="animation-delay: 0.1s;">
                    <div class="chart-card-header">
                        <h3 class="text-lg font-medium flex items-center" style="color: #ffffff;">
                            🍔 Calories
                        </h3>
                    </div>
                    <div class="chart-card-content">
                        <div class="chart-container">
                            <canvas id="caloriesChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Graphique des pas (sur toute la largeur) -->
                <div class="chart-card chart-card-wide" style="animation-delay: 0.2s;">
                    <div class="chart-card-header">
                        <h3 class="text-lg font-medium flex items-center" style="color: #ffffff;">
                            👟 Activité
                        </h3>
                    </div>
                    <div class="chart-card-content">
                        <div class="chart-container">
                            <canvas id="stepsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des données récentes -->
        <div class="data-table-card">
            <div class="data-table-header">
                <h2 class="text-xl font-semibold flex items-center" style="color: #ffffff;">
                    📋 Données récentes
                </h2>
                <p style="color: #cccccc;">Les 10 dernières entrées</p>
            </div>
            <div class="data-table-content">
                <div class="overflow-x-auto">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>📅 Date</th>
                                <th>⚖️ Poids</th>
                                <th>🍔 Calories</th>
                                <th>👟 Pas</th>
                                <th>⚙️ Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stats->take(10) as $index => $stat)
                                <tr class="table-row" style="animation-delay: {{ $index * 0.05 }}s;">
                                    <td>{{ $stat->date->format('d/m/Y') }}</td>
                                    <td>{{ $stat->weight ? $stat->weight . ' kg' : '-' }}</td>
                                    <td>{{ $stat->calories ? $stat->calories . ' kcal' : '-' }}</td>
                                    <td>{{ $stat->steps ? number_format($stat->steps) . ' pas' : '-' }}</td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="{{ route('stats.edit', $stat) }}" 
                                               class="edit-btn">
                                                ✏️ Modifier
                                            </a>
                                            <form method="POST" action="{{ route('stats.destroy', $stat) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entrée ?')"
                                                        class="delete-btn">
                                                    🗑️ Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <!-- État vide stylisé -->
        <div class="empty-state-card">
            <div class="empty-state">
                <div class="empty-icon">📊</div>
                <h3>Aucune statistique disponible</h3>
                <p>Commencez à enregistrer vos données pour voir vos graphiques et analyses !</p>
                <a href="{{ route('stats.create') }}" class="empty-action">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    🚀 Créer ma première entrée
                </a>
            </div>
        </div>
    @endif

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        @if($stats->count() > 0)
        const chartData = @json($chartData);
        
        // Configuration commune améliorée
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#ffffff',
                        font: {
                            family: 'Inter',
                            size: 14
                        }
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#cccccc',
                        font: {
                            family: 'Inter'
                        }
                    },
                    grid: {
                        color: 'rgba(191, 0, 0, 0.2)'
                    }
                },
                y: {
                    ticks: {
                        color: '#cccccc',
                        font: {
                            family: 'Inter'
                        }
                    },
                    grid: {
                        color: 'rgba(191, 0, 0, 0.2)'
                    }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        };

        // Graphique du poids avec gradient
        const weightCtx = document.getElementById('weightChart').getContext('2d');
        const weightGradient = weightCtx.createLinearGradient(0, 0, 0, 300);
        weightGradient.addColorStop(0, 'rgba(191, 0, 0, 0.4)');
        weightGradient.addColorStop(1, 'rgba(191, 0, 0, 0.1)');

        new Chart(weightCtx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Poids (kg)',
                    data: chartData.weight,
                    borderColor: '#bf0000',
                    backgroundColor: weightGradient,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#bf0000',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: chartOptions
        });

        // Graphique des calories avec gradient orange
        const caloriesCtx = document.getElementById('caloriesChart').getContext('2d');
        const caloriesGradient = caloriesCtx.createLinearGradient(0, 0, 0, 300);
        caloriesGradient.addColorStop(0, 'rgba(255, 107, 53, 0.4)');
        caloriesGradient.addColorStop(1, 'rgba(247, 147, 30, 0.1)');

        new Chart(caloriesCtx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Calories (kcal)',
                    data: chartData.calories,
                    borderColor: '#ff6b35',
                    backgroundColor: caloriesGradient,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#ff6b35',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: chartOptions
        });

        // Graphique des pas avec gradient vert
        const stepsCtx = document.getElementById('stepsChart').getContext('2d');
        const stepsGradient = stepsCtx.createLinearGradient(0, 0, 0, 200);
        stepsGradient.addColorStop(0, 'rgba(79, 172, 254, 0.4)');
        stepsGradient.addColorStop(1, 'rgba(0, 242, 254, 0.1)');

        new Chart(stepsCtx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Pas',
                    data: chartData.steps,
                    borderColor: '#4facfe',
                    backgroundColor: stepsGradient,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#4facfe',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: chartOptions
        });
        @endif
    </script>

    <style>
        /* Animations de base */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideLeft {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        .animate-slide-left {
            animation: slideLeft 0.8s ease-out 0.2s both;
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

        /* Section des graphiques */
        .chart-section {
            animation: fadeIn 0.8s ease-out 0.6s both;
        }

        .chart-header {
            margin-bottom: 24px;
            text-align: center;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .chart-card {
            background: linear-gradient(135deg, #3b3b3b, #2a2a2a);
            border: 2px solid #bf0000;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            animation: fadeIn 0.8s ease-out both;
        }

        .chart-card-wide {
            grid-column: 1 / -1;
        }

        .chart-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(191, 0, 0, 0.2);
            border-color: #ff0000;
        }

        .chart-card-header {
            padding: 20px 24px;
            border-bottom: 2px solid #bf0000;
            background: linear-gradient(90deg, #3b3b3b, #2a2a2a);
        }

        .chart-card-content {
            padding: 24px;
            height: 350px;
            position: relative;
        }

        .chart-card-wide .chart-card-content {
            height: 250px;
        }

        /* Container responsive pour les canvas */
        .chart-container {
            position: relative;
            width: 100%;
            height: 100%;
        }

        /* Boutons d'action */
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

        /* État vide */
        .empty-state-card {
            background: linear-gradient(135deg, #3b3b3b, #2a2a2a);
            border: 2px solid #bf0000;
            border-radius: 16px;
            animation: fadeIn 0.8s ease-out 0.6s both;
        }

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
            display: inline-flex;
            align-items: center;
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

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* === RESPONSIVE MOBILE (PRIORITÉ) === */
        @media (max-width: 640px) {
            /* Header responsive */
            .flex.justify-between.items-center {
                flex-direction: column !important;
                gap: 16px !important;
                text-align: center !important;
                align-items: stretch !important;
            }
            
            h2.text-4xl {
                font-size: 1.75rem !important;
                line-height: 1.2 !important;
            }
            
            .action-btn {
                width: 100% !important;
                justify-content: center !important;
                padding: 14px 20px !important;
                font-size: 16px !important;
                min-height: 44px !important;
            }

            /* Sélecteur de période */
            .custom-select {
                font-size: 16px !important; /* Évite le zoom iOS */
                padding: 16px !important;
                min-height: 44px !important;
            }

            /* Grille des stats - 1 colonne compacte */
            .grid.md\\:grid-cols-3 {
                grid-template-columns: 1fr !important;
                gap: 12px !important;
            }

            .stats-card {
                padding: 16px !important;
                margin-bottom: 0 !important;
            }

            .stats-card:hover {
                transform: none !important; /* Pas d'animation sur mobile */
            }

            .stats-icon {
                width: 40px !important;
                height: 40px !important;
            }

            .stats-value {
                font-size: 20px !important;
            }

            /* GRAPHIQUES OPTIMISÉS MOBILE */
            .charts-grid {
                grid-template-columns: 1fr !important;
                gap: 16px !important;
            }
            
            .chart-card-header {
                padding: 16px !important;
            }
            
            .chart-card-header h3 {
                font-size: 16px !important;
            }
            
            .chart-card-content {
                height: 200px !important; /* Plus petit sur mobile */
                padding: 12px !important;
            }
            
            .chart-card-wide .chart-card-content {
                height: 180px !important;
            }

            /* Canvas responsive */
            canvas {
                max-width: 100% !important;
                height: auto !important;
            }

            /* TABLEAU MOBILE OPTIMISÉ */
            .data-table-content {
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch !important;
            }

            .modern-table {
                font-size: 11px !important;
                min-width: 480px !important; /* Force scroll horizontal */
            }
            
            .modern-table th,
            .modern-table td {
                padding: 8px 6px !important;
                white-space: nowrap !important;
            }
            
            .modern-table th:first-child,
            .modern-table td:first-child {
                position: sticky !important;
                left: 0 !important;
                background: #2a2a2a !important;
                z-index: 10 !important;
            }

            /* Cache colonnes moins importantes sur mobile */
            .modern-table th:nth-child(5),
            .modern-table td:nth-child(5) {
                display: none !important;
            }

            /* Boutons d'action optimisés */
            .edit-btn,
            .delete-btn {
                padding: 8px 10px !important;
                font-size: 11px !important;
                min-height: 36px !important;
                display: block !important;
                margin-bottom: 4px !important;
                text-align: center !important;
            }

            /* État vide mobile */
            .empty-state {
                padding: 40px 16px !important;
            }

            .empty-icon {
                font-size: 48px !important;
            }

            .empty-state h3 {
                font-size: 20px !important;
            }

            .empty-action {
                width: 100% !important;
                justify-content: center !important;
                min-height: 44px !important;
            }
        }

        /* === TABLETTES PORTRAIT (641px - 768px) === */
        @media (min-width: 641px) and (max-width: 768px) {
            .charts-grid {
                grid-template-columns: 1fr !important;
                gap: 20px !important;
            }

            .chart-card-content {
                height: 280px !important;
            }

            .grid.md\\:grid-cols-3 {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }

        /* === TABLETTES PAYSAGE (769px - 1024px) === */
        @media (min-width: 769px) and (max-width: 1024px) {
            .charts-grid {
                grid-template-columns: 1fr 1fr !important;
            }

            .chart-card-wide {
                grid-column: 1 / -1 !important;
            }
        }

        /* === AMÉLIORATION TACTILE === */
        @media (hover: none) {
            /* Supprime les hover effects sur tactile */
            .stats-card:hover,
            .action-btn:hover,
            .table-row:hover,
            .chart-card:hover {
                transform: none !important;
            }

            /* Boutons plus gros pour les doigts */
            .action-btn,
            .edit-btn,
            .delete-btn,
            .empty-action {
                min-height: 44px !important; /* Taille tactile recommandée */
            }
        }

        /* === OPTIMISATION PERFORMANCE MOBILE === */
        @media (max-width: 640px) {
            /* Réduit les animations pour économiser la batterie */
            *, *::before, *::after {
                animation-duration: 0.3s !important;
                transition-duration: 0.2s !important;
            }

            /* Optimise les gradients pour mobile */
            .stats-card,
            .chart-card,
            .data-table-card {
                background: #3b3b3b !important; /* Fond uni sur mobile */
            }
        }
    </style>
@endsection