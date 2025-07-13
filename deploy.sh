#!/bin/bash
echo "🚀 Déploiement de NutriNotes..."

# Optimisations Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Installation optimisée
composer install --optimize-autoloader --no-dev

echo "✅ Projet prêt pour la production !"

