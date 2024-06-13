![Laravel](https://laravel.com/img/logotype.min.svg)

# Documentation du Projet

## Introduction

Bienvenue dans la documentation de notre projet. Ce document fournit des informations détaillées sur les technologies utilisées, les étapes d'installation, la structure du projet, et bien plus encore.

## Technologies Utilisées

Ce projet utilise une combinaison de technologies modernes pour assurer une application web robuste, scalable et maintenable. Voici un aperçu des principales technologies et outils utilisés :

### Frameworks et Plateformes

- **Laravel**: Un framework PHP moderne et élégant pour le développement web. Laravel facilite la gestion de la base de données, la routage des URL, l'authentification des utilisateurs et bien plus encore.
- **Filament**: Un framework d'administration pour Laravel qui permet de créer rapidement des interfaces d'administration puissantes et élégantes. Il simplifie la gestion des données grâce à ses ressources CRUD, widgets et actions personnalisées.

### Conteneurisation

- **Docker**: Docker est utilisé pour contenir l'application et ses dépendances, assurant ainsi un environnement de développement cohérent. Docker Compose est utilisé pour définir et orchestrer les différents services de l'application (base de données, serveur web, etc.).

### Gestion des Dépendances

- **Composer**: Utilisé pour gérer les dépendances PHP du projet. Il permet d'installer et de mettre à jour facilement les bibliothèques nécessaires.
- **Node.js et npm**: Node.js est utilisé comme environnement d'exécution pour les outils de développement front-end, tandis que npm gère les packages JavaScript. Cela inclut des outils comme Laravel Mix pour compiler les assets front-end.

### Base de Données

- **PostgreSQL (Pgsql)**: PostgreSQL est choisi comme système de gestion de base de données relationnelle pour sa robustesse, ses performances et ses fonctionnalités avancées.

## Fonctionnalités

- **Gestion des Utilisateurs**: Système complet d'authentification et de gestion des utilisateurs.
- **CRUD pour Mandats**: Interface pour créer, lire, mettre à jour et supprimer des mandats.
- **Widgets Statistiques**: Affichage des statistiques sur les mandats et les utilisateurs.
- **Filtrage Avancé**: Filtres pour rechercher et trier les mandats par différents critères.
- **Support Multilingue**: Interface disponible en plusieurs langues.
- **Responsive Design**: Adaptabilité de l'interface pour différents appareils (desktop, tablette, mobile).

## Installation

### Prérequis

- **PHP**: Version 7.4 ou supérieure.
- **Composer**: Version 2.0 ou supérieure.
- **Node.js**: Version 14.0 ou supérieure.
- **npm**: Version 6.0 ou supérieure.
- **Docker**: Version 20.x ou supérieure.

### Étapes d'Installation

1. Clonez le dépôt du projet :
   ```bash
   git clone https://github.com/Bilaljanir/briefs
   


## Installez les dépendances PHP :

    composer install

## Installez les dépendances JavaScript :

    npm install

## Configurez votre fichier d'environnement :

        .env
## Démarrez Docker Compose :

    docker-compose up -d

## Exécutez les migrations et les seeders :

    sail artisan migrate --seed


## Compilez les assets front-end :

    npm run dev

## Démarrez les services Docker avec Laravel Sail :

    ./vendor/bin/sail up -d

