<?php

namespace App\Data\V1;

use App\Data\V1\MembreData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Carbon\Carbon;

class EquipeData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $slug,
        #[WithCast(DateTimeInterfaceCast::class, type: 'timestamp')]
        public int $created_at,
        #[WithCast(DateTimeInterfaceCast::class, type: 'timestamp')]
        public int $updated_at,

        // Relations
        // /** @var DataCollection<MembreData>|Lazy */
        // public DataCollection|Lazy $membres,
    ) {}

    public static function fromModel($equipe): self
    {
        return new self(
            id: $equipe->id,
            name: $equipe->name,
            slug: $equipe->slug,
            created_at: $equipe->created_at,
            updated_at: $equipe->updated_at,
            // membres: Lazy::when(
            //     'membres', 
            //     fn() => MembreData::collection($equipe->membres)
            // ),
        );
    }
}