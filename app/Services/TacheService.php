<?php

namespace App\Services;

use App\Models\Membre;
use App\Models\Tache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TacheService
{
    /**
     * Récupère les tâches avec filtres
     */
    public function getTaches(array $filters = []): Collection
    {
        $query = Tache::with(['assignedMembers', 'creator']);

        // Filtre par statut
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        // Filtre par membre assigné
        if (!empty($filters['member_id'])) {
            $query->whereHas('assignedMembers', function ($q) use ($filters) {
                $q->where('member_id', $filters['member_id']);
            });
        }

        // Filtre par date limite
        if (!empty($filters['due_date'])) {
            $query->whereDate('due_date', $filters['due_date']);
        }

        if (!empty($filters['due_before'])) {
            $query->where('due_date', '<=', $filters['due_before']);
        }

        if (!empty($filters['due_after'])) {
            $query->where('due_date', '>=', $filters['due_after']);
        }

        // Filtre par créateur
        if (!empty($filters['created_by'])) {
            $query->where('created_by', $filters['created_by']);
        }

        // Tri
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortDirection = $filters['sort_direction'] ?? 'desc';
        $query->orderBy($sortBy, $sortDirection);

        return $query->get();
    }

    /**
     * Crée une nouvelle tâche
     */
    public function createTache(array $data): Tache
    {
        $Tache = Tache::create($data);

        if (!empty($data['assigned_members'])) {
            $Tache->assignedMembers()->attach($data['assigned_members']);
        }

        return $Tache->load(['assignedMembers', 'creator']);
    }

    /**
     * Met à jour une tâche
     */
    public function updateTache(Tache $Tache, array $data): Tache
    {
        $Tache->update($data);

        if (isset($data['assigned_members'])) {
            $Tache->assignedMembers()->sync($data['assigned_members']);
        }

        return $Tache->load(['assignedMembers', 'creator']);
    }

    /**
     * Supprime une tâche
     */
    public function deleteTache(Tache $Tache): bool
    {
        $Tache->assignedMembers()->detach();

        return $Tache->delete();
    }

    /**
     * Assigne des membres à une tâche
     */
    public function assignMembers(Tache $Tache, array $memberIds): void
    {
        $existingMembers = Membre::whereIn('id', $memberIds)->pluck('id')->toArray();

        if (count($existingMembers) !== count($memberIds)) {
            $missingIds = array_diff($memberIds, $existingMembers);
            throw new \InvalidArgumentException(
                'Les membres suivants n\'existent pas : ' . implode(', ', $missingIds)
            );
        }

        $alreadyAssigned = $Tache->assignedMembers()->whereIn('member_id', $memberIds)->pluck('member_id')->toArray();
        $newAssignments = array_diff($memberIds, $alreadyAssigned);

        if (!empty($newAssignments)) {
            $Tache->assignedMembers()->attach($newAssignments);
        }
    }

    /**
     * Désassigne des membres d'une tâche
     */
    public function unassignMembers(Tache $Tache, array $memberIds): void
    {
        $assignedMembers = $Tache->assignedMembers()->whereIn('member_id', $memberIds)->pluck('member_id')->toArray();

        if (!empty($assignedMembers)) {
            $Tache->assignedMembers()->detach($assignedMembers);
        }
    }
}
