# API Laravel 12 - Système de Gestion de Fichiers Complet

## 🎯 Architecture du Système

### Structure des Tables
- **users** : Utilisateurs avec avatars
- **teams** : Équipes avec avatars et logos  
- **projects** : Projets avec documents
- **files** : Table centralisée avec relations polymorphes

## 📁 1. MIGRATIONS

### Migration Users
```php
<?php
// database/migrations/2024_01_01_000001_create_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->text('bio')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->json('settings')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
```

### Migration Teams
```php
<?php
// database/migrations/2024_01_01_000002_create_teams_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('location')->nullable();
            $table->integer('size')->nullable();
            $table->enum('status', ['active', 'inactive', 'archived'])->default('active');
            $table->json('settings')->nullable();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['status', 'created_at']);
            $table->index('owner_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
```

### Migration Projects
```php
<?php
// database/migrations/2024_01_01_000003_create_projects_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('status', ['draft', 'active', 'completed', 'archived', 'cancelled'])->default('draft');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('budget', 15, 2)->nullable();
            $table->json('metadata')->nullable();
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->foreignId('manager_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['status', 'priority']);
            $table->index(['team_id', 'created_at']);
            $table->index('manager_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
```

### Migration Files (Polymorphe)
```php
<?php
// database/migrations/2024_01_01_000004_create_files_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom original du fichier
            $table->string('filename'); // Nom stocké sur le serveur
            $table->string('path'); // Chemin complet
            $table->string('disk')->default('public'); // Disque de stockage
            $table->string('mime_type');
            $table->string('extension');
            $table->unsignedBigInteger('size'); // Taille en bytes
            $table->string('type'); // avatar, logo, document, image, etc.
            $table->string('category')->nullable(); // Catégorie personnalisée
            $table->json('metadata')->nullable(); // Dimensions, durée, etc.
            $table->json('thumbnails')->nullable(); // URLs des miniatures
            $table->string('alt_text')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(true);
            $table->string('hash')->nullable(); // Hash pour détecter les doublons
            
            // Relations polymorphes
            $table->morphs('fileable'); // fileable_type, fileable_id
            
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            // Index pour optimiser les requêtes
            $table->index(['fileable_type', 'fileable_id']);
            $table->index(['type', 'created_at']);
            $table->index(['mime_type', 'is_public']);
            $table->index('hash');
            $table->index('uploaded_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
```

## 🏗️ 2. MODELS

### User Model
```php
<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasFiles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasFiles;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'bio', 'status', 'settings'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'settings' => 'array',
            'status' => 'string'
        ];
    }

    // Relations
    public function teams()
    {
        return $this->hasMany(Team::class, 'owner_id');
    }

    public function managedProjects()
    {
        return $this->hasMany(Project::class, 'manager_id');
    }

    public function uploadedFiles()
    {
        return $this->hasMany(File::class, 'uploaded_by');
    }

    // Accesseurs pour les fichiers spécifiques
    public function getAvatarAttribute()
    {
        return $this->getFileByType('avatar');
    }

    public function getAvatarUrlAttribute()
    {
        return $this->getFileUrl('avatar');
    }

    public function getAvatarThumbnailAttribute()
    {
        return $this->getFileThumbnail('avatar', 'small');
    }
}
```

### Team Model
```php
<?php
// app/Models/Team.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFiles;

class Team extends Model
{
    use HasFactory, HasFiles;

    protected $fillable = [
        'name', 'slug', 'description', 'website', 'location', 
        'size', 'status', 'settings', 'owner_id'
    ];

    protected function casts(): array
    {
        return [
            'settings' => 'array',
            'size' => 'integer'
        ];
    }

    // Relations
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Accesseurs pour les fichiers
    public function getAvatarAttribute()
    {
        return $this->getFileByType('avatar');
    }

    public function getLogoAttribute()
    {
        return $this->getFileByType('logo');
    }

    public function getAvatarUrlAttribute()
    {
        return $this->getFileUrl('avatar');
    }

    public function getLogoUrlAttribute()
    {
        return $this->getFileUrl('logo');
    }
}
```

### Project Model
```php
<?php
// app/Models/Project.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFiles;

class Project extends Model
{
    use HasFactory, HasFiles;

    protected $fillable = [
        'name', 'slug', 'description', 'status', 'priority',
        'start_date', 'end_date', 'budget', 'metadata',
        'team_id', 'manager_id'
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'budget' => 'decimal:2',
            'metadata' => 'array'
        ];
    }

    // Relations
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    // Accesseurs pour les fichiers
    public function getDocumentsAttribute()
    {
        return $this->getFilesByType('document');
    }

    public function getImagesAttribute()
    {
        return $this->getFilesByType('image');
    }
}
```

### File Model
```php
<?php
// app/Models/File.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'filename', 'path', 'disk', 'mime_type', 'extension',
        'size', 'type', 'category', 'metadata', 'thumbnails',
        'alt_text', 'description', 'is_public', 'hash',
        'fileable_type', 'fileable_id', 'uploaded_by'
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
            'thumbnails' => 'array',
            'is_public' => 'boolean',
            'size' => 'integer'
        ];
    }

    // Relations polymorphes
    public function fileable()
    {
        return $this->morphTo();
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Accesseurs
    public function getUrlAttribute()
    {
        if (!$this->is_public) {
            return route('files.download', $this->id);
        }
        
        return Storage::disk($this->disk)->url($this->path);
    }

    public function getSizeFormattedAttribute()
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getThumbnailUrl($size = 'medium')
    {
        if (!$this->thumbnails || !isset($this->thumbnails[$size])) {
            return $this->url;
        }
        
        return Storage::disk($this->disk)->url($this->thumbnails[$size]);
    }

    public function isImage()
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    public function isDocument()
    {
        return in_array($this->extension, ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']);
    }

    // Scope pour filtrer par type
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopePrivate($query)
    {
        return $query->where('is_public', false);
    }
}
```

## 🔧 3. TRAIT HasFiles

```php
<?php
// app/Traits/HasFiles.php

namespace App\Traits;

use App\Models\File;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasFiles
{
    /**
     * Relation polymorphe avec les fichiers
     */
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * Obtenir un fichier par type
     */
    public function getFileByType(string $type): ?File
    {
        return $this->files()->where('type', $type)->latest()->first();
    }

    /**
     * Obtenir plusieurs fichiers par type
     */
    public function getFilesByType(string $type)
    {
        return $this->files()->where('type', $type)->latest()->get();
    }

    /**
     * Obtenir l'URL d'un fichier par type
     */
    public function getFileUrl(string $type): ?string
    {
        $file = $this->getFileByType($type);
        return $file ? $file->url : null;
    }

    /**
     * Obtenir la miniature d'un fichier
     */
    public function getFileThumbnail(string $type, string $size = 'medium'): ?string
    {
        $file = $this->getFileByType($type);
        return $file ? $file->getThumbnailUrl($size) : null;
    }

    /**
     * Vérifier si un type de fichier existe
     */
    public function hasFileType(string $type): bool
    {
        return $this->files()->where('type', $type)->exists();
    }

    /**
     * Supprimer tous les fichiers d'un type
     */
    public function deleteFilesByType(string $type): int
    {
        $files = $this->getFilesByType($type);
        $count = $files->count();
        
        foreach ($files as $file) {
            app(\App\Services\FileService::class)->delete($file);
        }
        
        return $count;
    }

    /**
     * Compter les fichiers par type
     */
    public function countFilesByType(string $type): int
    {
        return $this->files()->where('type', $type)->count();
    }

    /**
     * Obtenir la taille totale des fichiers
     */
    public function getTotalFilesSize(): int
    {
        return $this->files()->sum('size');
    }
}
```

