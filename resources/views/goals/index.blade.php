@extends('layouts.app')

@section('title', 'Objectifs - NutriNotes')

@section('content')
    <!-- En-tête avec titre animé -->
    <div class="mb-8">
        <h2 class="text-4xl font-bold animate-fade-in" style="color: #ffffff;">🎯 Mes Objectifs</h2>
        <p class="mt-2 text-lg animate-slide-up" style="color: #cccccc;">
            Définissez votre objectif pour adapter intelligemment vos indicateurs de tendance
        </p>
    </div>

    <!-- Indicateur d'objectif actuel en haut -->
    <div class="current-goal-indicator mb-8">
        <div class="goal-badge">
            @php
                $goalData = [
                    'cut' => ['icon' => '🔥', 'title' => 'Sèche', 'color' => '#ff6b35'],
                    'bulk' => ['icon' => '💪', 'title' => 'Prise de masse', 'color' => '#4facfe'],
                    'maintain' => ['icon' => '⚖️', 'title' => 'Maintien', 'color' => '#00ff00']
                ];
                $current = $goalData[$user->goal] ?? $goalData['maintain'];
            @endphp
            
            <div class="goal-badge-content">
                <span class="goal-icon">{{ $current['icon'] }}</span>
                <div>
                    <p class="goal-label">Objectif actuel</p>
                    <p class="goal-title" style="color: {{ $current['color'] }};">{{ $current['title'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sélecteur d'objectif principal avec style moderne -->
    <div class="goal-selector-card">
        <div class="goal-selector-header">
            <h3 class="text-xl font-semibold flex items-center" style="color: #ffffff;">
                🎲 Choisir un objectif
            </h3>
            <p style="color: #cccccc;">Sélectionnez votre objectif pour personnaliser vos analyses</p>
        </div>
        
        <div class="goal-selector-content">
            <form method="POST" action="{{ route('goals.update') }}">
                @csrf
                <div class="goals-grid">
                    <!-- Option Sèche -->
                    <div class="goal-option {{ $user->goal === 'cut' ? 'goal-active' : '' }}" style="animation-delay: 0s;">
                        <input type="radio" name="goal" value="cut" {{ $user->goal === 'cut' ? 'checked' : '' }}
                               class="goal-radio" onchange="this.form.submit()" id="goal-cut">
                        <label for="goal-cut" class="goal-label-full">
                            <div class="goal-icon-large">🔥</div>
                            <div class="goal-content">
                                <h4 class="goal-title-large">Sèche</h4>
                                <p class="goal-subtitle">Perte de poids</p>
                                <p class="goal-description">
                                    Perdre du poids et réduire le taux de masse grasse pour révéler les muscles
                                </p>
                                <div class="goal-indicator">
                                    <span class="trend-arrow-small">↓</span>
                                    <span class="trend-text">Tendance verte quand le poids diminue</span>
                                </div>
                            </div>
                            <div class="goal-check">
                                <svg class="check-icon" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </label>
                    </div>

                    <!-- Option Prise de masse -->
                    <div class="goal-option {{ $user->goal === 'bulk' ? 'goal-active' : '' }}" style="animation-delay: 0.1s;">
                        <input type="radio" name="goal" value="bulk" {{ $user->goal === 'bulk' ? 'checked' : '' }}
                               class="goal-radio" onchange="this.form.submit()" id="goal-bulk">
                        <label for="goal-bulk" class="goal-label-full">
                            <div class="goal-icon-large">💪</div>
                            <div class="goal-content">
                                <h4 class="goal-title-large">Prise de masse</h4>
                                <p class="goal-subtitle">Gain de poids</p>
                                <p class="goal-description">
                                    Gagner du poids et développer la masse musculaire pour plus de force
                                </p>
                                <div class="goal-indicator">
                                    <span class="trend-arrow-small">↑</span>
                                    <span class="trend-text">Tendance verte quand le poids augmente</span>
                                </div>
                            </div>
                            <div class="goal-check">
                                <svg class="check-icon" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </label>
                    </div>

                    <!-- Option Maintien -->
                    <div class="goal-option {{ $user->goal === 'maintain' ? 'goal-active' : '' }}" style="animation-delay: 0.2s;">
                        <input type="radio" name="goal" value="maintain" {{ $user->goal === 'maintain' ? 'checked' : '' }}
                               class="goal-radio" onchange="this.form.submit()" id="goal-maintain">
                        <label for="goal-maintain" class="goal-label-full">
                            <div class="goal-icon-large">⚖️</div>
                            <div class="goal-content">
                                <h4 class="goal-title-large">Maintien</h4>
                                <p class="goal-subtitle">Stabilisation</p>
                                <p class="goal-description">
                                    Maintenir le poids actuel et préserver la composition corporelle
                                </p>
                                <div class="goal-indicator">
                                    <span class="trend-arrow-small">→</span>
                                    <span class="trend-text">Tendance verte quand le poids est stable</span>
                                </div>
                            </div>
                            <div class="goal-check">
                                <svg class="check-icon" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Informations et conseils -->
    <div class="info-cards-grid">
        <!-- Comment ça fonctionne -->
        <div class="info-card" style="animation-delay: 0.3s;">
            <div class="info-card-header">
                <div class="info-icon">📊</div>
                <h3>Comment ça fonctionne ?</h3>
            </div>
            <div class="info-card-content">
                <div class="info-list">
                    <div class="info-item">
                        <div class="info-bullet" style="background: #00ff00;"></div>
                        <span><strong>Vert</strong> = Tendance favorable à votre objectif</span>
                    </div>
                    <div class="info-item">
                        <div class="info-bullet" style="background: #ff0000;"></div>
                        <span><strong>Rouge</strong> = Tendance défavorable à votre objectif</span>
                    </div>
                    <div class="info-item">
                        <div class="info-bullet" style="background: #ffffff;"></div>
                        <span><strong>Blanc</strong> = Tendance neutre (pas de changement)</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Conseils nutritionnels -->
        <div class="info-card" style="animation-delay: 0.4s;">
            <div class="info-card-header">
                <div class="info-icon">🍎</div>
                <h3>Conseils nutritionnels</h3>
            </div>
            <div class="info-card-content">
                @if($user->goal === 'cut')
                    <div class="advice-content">
                        <p><strong>💡 Pour la sèche :</strong></p>
                        <ul class="advice-list">
                            <li>Déficit calorique de 300-500 kcal/jour</li>
                            <li>Privilégier les protéines (1.6-2.2g/kg)</li>
                            <li>Cardio modéré + musculation</li>
                        </ul>
                    </div>
                @elseif($user->goal === 'bulk')
                    <div class="advice-content">
                        <p><strong>💡 Pour la prise de masse :</strong></p>
                        <ul class="advice-list">
                            <li>Surplus calorique de 200-500 kcal/jour</li>
                            <li>Glucides autour de l'entraînement</li>
                            <li>Focus sur la musculation intensive</li>
                        </ul>
                    </div>
                @else
                    <div class="advice-content">
                        <p><strong>💡 Pour le maintien :</strong></p>
                        <ul class="advice-list">
                            <li>Calories de maintenance</li>
                            <li>Alimentation équilibrée et variée</li>
                            <li>Activité physique régulière</li>
                        </ul>
                    </div>
                @endif
            </div>
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

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.8s ease-out 0.2s both;
        }

        /* Indicateur d'objectif actuel */
        .current-goal-indicator {
            animation: fadeIn 0.8s ease-out 0.4s both;
        }

        .goal-badge {
            background: linear-gradient(135deg, #3b3b3b, #2a2a2a);
            border: 2px solid #bf0000;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .goal-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(191, 0, 0, 0.1), transparent);
            transition: left 0.6s;
        }

        .goal-badge:hover::before {
            left: 100%;
        }

        .goal-badge-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            position: relative;
            z-index: 1;
        }

        .goal-icon {
            font-size: 32px;
        }

        .goal-label {
            font-size: 14px;
            color: #cccccc;
            margin-bottom: 4px;
        }

        .goal-title {
            font-size: 20px;
            font-weight: 700;
        }

        /* Sélecteur d'objectifs */
        .goal-selector-card {
            background: linear-gradient(135deg, #3b3b3b, #2a2a2a);
            border: 2px solid #bf0000;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 32px;
            animation: fadeIn 0.8s ease-out 0.6s both;
        }

        .goal-selector-header {
            padding: 24px;
            border-bottom: 2px solid #bf0000;
            background: linear-gradient(90deg, #3b3b3b, #2a2a2a);
            text-align: center;
        }

        .goal-selector-content {
            padding: 32px;
        }

        .goals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 24px;
        }

        .goal-option {
            position: relative;
            animation: fadeIn 0.8s ease-out both;
        }

        .goal-radio {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .goal-label-full {
            display: block;
            background: linear-gradient(135deg, #3b3b3b, #2a2a2a);
            border: 2px solid #555555;
            border-radius: 16px;
            padding: 24px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .goal-label-full::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(191, 0, 0, 0.1), transparent);
            transition: left 0.5s;
        }

        .goal-label-full:hover::before {
            left: 100%;
        }

        .goal-label-full:hover {
            border-color: #bf0000;
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(191, 0, 0, 0.2);
        }

        .goal-active .goal-label-full {
            border-color: #bf0000;
            background: linear-gradient(135deg, #bf000020, #bf000010);
            box-shadow: 0 8px 16px rgba(191, 0, 0, 0.3);
        }

        .goal-icon-large {
            font-size: 48px;
            margin-bottom: 16px;
            animation: pulse 2s infinite;
        }

        .goal-content {
            position: relative;
            z-index: 1;
        }

        .goal-title-large {
            font-size: 24px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .goal-subtitle {
            font-size: 14px;
            color: #bf0000;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .goal-description {
            font-size: 14px;
            color: #cccccc;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .goal-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            background: rgba(0, 255, 0, 0.1);
            border-radius: 8px;
            border: 1px solid #00ff00;
        }

        .trend-arrow-small {
            font-size: 16px;
            color: #00ff00;
            font-weight: bold;
        }

        .trend-text {
            font-size: 12px;
            color: #00ff00;
            font-weight: 500;
        }

        .goal-check {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 24px;
            height: 24px;
            background: #bf0000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 2;
        }

        .goal-active .goal-check {
            opacity: 1;
        }

        .check-icon {
            width: 14px;
            height: 14px;
            color: #ffffff;
        }

        /* Cartes d'informations */
        .info-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .info-card {
            background: linear-gradient(135deg, #3b3b3b, #2a2a2a);
            border: 2px solid #bf0000;
            border-radius: 16px;
            overflow: hidden;
            animation: fadeIn 0.8s ease-out both;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(191, 0, 0, 0.2);
            border-color: #ff0000;
        }

        .info-card-header {
            padding: 20px 24px;
            border-bottom: 2px solid #bf0000;
            background: linear-gradient(90deg, #3b3b3b, #2a2a2a);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .info-icon {
            font-size: 24px;
        }

        .info-card-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: #ffffff;
            margin: 0;
        }

        .info-card-content {
            padding: 24px;
        }

        .info-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #ffffff;
            font-size: 14px;
        }

        .info-bullet {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .advice-content {
            color: #ffffff;
        }

        .advice-content p {
            margin-bottom: 12px;
            font-size: 16px;
        }

        .advice-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .advice-list li {
            padding: 8px 0;
            padding-left: 20px;
            position: relative;
            color: #cccccc;
            font-size: 14px;
        }

        .advice-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #00ff00;
            font-weight: bold;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .goals-grid {
                grid-template-columns: 1fr;
            }
            
            .goal-label-full {
                padding: 20px;
            }
            
            .goal-icon-large {
                font-size: 40px;
            }
            
            .goal-title-large {
                font-size: 20px;
            }
        }

        /* === RESPONSIVE GOALS === */
        @media (max-width: 640px) {
            /* Titre */
            h2.text-4xl {
                font-size: 2rem !important;
                text-align: center !important;
            }
            
            .current-goal-indicator {
                margin-bottom: 24px !important;
            }
            
            .goal-badge-content {
                flex-direction: column !important;
                gap: 12px !important;
            }
            
            .goal-icon {
                font-size: 24px !important;
            }

            /* Grille des objectifs - 1 colonne */
            .goals-grid {
                grid-template-columns: 1fr !important;
                gap: 16px !important;
            }
            
            .goal-label-full {
                padding: 16px !important;
            }
            
            .goal-icon-large {
                font-size: 32px !important;
            }
            
            .goal-title-large {
                font-size: 18px !important;
            }
            
            .goal-description {
                font-size: 12px !important;
            }

            /* Cartes d'info - 1 colonne */
            .info-cards-grid {
                grid-template-columns: 1fr !important;
                gap: 16px !important;
            }
            
            .info-card-header {
                padding: 16px !important;
            }
            
            .info-card-content {
                padding: 16px !important;
            }
            
            .advice-list li {
                font-size: 12px !important;
            }
        }
    </style>
@endsection