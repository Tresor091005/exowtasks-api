<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MembreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->fullName,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'role' => $this->role,
            'team_id' => $this->team_id,
            'joined_at' => $this->joined_at?->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),

            // Relations
            'equipe' => $this->whenLoaded('equipe', function () {
                return new EquipeResource($this->equipe);
            }),

            'created_tasks' => $this->whenLoaded('createdTasks', function () {
                return TacheResource::collection($this->createdTasks);
            }),

            'assigned_tasks' => $this->whenLoaded('assignedTasks', function () {
                return TacheResource::collection($this->assignedTasks);
            }),
        ];
    }
}