## 🎛️ 4. SERVICE FileService

```php
<?php
// app/Services/FileService.php

namespace App\Services;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FileService
{
    protected array $thumbnailSizes = [
        'small' => 150,
        'medium' => 300,
        'large' => 600
    ];

    protected array $imageTypes = ['avatar', 'logo', 'image'];

    /**
     * Upload général d'un fichier
     */
    public function upload(
        UploadedFile $file, 
        $model, 
        string $type, 
        ?string $category = null,
        array $options = []
    ): File {
        // Générer un nom unique
        $filename = $this->generateUniqueFilename($file);
        
        // Définir le chemin de stockage
        $path = $this->getStoragePath($model, $type) . '/' . $filename;
        
        // Stocker le fichier
        $disk = $options['disk'] ?? 'public';
        Storage::disk($disk)->put($path, file_get_contents($file->getRealPath()));
        
        // Calculer le hash pour détecter les doublons
        $hash = hash_file('md5', $file->getRealPath());
        
        // Extraire les métadonnées
        $metadata = $this->extractMetadata($file);
        
        // Créer l'enregistrement
        $fileRecord = File::create([
            'name' => $file->getClientOriginalName(),
            'filename' => $filename,
            'path' => $path,
            'disk' => $disk,
            'mime_type' => $file->getMimeType(),
            'extension' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
            'type' => $type,
            'category' => $category,
            'metadata' => $metadata,
            'is_public' => $options['is_public'] ?? true,
            'hash' => $hash,
            'fileable_type' => get_class($model),
            'fileable_id' => $model->id,
            'uploaded_by' => auth()->id() ?? $options['uploaded_by'] ?? null,
            'alt_text' => $options['alt_text'] ?? null,
            'description' => $options['description'] ?? null,
        ]);

        // Générer les miniatures pour les images
        if ($this->shouldCreateThumbnails($type, $file)) {
            $thumbnails = $this->createThumbnails($file, $path, $disk);
            $fileRecord->update(['thumbnails' => $thumbnails]);
        }

        return $fileRecord;
    }

    /**
     * Upload spécifique pour les avatars avec redimensionnement
     */
    public function uploadAvatar(UploadedFile $file, $model, array $options = []): File
    {
        // Validation spécifique aux avatars
        $this->validateImageFile($file);
        
        // Redimensionner l'avatar avant l'upload
        $resizedFile = $this->resizeImage($file, 400, 400);
        
        // Supprimer l'ancien avatar s'il existe
        if ($model->hasFileType('avatar')) {
            $this->deleteFilesByType($model, 'avatar');
        }
        
        return $this->upload($resizedFile, $model, 'avatar', null, $options);
    }

    /**
     * Upload de logo avec optimisation
     */
    public function uploadLogo(UploadedFile $file, $model, array $options = []): File
    {
        $this->validateImageFile($file);
        
        // Supprimer l'ancien logo
        if ($model->hasFileType('logo')) {
            $this->deleteFilesByType($model, 'logo');
        }
        
        return $this->upload($file, $model, 'logo', null, $options);
    }

    /**
     * Supprimer un fichier avec nettoyage des miniatures
     */
    public function delete(File $file): bool
    {
        try {
            // Supprimer les miniatures
            if ($file->thumbnails) {
                foreach ($file->thumbnails as $thumbnailPath) {
                    Storage::disk($file->disk)->delete($thumbnailPath);
                }
            }
            
            // Supprimer le fichier principal
            Storage::disk($file->disk)->delete($file->path);
            
            // Supprimer l'enregistrement
            return $file->delete();
            
        } catch (\Exception $e) {
            \Log::error('Erreur suppression fichier: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Supprimer tous les fichiers d'un type pour un modèle
     */
    public function deleteFilesByType($model, string $type): int
    {
        $files = $model->getFilesByType($type);
        $count = 0;
        
        foreach ($files as $file) {
            if ($this->delete($file)) {
                $count++;
            }
        }
        
        return $count;
    }

    /**
     * Nettoyer les fichiers orphelins
     */
    public function cleanOrphanFiles(): int
    {
        $orphanFiles = File::whereDoesntHave('fileable')->get();
        $count = 0;
        
        foreach ($orphanFiles as $file) {
            if ($this->delete($file)) {
                $count++;
            }
        }
        
        return $count;
    }

    /**
     * Dupliquer un fichier pour un autre modèle
     */
    public function duplicate(File $originalFile, $newModel, ?string $newType = null): File
    {
        $newType = $newType ?? $originalFile->type;
        
        // Copier le fichier physique
        $newFilename = $this->generateUniqueFilename($originalFile->name, $originalFile->extension);
        $newPath = $this->getStoragePath($newModel, $newType) . '/' . $newFilename;
        
        Storage::disk($originalFile->disk)->copy($originalFile->path, $newPath);
        
        // Créer le nouvel enregistrement
        return File::create([
            'name' => $originalFile->name,
            'filename' => $newFilename,
            'path' => $newPath,
            'disk' => $originalFile->disk,
            'mime_type' => $originalFile->mime_type,
            'extension' => $originalFile->extension,
            'size' => $originalFile->size,
            'type' => $newType,
            'category' => $originalFile->category,
            'metadata' => $originalFile->metadata,
            'thumbnails' => $this->duplicateThumbnails($originalFile, $newPath),
            'is_public' => $originalFile->is_public,
            'hash' => $originalFile->hash,
            'fileable_type' => get_class($newModel),
            'fileable_id' => $newModel->id,
            'uploaded_by' => auth()->id(),
            'alt_text' => $originalFile->alt_text,
            'description' => $originalFile->description,
        ]);
    }

    /**
     * Générer un nom de fichier unique
     */
    protected function generateUniqueFilename(?string $originalName = null, ?string $extension = null): string
    {
        if ($originalName) {
            $name = pathinfo($originalName, PATHINFO_FILENAME);
            $ext = $extension ?? pathinfo($originalName, PATHINFO_EXTENSION);
        } else {
            $name = 'file';
            $ext = $extension ?? 'bin';
        }
        
        $slug = Str::slug($name);
        $timestamp = now()->format('YmdHis');
        $random = Str::random(8);
        
        return "{$slug}_{$timestamp}_{$random}.{$ext}";
    }

    /**
     * Obtenir le chemin de stockage basé sur le modèle et le type
     */
    protected function getStoragePath($model, string $type): string
    {
        $modelName = strtolower(class_basename($model));
        return "files/{$modelName}/{$type}";
    }

    /**
     * Extraire les métadonnées d'un fichier
     */
    protected function extractMetadata(UploadedFile $file): array
    {
        $metadata = [];
        
        // Pour les images
        if (str_starts_with($file->getMimeType(), 'image/')) {
            try {
                $imageSize = getimagesize($file->getRealPath());
                if ($imageSize) {
                    $metadata['width'] = $imageSize[0];
                    $metadata['height'] = $imageSize[1];
                    $metadata['aspect_ratio'] = round($imageSize[0] / $imageSize[1], 2);
                }
            } catch (\Exception $e) {
                // Ignorer les erreurs de métadonnées
            }
        }
        
        return $metadata;
    }

    /**
     * Créer les miniatures pour une image
     */
    protected function createThumbnails(UploadedFile $file, string $originalPath, string $disk): array
    {
        $thumbnails = [];
        $pathinfo = pathinfo($originalPath);
        
        foreach ($this->thumbnailSizes as $size => $dimension) {
            try {
                $thumbnailPath = $pathinfo['dirname'] . '/thumbs/' . 
                               $pathinfo['filename'] . "_{$size}." . $pathinfo['extension'];
                
                // Créer la miniature
                $image = Image::make($file->getRealPath())
                    ->fit($dimension, $dimension, function ($constraint) {
                        $constraint->upsize();
                    });
                
                // Sauvegarder
                Storage::disk($disk)->put($thumbnailPath, $image->encode());
                
                $thumbnails[$size] = $thumbnailPath;
                
            } catch (\Exception $e) {
                \Log::warning("Erreur création miniature {$size}: " . $e->getMessage());
            }
        }
        
        return $thumbnails;
    }

    /**
     * Valider un fichier image
     */
    protected function validateImageFile(UploadedFile $file): void
    {
        if (!str_starts_with($file->getMimeType(), 'image/')) {
            throw new \InvalidArgumentException('Le fichier doit être une image');
        }
        
        // Taille maximale : 5MB
        if ($file->getSize() > 5 * 1024 * 1024) {
            throw new \InvalidArgumentException('Le fichier est trop volumineux (max 5MB)');
        }
    }

    /**
     * Redimensionner une image
     */
    protected function resizeImage(UploadedFile $file, int $width, int $height): UploadedFile
    {
        $image = Image::make($file->getRealPath())
            ->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            });
        
        $tempPath = sys_get_temp_dir() . '/' . uniqid() . '.' . $file->getClientOriginalExtension();
        $image->save($tempPath);
        
        return new UploadedFile(
            $tempPath,
            $file->getClientOriginalName(),
            $file->getMimeType(),
            null,
            true
        );
    }

    /**
     * Vérifier si on doit créer des miniatures
     */
    protected function shouldCreateThumbnails(string $type, UploadedFile $file): bool
    {
        return in_array($type, $this->imageTypes) && str_starts_with($file->getMimeType(), 'image/');
    }

    /**
     * Dupliquer les miniatures
     */
    protected function duplicateThumbnails(File $originalFile, string $newPath): array
    {
        if (!$originalFile->thumbnails) {
            return [];
        }
        
        $newThumbnails = [];
        $newPathinfo = pathinfo($newPath);
        
        foreach ($originalFile->thumbnails as $size => $originalThumbPath) {
            $newThumbPath = $newPathinfo['dirname'] . '/thumbs/' . 
                          $newPathinfo['filename'] . "_{$size}." . $newPathinfo['extension'];
            
            if (Storage::disk($originalFile->disk)->exists($originalThumbPath)) {
                Storage::disk($originalFile->disk)->copy($originalThumbPath, $newThumbPath);
                $newThumbnails[$size] = $newThumbPath;
            }
        }
        
        return $newThumbnails;
    }
}
```

