# Fiche de Notes Laravel 12 - API Backend

## Configuration Initiale

### Bootstrap Configuration (bootstrap/app.php)
```php
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        // Ajouter cette ligne pour activer les routes API
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // les alias
        $middleware->alias([
            'check.manager' => \App\Http\Middleware\CheckManager::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
```

## Routes API (routes/api.php)

### Structure d'une route
Une route API est composée de :
- **prefix** : préfixe d'URL
- **middleware** : sécurité et authentification
- **group** : regroupement logique
- **name** : nom de la route
- **méthodes HTTP** : GET, POST, PUT, DELETE

### Exemple de structure complète
```php
Route::prefix('v1')->group(function () {

    // Routes d'authentification
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });

    // Routes protégées par authentification
    Route::middleware('auth:sanctum')->group(function () {
        
        // Équipes
        Route::prefix('teams')->group(function () {
            Route::get('/', [EquipeController::class, 'index']);
            Route::post('/', [EquipeController::class, 'store']);
            Route::get('{id}', [EquipeController::class, 'show']);
            Route::put('{id}', [EquipeController::class, 'update']);
            Route::delete('{id}', [EquipeController::class, 'destroy']);
        });
        
        // Routes avec noms
        Route::get('profile', [UserController::class, 'profile'])->name('api.profile');
    });
});
```

## Migrations

### Commandes de création
```bash
# Créer un modèle avec migration
php artisan make:model Model -m

# Migration de modification
php artisan make:migration alter_model_table_add_columns --table=models

# Créer migration spécifique
php artisan make:migration create_teams_table
```

### Types de colonnes courantes
```php
public function up()
{
    Schema::create('teams', function (Blueprint $table) {
        $table->id();
        $table->uuid('uid')->unique();
        $table->foreignId('utilisateur_id')->constrained('users');
        $table->enum('role', ['manager', 'developer', 'designer', 'tester']);
        $table->string('name', 100);
        $table->string('last_name', 50);
        $table->timestamp('joined_at')->nullable();
        $table->dateTime('created_date');
        $table->text('description');
        $table->boolean('is_active')->default(false);
        $table->decimal('price', 8, 2)->default(0.00);
        $table->integer('age')->nullable();
        $table->json('metadata')->nullable();
        $table->timestamps();
        
        // Index
        $table->index(['status']);
        $table->index(['created_at', 'status']);
    });
}

// Méthode down importante pour rollback
public function down()
{
    Schema::dropIfExists('teams');
}
```

### Commandes de migration
```bash
# Exécuter les migrations
php artisan migrate

# Vider la DB et refaire toutes les migrations
php artisan migrate:fresh

# Avec seeding
php artisan migrate:fresh --seed

# Revenir en arrière (rollback)
php artisan migrate:rollback

# Rollback avec nombre spécifique
php artisan migrate:rollback --step=3

# Refresh (rollback all + migrate)
php artisan migrate:refresh --seed
```

## Models

### Structure de base
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable; // Pour User model

class Team extends Model // ou extends Authenticatable pour User
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'teams'; // optionnel si suit convention
    
    // Colonnes modifiables en masse
    protected $fillable = [
        'name',
        'description',
        'utilisateur_id',
        'role',
        'is_active'
    ];

    // Colonnes cachées dans JSON
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    // Cast de types
    protected $casts = [
        'joined_at' => 'datetime',
        'is_active' => 'boolean',
        'metadata' => 'array',
        'price' => 'decimal:2',
        'password' => 'hashed', // Laravel 10+
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class, 'utilisateur_id'); // FK optionnelle
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Relation many-to-many
    public function members()
    {
        return $this->belongsToMany(
            User::class,
            'team_members', // table pivot
            'team_id',      // clé pivot
            'user_id'       // clé pivot associée
        )->withTimestamps()->withPivot('role', 'joined_at');
    }
}
```

## Factories

### Création et structure
```bash
# Créer une factory
php artisan make:factory TeamFactory
```

```php
<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'utilisateur_id' => User::factory(),
            'role' => $this->faker->randomElement(['manager', 'developer', 'designer', 'tester']),
            'is_active' => $this->faker->boolean(80), // 80% true
            'joined_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'price' => $this->faker->randomFloat(2, 100, 5000),
        ];
    }

    // États spécifiques
    public function inactive()
    {
        return $this->state([
            'is_active' => false,
        ]);
    }

    public function manager()
    {
        return $this->state([
            'role' => 'manager',
        ]);
    }
}
```

## Seeders

### Création et utilisation
```bash
# Créer un seeder
php artisan make:seeder TeamSeeder
```

```php
<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run()
    {
        // Vider la table (optionnel)
        Team::truncate();

        // Créer plusieurs enregistrements
        Team::factory()->count(10)->create();

        // Créer avec données spécifiques
        Team::factory()->create([
            'name' => 'Équipe Admin',
            'role' => 'manager',
            'is_active' => true,
        ]);

        // Créer avec états
        Team::factory()->inactive()->count(3)->create();
    }
}
```

### DatabaseSeeder principal
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            TeamSeeder::class,
            ProjectSeeder::class,
        ]);
    }
}
```

### Commandes de seeding
```bash
# Lancer tous les seeders
php artisan db:seed

# Lancer un seeder spécifique
php artisan db:seed --class=TeamSeeder

# Vider et seeder
php artisan migrate:fresh --seed
```

## Authentification avec Sanctum

### Configuration
```bash
# Installer Sanctum
composer require laravel/sanctum

# Publier la configuration
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

# Migrer
php artisan migrate
```

### AuthController
```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Connexion utilisateur
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['Les identifiants fournis sont incorrects.'],
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Connexion réussie',
            'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }

    /**
     * Déconnexion utilisateur
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Déconnexion réussie'
        ]);
    }

    /**
     * Récupérer les informations de l'utilisateur connecté
     */
    public function user(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Utilisateur récupéré avec succès',
            'data' => [
                'user' => $request->user()
            ]
        ]);
    }
}
```

## Commandes Utiles

```bash
# Créer un middleware
php artisan make:middleware CheckUserStatus

# Créer un contrôleur API
php artisan make:controller Api/TeamController --api

# Créer une resource
php artisan make:resource TeamResource

# Créer une request
php artisan make:request StoreTeamRequest

# Voir les routes
php artisan route:list

# Nettoyer le cache
php artisan optimize:clear

# Générer la clé d'application
php artisan key:generate
```

## Bonnes Pratiques

1. **Versioning** : Toujours préfixer avec une version (`v1`, `v2`)
2. **Middleware** : Utiliser `auth:sanctum` pour les routes protégées
3. **Validation** : Valider toutes les entrées utilisateur
4. **Resources** : Utiliser les Resources pour formater les réponses
5. **Pagination** : Paginer les listes longues
6. **Status codes** : Utiliser les codes HTTP appropriés
7. **Rollback** : Toujours définir la méthode `down()` dans les migrations

8 . Enums et Services
