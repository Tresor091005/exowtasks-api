<?php

namespace App\Data\V1;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\DataCollection;
use Carbon\Carbon;

class MembreData extends Data
{
    public function __construct(
        public int $id,
        public string $full_name,
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $role,
        public int $team_id,
        public ?string $joined_at,
        public ?string $created_at,
        public ?string $updated_at,

        // Relations
        public EquipeData|Lazy $equipe,
        /** @var DataCollection<TacheData>|Lazy */
        public DataCollection|Lazy $created_tasks,
        /** @var DataCollection<TacheData>|Lazy */
        public DataCollection|Lazy $assigned_tasks,
    ) {}

    public static function fromModel($membre): self
    {
        return new self(
            id: $membre->id,
            full_name: $membre->fullName,
            first_name: $membre->first_name,
            last_name: $membre->last_name,
            email: $membre->email,
            role: $membre->role,
            team_id: $membre->team_id,
            joined_at: $membre->joined_at?->format('Y-m-d H:i:s'),
            created_at: $membre->created_at?->format('Y-m-d H:i:s'),
            updated_at: $membre->updated_at?->format('Y-m-d H:i:s'),
            equipe: Lazy::when(
                'equipe', 
                fn() => EquipeData::from($membre->equipe)
            ),
            created_tasks: Lazy::when(
                'createdTasks', 
                fn() => TacheData::collection($membre->createdTasks)
            ),
            assigned_tasks: Lazy::when(
                'assignedTasks', 
                fn() => TacheData::collection($membre->assignedTasks)
            ),
        );
    }
}