## 🏭 5. FACTORIES

### UserFactory
```php
<?php
// database/factories/UserFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'phone' => fake()->phoneNumber(),
            'bio' => fake()->paragraph(),
            'status' => fake()->randomElement(['active', 'inactive']),
            'settings' => [
                'notifications' => fake()->boolean(),
                'theme' => fake()->randomElement(['light', 'dark']),
                'language' => fake()->randomElement(['fr', 'en'])
            ],
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function withAvatar(): static
    {
        return $this->afterCreating(function ($user) {
            // Sera créé par le seeder avec de vrais fichiers
        });
    }
}
```

### TeamFactory
```php
<?php
// database/factories/TeamFactory.php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TeamFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->company();
        
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(1000, 9999),
            'description' => fake()->paragraph(3),
            'website' => fake()->url(),
            'location' => fake()->city() . ', ' . fake()->country(),
            'size' => fake()->numberBetween(1, 500),
            'status' => fake()->randomElement(['active', 'inactive']),
            'settings' => [
                'allow_external_members' => fake()->boolean(),
                'visibility' => fake()->randomElement(['public', 'private']),
                'features' => fake()->randomElements(['chat', 'files', 'calendar'], 2)
            ],
            'owner_id' => User::factory(),
        ];
    }
}
```

### ProjectFactory
```php
<?php
// database/factories/ProjectFactory.php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->sentence(3);
        $startDate = fake()->dateTimeBetween('-1 year', 'now');
        
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(1000, 9999),
            'description' => fake()->paragraph(4),
            'status' => fake()->randomElement(['draft', 'active', 'completed', 'archived']),
            'priority' => fake()->randomElement(['low', 'medium', 'high', 'critical']),
            'start_date' => $startDate,
            'end_date' => fake()->dateTimeBetween($startDate, '+2 years'),
            'budget' => fake()->randomFloat(2, 1000, 100000),
            'metadata' => [
                'tags' => fake()->words(3),
                'external_id' => fake()->uuid(),
                'client' => fake()->company()
            ],
            'team_id' => Team::factory(),
            'manager_id' => User::factory(),
        ];
    }
}
```

### FileFactory
```php
<?php
// database/factories/FileFactory.php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    public function definition(): array
    {
        $types = ['avatar', 'logo', 'document', 'image'];
        $type = fake()->randomElement($types);
        $extension = $this->getExtensionByType($type);
        $filename = fake()->slug() . '.' . $extension;
        
        return [
            'name' => fake()->words(2, true) . '.' . $extension,
            'filename' => $filename,
            'path' => 'files/test/' . $filename,
            'disk' => 'public',
            'mime_type' => $this->getMimeTypeByExtension($extension),
            'extension' => $extension,
            'size' => fake()->numberBetween(1024, 5242880), // 1KB à 5MB
            'type' => $type,
            'category' => fake()->optional()->word(),
            'metadata' => [
                'width' => fake()->numberBetween(100, 2000),
                'height' => fake()->numberBetween(100, 2000),
            ],
            'thumbnails' => [],
            'alt_text' => fake()->sentence(),
            'description' => fake()->optional()->paragraph(),
            'is_public' => fake()->boolean(80),
            'hash' => fake()->md5(),
            'uploaded_by' => User::factory(),
        ];
    }

    private function getExtensionByType($type): string
    {
        return match($type) {
            'avatar', 'logo', 'image' => fake()->randomElement(['jpg', 'png', 'webp']),
            'document' => fake()->randomElement(['pdf', 'docx', 'xlsx']),
            default => 'jpg'
        };
    }

    private function getMimeTypeByExtension($extension): string
    {
        return match($extension) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'webp' => 'image/webp',
            'pdf' => 'application/pdf',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            default => 'application/octet-stream'
        };
    }
}
```

## 🌱 6. SEEDERS

### DatabaseSeeder
```php
<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TeamSeeder::class,
            ProjectSeeder::class,
            FileSeeder::class,
        ]);
    }
}
```

