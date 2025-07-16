<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TacheResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date?->format('Y-m-d H:i:s'),
            'status' => $this->status,
            'is_overdue' => $this->isOverdue(),
            'is_completed' => $this->isCompleted(),
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),

            // Relations
            'creator' => $this->whenLoaded('creator', function () {
                return new MembreResource($this->creator);
            }),

            'assigned_members' => $this->whenLoaded('assignedMembers', function () {
                return MembreResource::collection($this->assignedMembers);
            }),
        ];
    }
}
