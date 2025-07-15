<?php

namespace App\Models;

use App\Enums\MembreRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Membre extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'role',
        'team_id',
        'joined_at',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function equipe(): BelongsTo
    {
        return $this->belongsTo(Equipe::class);
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