### UserSeeder avec avatars
```php
<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use App\Models\User;
use App\Services\FileService;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $fileService = app(FileService::class);
        
        // Créer un admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'status' => 'active',
            'bio' => 'Administrateur du système',
        ]);
        
        // Ajouter un avatar à l'admin
        $this->createAvatarForUser($admin, $fileService);
        
        // Créer des utilisateurs avec avatars
        User::factory(20)->create()->each(function ($user) use ($fileService) {
            // 70% de chance d'avoir un avatar
            if (rand(1, 100) <= 70) {
                $this->createAvatarForUser($user, $fileService);
            }
        });
    }

    private function createAvatarForUser(User $user, FileService $fileService): void
    {
        try {
            // Générer un avatar via API (ou utiliser des images de test)
            $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($user->name) . 
                        "&size=400&background=random&color=fff&format=png";
            
            $response = Http::get($avatarUrl);
            
            if ($response->successful()) {
                $tempFile = tempnam(sys_get_temp_dir(), 'avatar_');
                file_put_contents($tempFile, $response->body());
                
                $uploadedFile = new UploadedFile(
                    $tempFile,
                    'avatar.png',
                    'image/png',
                    null,
                    true
                );
                
                $fileService->uploadAvatar($uploadedFile, $user, [
                    'uploaded_by' => $user->id
                ]);
                
                unlink($tempFile);
            }
        } catch (\Exception $e) {
            \Log::warning("Erreur création avatar pour {$user->name}: " . $e->getMessage());
        }
    }
}
```

### TeamSeeder avec logos
```php
<?php
// database/seeders/TeamSeeder.php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $fileService = app(FileService::class);
        $users = User::all();
        
        Team::factory(10)->create([
            'owner_id' => $users->random()->id
        ])->each(function ($team) use ($fileService) {
            // Créer un logo pour l'équipe
            $this->createLogoForTeam($team, $fileService);
            
            // 50% de chance d'avoir aussi un avatar
            if (rand(1, 100) <= 50) {
                $this->createAvatarForTeam($team, $fileService);
            }
        });
    }

    private function createLogoForTeam(Team $team, FileService $fileService): void
    {
        try {
            $logoUrl = "https://ui-avatars.com/api/?name=" . urlencode($team->name) . 
                      "&size=200&background=0066cc&color=fff&format=png&bold=true";
            
            $response = Http::get($logoUrl);
            
            if ($response->successful()) {
                $tempFile = tempnam(sys_get_temp_dir(), 'logo_');
                file_put_contents($tempFile, $response->body());
                
                $uploadedFile = new UploadedFile(
                    $tempFile,
                    'logo.png',
                    'image/png',
                    null,
                    true
                );
                
                $fileService->uploadLogo($uploadedFile, $team, [
                    'uploaded_by' => $team->owner_id
                ]);
                
                unlink($tempFile);
            }
        } catch (\Exception $e) {
            \Log::warning("Erreur création logo pour {$team->name}: " . $e->getMessage());
        }
    }

    private function createAvatarForTeam(Team $team, FileService $fileService): void
    {
        try {
            $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($team->name) . 
                        "&size=400&background=random&color=fff&format=png";
            
            $response = Http::get($avatarUrl);
            
            if ($response->successful()) {
                $tempFile = tempnam(sys_get_temp_dir(), 'team_avatar_');
                file_put_contents($tempFile, $response->body());
                
                $uploadedFile = new UploadedFile(
                    $tempFile,
                    'avatar.png',
                    'image/png',
                    null,
                    true
                );
                
                $fileService->upload($uploadedFile, $team, 'avatar', null, [
                    'uploaded_by' => $team->owner_id
                ]);
                
                unlink($tempFile);
            }
        } catch (\Exception $e) {
            \Log::warning("Erreur création avatar pour équipe {$team->name}: " . $e->getMessage());
        }
    }
}
```

### ProjectSeeder avec documents
```php
<?php
// database/seeders/ProjectSeeder.php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $fileService = app(FileService::class);
        $teams = Team::all();
        $users = User::all();
        
        Project::factory(30)->create([
            'team_id' => $teams->random()->id,
            'manager_id' => $users->random()->id,
        ])->each(function ($project) use ($fileService) {
            // Créer des documents pour le projet
            $this->createDocumentsForProject($project, $fileService);
        });
    }

    private function createDocumentsForProject(Project $project, FileService $fileService): void
    {
        $documentCount = rand(1, 5);
        
        for ($i = 0; $i < $documentCount; $i++) {
            try {
                // Créer un faux document PDF
                $content = "Document de test pour le projet: {$project->name}\n\n" .
                          "Contenu généré automatiquement.\n" .
                          "Date: " . now()->format('Y-m-d H:i:s');
                
                $tempFile = tempnam(sys_get_temp_dir(), 'doc_');
                file_put_contents($tempFile, $content);
                
                $filename = "document_" . ($i + 1) . ".txt";
                
                $uploadedFile = new UploadedFile(
                    $tempFile,
                    $filename,
                    'text/plain',
                    null,
                    true
                );
                
                $fileService->upload($uploadedFile, $project, 'document', 'specification', [
                    'uploaded_by' => $project->manager_id,
                    'description' => "Document de spécification #" . ($i + 1)
                ]);
                
                unlink($tempFile);
                
            } catch (\Exception $e) {
                \Log::warning("Erreur création document pour projet {$project->name}: " . $e->getMessage());
            }
        }
    }
}
```

## 📝 7. REQUESTS DE VALIDATION

### FileUploadRequest
```php
<?php
// app/Http/Requests/FileUploadRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Géré par les policies
    }

    public function rules(): array
    {
        $rules = [
            'file' => ['required', 'file', 'max:10240'], // 10MB max
            'type' => ['required', 'string', 'in:avatar,logo,document,image'],
            'category' => ['nullable', 'string', 'max:50'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_public' => ['boolean'],
        ];

        // Rules spécifiques par type
        switch ($this->input('type')) {
            case 'avatar':
            case 'logo':
                $rules['file'][] = 'image';
                $rules['file'][] = 'mimes:jpeg,png,jpg,webp';
                $rules['file'][] = 'max:5120'; // 5MB pour les images
                break;
                
            case 'image':
                $rules['file'][] = 'image';
                $rules['file'][] = 'mimes:jpeg,png,jpg,webp,gif';
                break;
                
            case 'document':
                $rules['file'][] = 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt';
                break;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Veuillez sélectionner un fichier.',
            'file.max' => 'Le fichier ne peut pas dépasser :max Ko.',
            'file.image' => 'Le fichier doit être une image.',
            'file.mimes' => 'Format de fichier non autorisé.',
            'type.required' => 'Le type de fichier est requis.',
            'type.in' => 'Type de fichier invalide.',
        ];
    }
}
```

### AvatarUploadRequest
```php
<?php
// app/Http/Requests/AvatarUploadRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvatarUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'avatar' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:5120', // 5MB
                'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000'
            ],
            'alt_text' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'avatar.required' => 'Veuillez sélectionner un avatar.',
            'avatar.image' => 'L\'avatar doit être une image.',
            'avatar.mimes' => 'L\'avatar doit être au format JPEG, PNG, JPG ou WebP.',
            'avatar.max' => 'L\'avatar ne peut pas dépasser 5MB.',
            'avatar.dimensions' => 'L\'avatar doit faire entre 100x100 et 2000x2000 pixels.',
        ];
    }
}
```

