<?php

namespace App\Models;

use App\Enums\TacheStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tache extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
        'created_by',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_by' => 'integer',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Membre::class, 'created_by');
    }

    public function assignedMembers(): BelongsToMany
    {
        return $this->belongsToMany(Membre::class, 'membre_taches', 'task_id', 'member_id')->withTimestamps();
    }

    public function isOverdue(): bool
    {
        return $this->due_date < now() && $this->status !== TacheStatus::DONE->value;
    }

    public function isCompleted(): bool
    {
        return $this->status === TacheStatus::DONE->value;
    }
}
