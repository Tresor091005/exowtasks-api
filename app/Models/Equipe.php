<?php

namespace App\Models;

use App\Casts\TimestampCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Equipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected $casts = [
        'created_at' => TimestampCast::class,
        'updated_at' => TimestampCast::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($team) {
            if (empty($team->slug)) {
                $team->slug = Str::slug($team->name);
            }
        });

        static::updating(function ($team) {
            if ($team->isDirty('name')) {
                $team->slug = Str::slug($team->name);
            }
        });
    }

    public function membres(): HasMany
    {
        return $this->hasMany(Membre::class, 'team_id');
    }
}