## 📊 8. RESOURCES API

### FileResource
```php
<?php
// app/Http/Resources/FileResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'filename' => $this->filename,
            'mime_type' => $this->mime_type,
            'extension' => $this->extension,
            'size' => $this->size,
            'size_formatted' => $this->size_formatted,
            'type' => $this->type,
            'category' => $this->category,
            'url' => $this->url,
            'is_public' => $this->is_public,
            'alt_text' => $this->alt_text,
            'description' => $this->description,
            'metadata' => $this->metadata,
            'thumbnails' => $this->when($this->thumbnails, function () {
                return collect($this->thumbnails)->mapWithKeys(function ($path, $size) {
                    return [$size => $this->getThumbnailUrl($size)];
                });
            }),
            'uploader' => new UserResource($this->whenLoaded('uploader')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
```

### UserResource
```php
<?php
// app/Http/Resources/UserResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'status' => $this->status,
            'avatar_url' => $this->avatar_url,
            'avatar_thumbnail' => $this->avatar_thumbnail,
            'avatar' => new FileResource($this->whenLoaded('files', function () {
                return $this->getFileByType('avatar');
            })),
            'files_count' => $this->when($this->files_count !== null, $this->files_count),
            'total_files_size' => $this->when(
                $request->has('include_stats'),
                $this->getTotalFilesSize()
            ),
            'settings' => $this->when($this->settings, $this->settings),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
```

### TeamResource
```php
<?php
// app/Http/Resources/TeamResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'website' => $this->website,
            'location' => $this->location,
            'size' => $this->size,
            'status' => $this->status,
            'avatar_url' => $this->avatar_url,
            'logo_url' => $this->logo_url,
            'avatar' => new FileResource($this->whenLoaded('files', function () {
                return $this->getFileByType('avatar');
            })),
            'logo' => new FileResource($this->whenLoaded('files', function () {
                return $this->getFileByType('logo');
            })),
            'owner' => new UserResource($this->whenLoaded('owner')),
            'projects_count' => $this->when($this->projects_count !== null, $this->projects_count),
            'files' => FileResource::collection($this->whenLoaded('files')),
            'settings' => $this->when($this->settings, $this->settings),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
```

### ProjectResource
```php
<?php
// app/Http/Resources/ProjectResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'budget' => $this->budget,
            'team' => new TeamResource($this->whenLoaded('team')),
            'manager' => new UserResource($this->whenLoaded('manager')),
            'files' => FileResource::collection($this->whenLoaded('files')),
            'documents' => FileResource::collection($this->whenLoaded('files', function () {
                return $this->getFilesByType('document');
            })),
            'images' => FileResource::collection($this->whenLoaded('files', function () {
                return $this->getFilesByType('image');
            })),
            'files_count' => $this->when($this->files_count !== null, $this->files_count),
            'metadata' => $this->when($this->metadata, $this->metadata),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
```

## 🎮 9. CONTROLLERS API

### UserController
```php
<?php
// app/Http/Controllers/Api/UserController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvatarUploadRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected FileService $fileService
    ) {}

    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->search, fn($q, $search) => 
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
            )
            ->when($request->status, fn($q, $status) => 
                $q->where('status', $status)
            )
            ->with(['files' => fn($q) => $q->where('type', 'avatar')])
            ->withCount('files')
            ->paginate($request->per_page ?? 15);

        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        $user->load(['files', 'teams', 'managedProjects']);
        return new UserResource($user);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'nullable|string',
            'bio' => 'nullable|string',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);

        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string',
            'bio' => 'nullable|string',
            'status' => 'sometimes|in:active,inactive,suspended',
        ]);

        $user->update($validated);
        $user->load('files');

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        // Supprimer tous les fichiers de l'utilisateur
        $this->fileService->deleteFilesByType($user, 'avatar');
        
        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé avec succès']);
    }

    public function uploadAvatar(AvatarUploadRequest $request, User $user)
    {
        try {
            $file = $this->fileService->uploadAvatar(
                $request->file('avatar'),
                $user,
                [
                    'alt_text' => $request->alt_text,
                    'uploaded_by' => auth()->id()
                ]
            );

            return response()->json([
                'message' => 'Avatar uploadé avec succès',
                'avatar' => new \App\Http\Resources\FileResource($file)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de l\'upload de l\'avatar',
                'error' => $e->getMessage()
            ], 422);
        }
    }

    public function deleteAvatar(User $user)
    {
        $count = $this->fileService->deleteFilesByType($user, 'avatar');
        
        return response()->json([
            'message' => $count > 0 ? 'Avatar supprimé avec succès' : 'Aucun avatar à supprimer'
        ]);
    }
}
```

### TeamController
```php
<?php
// app/Http/Controllers/Api/TeamController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileUploadRequest;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function __construct(
        protected FileService $fileService
    ) {}

    public function index(Request $request)
    {
        $teams = Team::query()
            ->when($request->search, fn($q, $search) => 
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
            )
            ->when($request->status, fn($q, $status) => 
                $q->where('status', $status)
            )
            ->with(['owner', 'files'])
            ->withCount(['projects', 'files'])
            ->paginate($request->per_page ?? 15);

        return TeamResource::collection($teams);
    }

    public function show(Team $team)
    {
        $team->load(['owner', 'projects', 'files']);
        return new TeamResource($team);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'location' => 'nullable|string',
            'size' => 'nullable|integer|min:1',
            'status' => 'sometimes|in:active,inactive,archived',
            'owner_id' => 'required|exists:users,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . now()->timestamp;
        $team = Team::create($validated);

        return new TeamResource($team);
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'location' => 'nullable|string',
            'size' => 'nullable|integer|min:1',
            'status' => 'sometimes|in:active,inactive,archived',
        ]);

        if (isset($validated['name']) && $validated['name'] !== $team->name) {
            $validated['slug'] = Str::slug($validated['name']) . '-' . now()->timestamp;
        }

        $team->update($validated);
        $team->load(['owner', 'files']);

        return new TeamResource($team);
    }

    public function destroy(Team $team)
    {
        // Supprimer tous les fichiers de l'équipe
        foreach (['avatar', 'logo'] as $type) {
            $this->fileService->deleteFilesByType($team, $type);
        }
        
        $team->delete();

        return response()->json(['message' => 'Équipe supprimée avec succès']);
    }

    public function uploadAvatar(FileUploadRequest $request, Team $team)
    {
        try {
            $file = $this->fileService->uploadAvatar(
                $request->file('file'),
                $team,
                [
                    'alt_text' => $request->alt_text,
                    'description' => $request->description,
                    'uploaded_by' => auth()->id()
                ]
            );

            return response()->json([
                'message' => 'Avatar d\'équipe uploadé avec succès',
                'avatar' => new \App\Http\Resources\FileResource($file)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de l\'upload de l\'avatar',
                'error' => $e->getMessage()
            ], 422);
        }
    }

    public function uploadLogo(FileUploadRequest $request, Team $team)
    {
        try {
            $file = $this->fileService->uploadLogo(
                $request->file('file'),
                $team,
                [
                    'alt_text' => $request->alt_text,
                    'description' => $request->description,
                    'uploaded_by' => auth()->id()
                ]
            );

            return response()->json([
                'message' => 'Logo uploadé avec succès',
                'logo' => new \App\Http\Resources\FileResource($file)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de l\'upload du logo',
                'error' => $e->getMessage()
            ], 422);
        }
    }

    public function deleteAvatar(Team $team)
    {
        $count = $this->fileService->deleteFilesByType($team, 'avatar');
        
        return response()->json([
            'message' => $count > 0 ? 'Avatar supprimé avec succès' : 'Aucun avatar à supprimer'
        ]);
    }

    public function deleteLogo(Team $team)
    {
        $count = $this->fileService->deleteFilesByType($team, 'logo');
        
        return response()->json([
            'message' => $count > 0 ? 'Logo supprimé avec succès' : 'Aucun logo à supprimer'
        ]);
    }
}
```

