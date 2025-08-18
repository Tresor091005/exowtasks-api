<?php

namespace App\Data\V1;

use App\Data\V1\MembreData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\DataCollection;

class TacheData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $description,
        public ?string $due_date,
        public string $status,
        public bool $is_overdue,
        public bool $is_completed,
        public int $created_by,
        public ?string $created_at,
        public ?string $updated_at,

        // Relations
        public MembreData|Lazy $creator,
        /** @var DataCollection<MembreData>|Lazy */
        public DataCollection|Lazy $assigned_members,
    ) {}

    public static function fromModel($tache): self
    {
        return new self(
            id: $tache->id,
            title: $tache->title,
            description: $tache->description,
            due_date: $tache->due_date?->format('Y-m-d H:i:s'),
            status: $tache->status,
            is_overdue: $tache->isOverdue(),
            is_completed: $tache->isCompleted(),
            created_by: $tache->created_by,
            created_at: $tache->created_at?->format('Y-m-d H:i:s'),
            updated_at: $tache->updated_at?->format('Y-m-d H:i:s'),
            creator: Lazy::when(
                'creator', 
                fn() => MembreData::from($tache->creator)
            ),
            assigned_members: Lazy::when(
                'assignedMembers', 
                fn() => MembreData::collection($tache->assignedMembers)
            ),
        );
    }
}