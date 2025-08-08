<?php

namespace App\Models;

use App\Enums\MembreRole;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Membre extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'team_id',
        'joined_at',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'joined_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'team_id' => 'integer',
    ];

    protected function fullName(): Attribute 
    {
        return Attribute::make(
            get: fn ($value, $attributes) => ucfirst($attributes['first_name']) . ' ' . ucfirst($attributes['last_name']),
        );
    }

    public function equipe(): BelongsTo
    {
        return $this->belongsTo(Equipe::class, 'team_id');
    }

    public function createdTasks(): HasMany
    {
        return $this->hasMany(Tache::class, 'created_by');
    }

    public function assignedTasks(): BelongsToMany
    {
        return $this->belongsToMany(Tache::class, 'membre_taches', 'member_id', 'task_id')->withTimestamps();
    }

    public function isManager(): bool
    {
        return $this->role === MembreRole::MANAGER->value;
    }
}