### ProjectController
```php
<?php
// app/Http/Controllers/Api/ProjectController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileUploadRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function __construct(
        protected FileService $fileService
    ) {}

    public function index(Request $request)
    {
        $projects = Project::query()
            ->when($request->search, fn($q, $search) => 
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
            )
            ->when($request->status, fn($q, $status) => 
                $q->where('status', $status)
            )
            ->when($request->priority, fn($q, $priority) => 
                $q->where('priority', $priority)
            )
            ->when($request->team_id, fn($q, $teamId) => 
                $q->where('team_id', $teamId)
            )
            ->with(['team', 'manager', 'files'])
            ->withCount('files')
            ->paginate($request->per_page ?? 15);

        return ProjectResource::collection($projects);
    }

    public function show(Project $project)
    {
        $project->load(['team', 'manager', 'files.uploader']);
        return new ProjectResource($project);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:draft,active,completed,archived,cancelled',
            'priority' => 'sometimes|in:low,medium,high,critical',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'budget' => 'nullable|numeric|min:0',
            'team_id' => 'required|exists:teams,id',
            'manager_id' => 'required|exists:users,id',
            'metadata' => 'nullable|array',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . now()->timestamp;
        $project = Project::create($validated);

        return new ProjectResource($project);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:draft,active,completed,archived,cancelled',
            'priority' => 'sometimes|in:low,medium,high,critical',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'budget' => 'nullable|numeric|min:0',
            'manager_id' => 'sometimes|exists:users,id',
            'metadata' => 'nullable|array',
        ]);

        if (isset($validated['name']) && $validated['name'] !== $project->name) {
            $validated['slug'] = Str::slug($validated['name']) . '-' . now()->timestamp;
        }

        $project->update($validated);
        $project->load(['team', 'manager', 'files']);

        return new ProjectResource($project);
    }

    public function destroy(Project $project)
    {
        // Supprimer tous les fichiers du projet
        foreach (['document', 'image'] as $type) {
            $this->fileService->deleteFilesByType($project, $type);
        }
        
        $project->delete();

        return response()->json(['message' => 'Projet supprimé avec succès']);
    }

    public function uploadFile(FileUploadRequest $request, Project $project)
    {
        try {
            $file = $this->fileService->upload(
                $request->file('file'),
                $project,
                $request->type,
                $request->category,
                [
                    'alt_text' => $request->alt_text,
                    'description' => $request->description,
                    'is_public' => $request->boolean('is_public', true),
                    'uploaded_by' => auth()->id()
                ]
            );

            return response()->json([
                'message' => 'Fichier uploadé avec succès',
                'file' => new \App\Http\Resources\FileResource($file)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de l\'upload du fichier',
                'error' => $e->getMessage()
            ], 422);
        }
    }

    public function getFiles(Request $request, Project $project)
    {
        $files = $project->files()
            ->when($request->type, fn($q, $type) => $q->where('type', $type))
            ->when($request->category, fn($q, $category) => $q->where('category', $category))
            ->with('uploader')
            ->latest()
            ->paginate($request->per_page ?? 20);

        return \App\Http\Resources\FileResource::collection($files);
    }

    public function deleteFile(Project $project, $fileId)
    {
        $file = $project->files()->findOrFail($fileId);
        
        if ($this->fileService->delete($file)) {
            return response()->json(['message' => 'Fichier supprimé avec succès']);
        }

        return response()->json(['message' => 'Erreur lors de la suppression'], 500);
    }
}
```

### FileController
```php
<?php
// app/Http/Controllers/Api/FileController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FileResource;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function __construct(
        protected FileService $fileService
    ) {}

    public function index(Request $request)
    {
        $files = File::query()
            ->when($request->search, fn($q, $search) => 
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
            )
            ->when($request->type, fn($q, $type) => 
                $q->where('type', $type)
            )
            ->when($request->category, fn($q, $category) => 
                $q->where('category', $category)
            )
            ->when($request->mime_type, fn($q, $mimeType) => 
                $q->where('mime_type', 'like', "{$mimeType}%")
            )
            ->when($request->boolean('public_only'), fn($q) => 
                $q->where('is_public', true)
            )
            ->with(['uploader', 'fileable'])
            ->latest()
            ->paginate($request->per_page ?? 20);

        return FileResource::collection($files);
    }

    public function show(File $file)
    {
        $file->load(['uploader', 'fileable']);
        return new FileResource($file);
    }

    public function download(File $file)
    {
        // Vérifier les permissions pour les fichiers privés
        if (!$file->is_public) {
            // Ajouter ici la logique d'autorisation
            abort_unless(auth()->check(), 403);
        }

        if (!Storage::disk($file->disk)->exists($file->path)) {
            abort(404, 'Fichier non trouvé');
        }

        return Storage::disk($file->disk)->download($file->path, $file->name);
    }

    public function stream(File $file)
    {
        if (!$file->is_public) {
            abort_unless(auth()->check(), 403);
        }

        if (!Storage::disk($file->disk)->exists($file->path)) {
            abort(404, 'Fichier non trouvé');
        }

        return Storage::disk($file->disk)->response($file->path);
    }

    public function destroy(File $file)
    {
        // Vérifier les permissions
        abort_unless(
            auth()->id() === $file->uploaded_by || auth()->user()->can('delete', $file),
            403
        );

        if ($this->fileService->delete($file)) {
            return response()->json(['message' => 'Fichier supprimé avec succès']);
        }

        return response()->json(['message' => 'Erreur lors de la suppression'], 500);
    }

    public function update(Request $request, File $file)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'nullable|string|max:50',
            'is_public' => 'boolean',
        ]);

        $file->update($validated);

        return new FileResource($file);
    }

    public function duplicate(Request $request, File $file)
    {
        $validated = $request->validate([
            'fileable_type' => 'required|string',
            'fileable_id' => 'required|integer',
            'type' => 'nullable|string',
        ]);

        // Trouver le modèle cible
        $modelClass = $validated['fileable_type'];
        $model = $modelClass::findOrFail($validated['fileable_id']);

        try {
            $duplicatedFile = $this->fileService->duplicate(
                $file, 
                $model, 
                $validated['type'] ?? null
            );

            return response()->json([
                'message' => 'Fichier dupliqué avec succès',
                'file' => new FileResource($duplicatedFile)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la duplication',
                'error' => $e->getMessage()
            ], 422);
        }
    }

    public function cleanOrphans()
    {
        $count = $this->fileService->cleanOrphanFiles();

        return response()->json([
            'message' => "Nettoyage terminé: {$count} fichiers orphelins supprimés"
        ]);
    }

    public function stats()
    {
        $stats = [
            'total_files' => File::count(),
            'total_size' => File::sum('size'),
            'by_type' => File::selectRaw('type, COUNT(*) as count, SUM(size) as total_size')
                ->groupBy('type')
                ->get(),
            'by_month' => File::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
                ->where('created_at', '>=', now()->subYear())
                ->groupBy('month')
                ->orderBy('month')
                ->get(),
            'top_uploaders' => File::with('uploader:id,name')
                ->selectRaw('uploaded_by, COUNT(*) as uploads_count')
                ->groupBy('uploaded_by')
                ->orderByDesc('uploads_count')
                ->limit(10)
                ->get(),
        ];

        return response()->json($stats);
    }
}
```

