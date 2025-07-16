<?php

namespace App\Services;

use App\Models\Membre;
use App\Http\Resources\V1\TacheResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class MembreService
{
    /**
     * Récupère les membres avec filtres
     */
    public function getMembres(array $filters = []): Collection
    {
        $query = Membre::with(['equipe', 'createdTasks', 'assignedTasks']);

        // Filtre par rôle
        if (!empty($filters['role'])) {
            $query->where('role', $filters['role']);
        }

        // Filtre par équipe
        if (!empty($filters['team_id'])) {
            $query->where('team_id', $filters['team_id']);
        }

        // Filtre par email
        if (!empty($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }

        // Filtre par nom (prénom ou nom)
        if (!empty($filters['name'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('first_name', 'like', '%' . $filters['name'] . '%')
                    ->orWhere('last_name', 'like', '%' . $filters['name'] . '%');
            });
        }

        // Filtre par date d'entrée
        if (!empty($filters['joined_at'])) {
            $query->whereDate('joined_at', $filters['joined_at']);
        }

        if (!empty($filters['joined_after'])) {
            $query->where('joined_at', '>=', $filters['joined_after']);
        }

        if (!empty($filters['joined_before'])) {
            $query->where('joined_at', '<=', $filters['joined_before']);
        }

        // Tri
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortDirection = $filters['sort_direction'] ?? 'desc';
        $query->orderBy($sortBy, $sortDirection);

        return $query->get();
    }

    /**
     * Crée un nouveau membre
     */
    public function createMembre(array $data): Membre
    {
        if (!isset($data['joined_at'])) {
            $data['joined_at'] = now();
        }

        $data['password'] = Hash::make('password');

        $membre = Membre::create($data);

        return $membre->load(['equipe', 'createdTasks', 'assignedTasks']);
    }

    /**
     * Met à jour un membre
     */
    public function updateMembre(Membre $membre, array $data): Membre
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $membre->update($data);

        return $membre->load(['equipe', 'createdTasks', 'assignedTasks']);
    }

    /**
     * Supprime un membre
     */
    public function deleteMembre(Membre $membre): bool
    {
        $membre->assignedTasks()->detach();
        $membre->createdTasks()->delete();

        return $membre->delete();
    }
}
