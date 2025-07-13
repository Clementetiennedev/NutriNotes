# 🥗 NutriNotes

Une application moderne de suivi nutritionnel développée avec Laravel.

## 🌐 **DEMO LIVE** 
**✨ Application déployée : http://82.112.255.241**

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.4+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/Status-LIVE-brightgreen.svg" alt="Status">
  <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License">
</p>

## ✨ Fonctionnalités

- 📊 **Dashboard interactif** avec statistiques en temps réel
- 📈 **Suivi des calories, poids et activité physique**
- 🎯 **Gestion d'objectifs personnalisés**
- 📱 **Interface responsive et moderne**
- 🔐 **Authentification sécurisée**
- 🎨 **Design moderne avec animations fluides**
- 🌙 **Thème sombre élégant**
- 📋 **Pages d'erreur personnalisées**

## 🚀 Technologies utilisées

- **Backend** : Laravel 10
- **Frontend** : Blade Templates + TailwindCSS
- **Base de données** : SQLite
- **Authentification** : Laravel Auth
- **Charts** : Chart.js
- **Icons** : Heroicons (SVG)

## 📦 Installation

### Prérequis
- PHP 8.1+
- Composer
- SQLite3

### Installation locale

```bash
# Cloner le projet
git clone https://github.com/TON-USERNAME/NutriNotes.git
cd NutriNotes

# Installer les dépendances
composer install

# Copier le fichier d'environnement
cp .env.example .env

# Générer la clé d'application
php artisan key:generate

# Créer la base de données SQLite
touch database/database.sqlite

# Migrer la base de données
php artisan migrate

# Optimiser pour le développement
php artisan config:cache

# Lancer le serveur de développement
php artisan serve
```

L'application sera accessible sur `http://localhost:8000`

## 🎯 Fonctionnalités principales

### 🏠 Page d'accueil
- Formulaires de connexion/inscription stylisés
- Animations fluides et particules d'arrière-plan
- Messages d'erreur élégants

### 📊 Dashboard
- Vue d'ensemble des statistiques
- Graphiques interactifs (Chart.js)
- Suivi des tendances sur différentes périodes
- Cartes de statistiques animées

### 📈 Gestion des statistiques
- Ajout de données nutritionnelles
- Historique complet avec pagination
- Filtres par période (7j, 1m, 3m, 1an)
- Calculs automatiques de moyennes

### 🎯 Objectifs
- Définition d'objectifs personnalisés
- Suivi des progrès en temps réel
- Interface intuitive de mise à jour

### 🔐 Authentification
- Système de connexion/inscription sécurisé
- Middleware de protection des routes
- Redirections intelligentes
- Messages flash stylisés

### 🚫 Gestion d'erreurs
- Pages 404/405 personnalisées
- Design cohérent avec l'application
- Boutons de navigation intelligents

## 📁 Structure du projet

```
NutriNotes/
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/
│   │   ├── DashboardController.php
│   │   ├── StatsController.php
│   │   └── GoalsController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Stat.php
│   │   └── Goal.php
│   └── Http/Middleware/
│       └── Authenticate.php
├── resources/views/
│   ├── errors/
│   │   ├── 404.blade.php
│   │   └── 405.blade.php
│   ├── layouts/
│   │   └── app.blade.php
│   ├── dashboard.blade.php
│   ├── stats/
│   └── welcome.blade.php
└── database/
    ├── migrations/
    └── database.sqlite
```

## 🎨 Design System

### Couleurs principales
- **Primary Red** : `#bf0000` → `#ff0000`
- **Background** : `#2a2a2a` → `#3b3b3b`
- **Text** : `#ffffff`, `#cccccc`
- **Accent Blue** : `#4facfe` → `#00f2fe`

### Animations
- Fade-in, slide-up, bounce-in
- Hover effects avec élévation
- Particules flottantes
- Transitions fluides

## 🛠️ Déploiement

### Préparation pour la production

```bash
# Optimisations Laravel
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Variables d'environnement de production

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ton-domaine.com
DB_CONNECTION=sqlite
DB_DATABASE=/chemin/vers/database.sqlite
```

### Déploiement VPS

1. **Prérequis serveur**
   - PHP 8.1+ avec extensions
   - Nginx ou Apache
   - Composer
   - SSL (Let's Encrypt)

2. **Clone et configuration**
   ```bash
   git clone https://github.com/TON-USERNAME/NutriNotes.git
   cd NutriNotes
   composer install --no-dev
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --force
   ```

3. **Permissions**
   ```bash
   chown -R www-data:www-data .
   chmod -R 775 storage bootstrap/cache
   ```

## 🔧 Commandes utiles

```bash
# Développement
php artisan serve          # Lancer le serveur local
php artisan migrate:fresh  # Reset complet de la DB
php artisan tinker         # Console interactive

# Production
./deploy.sh                # Script de déploiement
php artisan optimize       # Cache global
```

## 📊 Base de données

### Tables principales
- **users** : Utilisateurs
- **stats** : Données nutritionnelles quotidiennes
- **goals** : Objectifs personnalisés

### Exemple de données
```sql
-- Voir les statistiques
SELECT * FROM stats WHERE user_id = 1 ORDER BY date DESC LIMIT 10;

-- Calculer la moyenne des calories
SELECT AVG(calories) FROM stats WHERE user_id = 1;
```

## 🤝 Contribution

1. Fork le projet
2. Crée une branche (`git checkout -b feature/nouvelle-fonctionnalite`)
3. Commit tes changements (`git commit -m 'Ajout nouvelle fonctionnalité'`)
4. Push la branche (`git push origin feature/nouvelle-fonctionnalite`)
5. Ouvre une Pull Request

## 📝 Licence

Ce projet est sous licence MIT.

## 👨‍💻 Auteur

Développé avec ❤️ par **Clément**

---

<p align="center">
  <i>NutriNotes - Ton compagnon nutrition quotidien 🥗</i>
</p>