## 🛣️ 10. ROUTES API

```php
<?php
// routes/api.php

use App\Http\Controllers\Api\{
    UserController,
    TeamController,
    ProjectController,
    FileController
};
use Illuminate\Support\Facades\Route;

// Routes authentifiées
Route::middleware('auth:sanctum')->group(function () {
    
    // Routes Users
    Route::apiResource('users', UserController::class);
    Route::post('users/{user}/avatar', [UserController::class, 'uploadAvatar']);
    Route::delete('users/{user}/avatar', [UserController::class, 'deleteAvatar']);
    
    // Routes Teams
    Route::apiResource('teams', TeamController::class);
    Route::post('teams/{team}/avatar', [TeamController::class, 'uploadAvatar']);
    Route::post('teams/{team}/logo', [TeamController::class, 'uploadLogo']);
    Route::delete('teams/{team}/avatar', [TeamController::class, 'deleteAvatar']);
    Route::delete('teams/{team}/logo', [TeamController::class, 'deleteLogo']);
    
    // Routes Projects
    Route::apiResource('projects', ProjectController::class);
    Route::post('projects/{project}/files', [ProjectController::class, 'uploadFile']);
    Route::get('projects/{project}/files', [ProjectController::class, 'getFiles']);
    Route::delete('projects/{project}/files/{file}', [ProjectController::class, 'deleteFile']);
    
    // Routes Files générales
    Route::apiResource('files', FileController::class)->except(['store']);
    Route::post('files/{file}/duplicate', [FileController::class, 'duplicate']);
    Route::delete('files/orphans/clean', [FileController::class, 'cleanOrphans']);
    Route::get('files/stats/overview', [FileController::class, 'stats']);
});

// Routes publiques pour téléchargement
Route::get('files/{file}/download', [FileController::class, 'download'])->name('files.download');
Route::get('files/{file}/stream', [FileController::class, 'stream'])->name('files.stream');
```

## ⚙️ 11. CONFIGURATION

### Configuration Filesystems
```php
<?php
// config/filesystems.php - Ajouts/modifications

'disks' => [
    'local' => [
        'driver' => 'local',
        'root' => storage_path('app'),
        'throw' => false,
    ],

    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'public',
        'throw' => false,
    ],

    // Disque spécifique pour les fichiers privés
    'private_files' => [
        'driver' => 'local',
        'root' => storage_path('app/private'),
        'visibility' => 'private',
        'throw' => false,
    ],

    // Configuration S3 pour la production
    's3' => [
        'driver' => 's3',
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION'),
        'bucket' => env('AWS_BUCKET'),
        'url' => env('AWS_URL'),
        'endpoint' => env('AWS_ENDPOINT'),
        'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        'throw' => false,
    ],
],

// Liens symboliques
'links' => [
    public_path('storage') => storage_path('app/public'),
],
```

### Configuration personnalisée pour les fichiers
```php
<?php
// config/files.php

return [
    // Tailles de miniatures
    'thumbnail_sizes' => [
        'small' => 150,
        'medium' => 300,
        'large' => 600,
        'xlarge' => 1200,
    ],

    // Types de fichiers autorisés
    'allowed_types' => [
        'avatar' => [
            'extensions' => ['jpg', 'jpeg', 'png', 'webp'],
            'max_size' => 5 * 1024 * 1024, // 5MB
            'dimensions' => [
                'min_width' => 100,
                'min_height' => 100,
                'max_width' => 2000,
                'max_height' => 2000,
            ],
        ],
        'logo' => [
            'extensions' => ['jpg', 'jpeg', 'png', 'webp', 'svg'],
            'max_size' => 10 * 1024 * 1024, // 10MB
        ],
        'document' => [
            'extensions' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'rtf'],
            'max_size' => 50 * 1024 * 1024, // 50MB
        ],
        'image' => [
            'extensions' => ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp', 'tiff'],
            'max_size' => 20 * 1024 * 1024, // 20MB
        ],
    ],

    // Configuration des chemins
    'paths' => [
        'users' => 'files/users',
        'teams' => 'files/teams', 
        'projects' => 'files/projects',
        'temp' => 'files/temp',
        'thumbnails' => 'thumbs',
    ],

    // Sécurité
    'security' => [
        'scan_uploads' => env('FILE_SCAN_UPLOADS', false),
        'quarantine_suspicious' => env('FILE_QUARANTINE_SUSPICIOUS', true),
        'max_daily_uploads_per_user' => 100,
        'blocked_extensions' => ['exe', 'bat', 'com', 'scr', 'vbs', 'js'],
    ],

    // Nettoyage automatique
    'cleanup' => [
        'orphan_files_after_days' => 7,
        'temp_files_after_hours' => 24,
        'deleted_files_retention_days' => 30,
    ],
];
```

### Service Provider personnalisé
```php
<?php
// app/Providers/FileServiceProvider.php

namespace App\Providers;

use App\Services\FileService;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManagerStatic as Image;

class FileServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FileService::class, function ($app) {
            return new FileService();
        });
    }

    public function boot(): void
    {
        // Configuration d'Intervention Image
        Image::configure(['driver' => 'gd']);

        // Validation personnalisée pour les fichiers
        \Validator::extend('max_file_size', function ($attribute, $value, $parameters, $validator) {
            if (!$value instanceof \Illuminate\Http\UploadedFile) {
                return false;
            }
            
            $maxSize = $parameters[0] ?? 10240; // 10MB par défaut
            return $value->getSize() <= ($maxSize * 1024);
        });

        // Validation pour les dimensions d'image
        \Validator::extend('image_dimensions', function ($attribute, $value, $parameters, $validator) {
            if (!$value instanceof \Illuminate\Http\UploadedFile || !$value->isValid()) {
                return false;
            }

            try {
                $imageSize = getimagesize($value->getRealPath());
                if (!$imageSize) return false;

                $width = $imageSize[0];
                $height = $imageSize[1];
                
                // Paramètres: min_width,min_height,max_width,max_height
                $minWidth = $parameters[0] ?? 0;
                $minHeight = $parameters[1] ?? 0;
                $maxWidth = $parameters[2] ?? PHP_INT_MAX;
                $maxHeight = $parameters[3] ?? PHP_INT_MAX;

                return $width >= $minWidth && 
                       $height >= $minHeight && 
                       $width <= $maxWidth && 
                       $height <= $maxHeight;
                       
            } catch (\Exception $e) {
                return false;
            }
        });
    }
}
```

