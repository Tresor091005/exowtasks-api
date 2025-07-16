# ExowTasks API

API REST pour la gestion des équipes, membres et tâches développée avec Laravel 12 et PostgreSQL.

## 📋 Table des matières

- [Prérequis](#prérequis)
- [Installation](#installation)
- [Configuration](#configuration)
- [Base de données](#base-de-données)
- [Démarrage](#démarrage)
- [Documentation API](#documentation-api)
- [Authentification](#authentification)
- [Import Postman](#import-postman)
- [Notes importantes](#notes-importantes)

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- PostgreSQL 13 ou supérieur

## Installation

### 1. Cloner le projet

```bash
git clone https://github.com/Tresor091005/exowtasks-api.git
cd exowtasks-api
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configurer l'environnement

```bash
cp .env.example .env
php artisan key:generate
```

## Configuration

Modifiez le fichier `.env` avec vos paramètres :

```env
APP_NAME="ExowTasks API"
APP_ENV=local
APP_KEY=base64:votre_clé_générée
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=exowtasks
DB_USERNAME=votre_username
DB_PASSWORD=votre_password
```

## Base de données

### 1. Créer la base de données PostgreSQL

```sql
-- Connexion à PostgreSQL
psql -U postgres

-- Créer la base de données
CREATE DATABASE exowtasks;

-- Créer un utilisateur
CREATE USER votre_username WITH PASSWORD 'votre_password';

GRANT ALL PRIVILEGES ON DATABASE exowtasks TO votre_username;
```

### 2. Exécuter les migrations et remplir avec des données de test

```bash
php artisan migrate:fresh --seed
```

## Démarrage

```bash
php artisan serve
```

L'API sera accessible à l'adresse : `http://127.0.0.1:8000`

## Documentation API

### Base URL
```
http://127.0.0.1:8000/api/v1
```

### Authentification

#### POST /auth/login
Connexion utilisateur

#### GET /auth/user
Informations utilisateur connecté (nécessite authentification)

#### POST /auth/logout
Déconnexion (nécessite authentification)

### Équipes

#### GET /teams
Liste des équipes avec filtre optionnel

**Paramètres de requête :**
- `name` : Filtrer par nom d'équipe

#### POST /teams *(Manager uniquement)*
Créer une équipe

**Body :**
```json
{
    "name": "Mon équipe"
}
```

#### GET /teams/{id}
Afficher une équipe spécifique

#### PUT /teams/{id} *(Manager uniquement)*
Mettre à jour une équipe

**Body :**
```json
{
    "name": "Nouveau nom"
}
```

#### DELETE /teams/{id} *(Manager uniquement)*
Supprimer une équipe (suppression en cascade)

### Membres

#### GET /members
Liste des membres avec filtres optionnels

**Paramètres de requête :**
- `role` : Filtrer par rôle (manager, developer, designer, tester)
- `team_id` : Filtrer par équipe
- `name` : Filtrer par nom ou prénom
- `email` : Filtrer par email
- `joined_before` : Membres rejoints avant cette date
- `joined_after` : Membres rejoints après cette date
- `joined_at` : Membres rejoints à cette date
- `sort_by` : Colonne de tri (first_name, last_name, etc.)
- `sort_direction` : Direction du tri (asc, desc)

#### POST /members *(Manager uniquement)*
Créer un membre

**Body :**
```json
{
    "first_name": "John",
    "last_name": "Doe",
    "email": "john@example.com",
    "role": "developer",
    "team_id": 1
}
```

#### GET /members/{id}
Afficher un membre spécifique

#### PUT /members/{id}
Mettre à jour un membre (le membre peut modifier ses propres informations)

**Body :**
```json
{
    "first_name": "John",
    "last_name": "Doe",
    "email": "john@example.com",
    "password": "nouveau_password"
}
```

#### DELETE /members/{id} *(Manager uniquement)*
Supprimer un membre

### Tâches

#### GET /tasks
Liste des tâches avec filtres optionnels

**Paramètres de requête :**
- `status` : Filtrer par statut (todo, in_progress, done)
- `member_id` : Filtrer par membre assigné
- `due_date` : Filtrer par date limite
- `due_before` : Tâches dues avant cette date
- `due_after` : Tâches dues après cette date
- `created_by` : Filtrer par créateur
- `sort_by` : Trier par (title, due_date, status)
- `sort_direction` : Direction du tri (asc, desc)

#### POST /tasks *(Manager uniquement)*
Créer une tâche

**Body :**
```json
{
    "title": "Nouvelle tâche",
    "description": "Description de la tâche",
    "status": "todo",
    "due_date": "2025-08-15",
    "created_by": 1,
    "assigned_members": [1, 2, 3]
}
```

#### GET /tasks/{id}
Afficher une tâche spécifique

#### PUT /tasks/{id}
Mettre à jour une tâche (créateur et membres assignés)

**Body :**
```json
{
    "title": "Titre modifié",
    "description": "Description modifiée",
    "status": "in_progress",
    "due_date": "2025-08-20"
}
```

#### DELETE /tasks/{id} *(Manager uniquement)*
Supprimer une tâche

#### POST /tasks/{id}/assign *(Manager uniquement)*
Assigner des membres à une tâche

**Body :**
```json
{
    "member_ids": [1, 2, 3]
}
```

#### DELETE /tasks/{id}/unassign *(Manager uniquement)*
Désassigner des membres d'une tâche

**Body :**
```json
{
    "member_ids": [1, 2]
}
```

## Authentification

L'API utilise Laravel Sanctum pour l'authentification. Après la connexion, utilisez le token Bearer dans l'en-tête Authorization :

```
Authorization: Bearer 1|abc123...
```

## Import Postman

Une collection Postman est disponible dans le fichier `ExowTasks.postman_collection.json` pour tester l'API.

Variables à configurer :
- `base_url` : `127.0.0.1:8000`
- `token` : Sera fourni après connexion

## Notes importantes

- La suppression d'une équipe supprime automatiquement ses membres et leurs tâches (cascade)
- Les managers peuvent modifier les informations de toutes les équipes
- Tous les utilisateurs peuvent voir les tâches des autres équipes
- Les slugs d'équipes sont générés automatiquement à partir du nom
- Les fichiers `ExowTasks.postman_collection.json` et `exowtasks.pgsql` sont disponibles à la racine du projet

---

*Développé avec Laravel 12 et PostgreSQL*