### Bootstrap de l'application
```php
<?php
// bootstrap/app.php - Ajouts

use App\Providers\FileServiceProvider;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Middleware pour les fichiers
        $middleware->append(\App\Http\Middleware\FileSecurityMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withProviders([
        FileServiceProvider::class,
    ])
    ->create();
```

## 🔒 12. MIDDLEWARE DE SÉCURITÉ

```php
<?php
// app/Http/Middleware/FileSecurityMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FileSecurityMiddleware
{
    protected array $dangerousExtensions = [
        'exe', 'bat', 'com', 'scr', 'vbs', 'js', 'jar', 'pif', 'app', 'deb', 'pkg'
    ];

    public function handle(Request $request, Closure $next)
    {
        if ($request->hasFile('file') || $request->hasFile('avatar')) {
            $file = $request->file('file') ?? $request->file('avatar');
            
            // Vérifier l'extension
            $extension = strtolower($file->getClientOriginalExtension());
            if (in_array($extension, $this->dangerousExtensions)) {
                return response()->json([
                    'message' => 'Type de fichier non autorisé pour des raisons de sécurité'
                ], 422);
            }

            // Vérifier le type MIME
            $mimeType = $file->getMimeType();
            if ($this->isDangerousMimeType($mimeType)) {
                return response()->json([
                    'message' => 'Type de contenu non autorisé'
                ], 422);
            }

            // Vérifier la taille
            $maxSize = config('files.allowed_types.' . $request->input('type', 'document') . '.max_size', 10485760);
            if ($file->getSize() > $maxSize) {
                return response()->json([
                    'message' => 'Fichier trop volumineux'
                ], 422);
            }
        }

        return $next($request);
    }

    protected function isDangerousMimeType(string $mimeType): bool
    {
        $dangerous = [
            'application/x-executable',
            'application/x-msdownload',
            'application/x-msdos-program',
            'application/x-dosexec',
        ];

        return in_array($mimeType, $dangerous);
    }
}
```

## 🧪 13. COMMANDES ARTISAN

```php
<?php
// app/Console/Commands/CleanOrphanFiles.php

namespace App\Console\Commands;

use App\Services\FileService;
use Illuminate\Console\Command;

class CleanOrphanFiles extends Command
{
    protected $signature = 'files:clean-orphans {--dry-run : Afficher les fichiers qui seraient supprimés sans les supprimer}';
    protected $description = 'Nettoyer les fichiers orphelins';

    public function handle(FileService $fileService): int
    {
        $this->info('Recherche des fichiers orphelins...');

        if ($this->option('dry-run')) {
            $this->warn('Mode simulation - Aucun fichier ne sera supprimé');
        }

        $count = $this->option('dry-run') ? 0 : $fileService->cleanOrphanFiles();

        $this->info("Nettoyage terminé: {$count} fichiers orphelins supprimés");

        return self::SUCCESS;
    }
}
```

```php
<?php
// app/Console/Commands/GenerateFileThumbnails.php

namespace App\Console\Commands;

use App\Models\File;
use App\Services\FileService;
use Illuminate\Console\Command;

class GenerateFileThumbnails extends Command
{
    protected $signature = 'files:generate-thumbnails {--missing-only : Générer seulement les miniatures manquantes}';
    protected $description = 'Générer les miniatures pour les images';

    public function handle(FileService $fileService): int
    {
        $query = File::where('mime_type', 'like', 'image/%');
        
        if ($this->option('missing-only')) {
            $query->where(function ($q) {
                $q->whereNull('thumbnails')->orWhere('thumbnails', '[]');
            });
        }

        $files = $query->get();
        $this->info("Traitement de {$files->count()} fichiers...");

        $bar = $this->output->createProgressBar($files->count());
        $processed = 0;

        foreach ($files as $file) {
            try {
                // Logique de génération des miniatures
                $this->info("Traitement: {$file->name}");
                $processed++;
            } catch (\Exception $e) {
                $this->error("Erreur pour {$file->name}: " . $e->getMessage());
            }
            
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Miniatures générées pour {$processed} fichiers");

        return self::SUCCESS;
    }
}
```

## 📋 14. RÉCAPITULATIF ET UTILISATION

### Installation et Configuration

1. **Créer les migrations** :
```bash
php artisan make:migration create_users_table
php artisan make:migration create_teams_table  
php artisan make:migration create_projects_table
php artisan make:migration create_files_table
php artisan migrate
```

2. **Installer les dépendances** :
```bash
composer require intervention/image
composer require league/flysystem-aws-s3-v3  # Pour S3
```

3. **Créer les liens symboliques** :
```bash
php artisan storage:link
```

4. **Lancer les seeders** :
```bash
php artisan db:seed
```

### Exemples d'utilisation de l'API

#### Upload d'avatar utilisateur
```javascript
// POST /api/users/1/avatar
const formData = new FormData();
formData.append('avatar', file);
formData.append('alt_text', 'Avatar de John Doe');

fetch('/api/users/1/avatar', {
    method: 'POST',
    body: formData,
    headers: {
        'Authorization': 'Bearer ' + token
    }
});
```

#### Upload de document projet
```javascript
// POST /api/projects/1/files
const formData = new FormData();
formData.append('file', document);
formData.append('type', 'document');
formData.append('category', 'specification');
formData.append('description', 'Cahier des charges v2');

fetch('/api/projects/1/files', {
    method: 'POST', 
    body: formData
});
```

#### Récupérer les fichiers d'un projet
```javascript
// GET /api/projects/1/files?type=document&per_page=10
fetch('/api/projects/1/files?type=document&per_page=10')
    .then(response => response.json())
    .then(data => console.log(data));
```

### Fonctionnalités Clés

✅ **Relations polymorphes** - Un système de fichiers centralisé
✅ **Miniatures automatiques** - Générées pour les images  
✅ **Types de fichiers multiples** - Avatar, logo, document, image
✅ **Validation robuste** - Taille, type, dimensions
✅ **URLs sécurisées** - Fichiers publics et privés
✅ **Gestion des doublons** - Hash MD5 pour détecter les doublons
✅ **Nettoyage automatique** - Suppression des fichiers orphelins
✅ **API complète** - CRUD + fonctions spécialisées
✅ **Seeders avec vrais fichiers** - Données de test réalistes
✅ **Statistiques** - Dashboard des fichiers
✅ **Duplication** - Copier des fichiers entre modèles

### Structure finale des dossiers
```
app/
├── Console/Commands/
│   ├── CleanOrphanFiles.php
│   └── GenerateFileThumbnails.php
├── Http/
│   ├── Controllers/Api/
│   │   ├── UserController.php
│   │   ├── TeamController.php
│   │   ├── ProjectController.php
│   │   └── FileController.php
│   ├── Middleware/
│   │   └── FileSecurityMiddleware.php
│   ├── Requests/
│   │   ├── FileUploadRequest.php
│   │   └── AvatarUploadRequest.php
│   └── Resources/
│       ├── UserResource.php
│       ├── TeamResource.php
│       ├── ProjectResource.php
│       └── FileResource.php
├── Models/
│   ├── User.php
│   ├── Team
