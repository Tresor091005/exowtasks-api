<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\V1\StoreEquipeRequest;
use App\Http\Requests\V1\UpdateEquipeRequest;
use App\Http\Resources\V1\EquipeResource;
use App\Models\Equipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipeController extends BaseController
{
    /**
     * Affiche la liste des équipes
     */
    public function index(Request $request): JsonResponse
    {
        $query = Equipe::query()->with('membres');

        // Filtrage par nom si fourni
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $teams = $query->get();

        return $this->successResponse(
            EquipeResource::collection($teams),
            'Équipes récupérées avec succès'
        );
    }

    /**
     * Crée une nouvelle équipe
     */
    public function store(StoreEquipeRequest $request): JsonResponse
    {
        $team = Equipe::create($request->validated());

        return $this->createdResponse(
            new EquipeResource($team),
            'Équipe créée avec succès'
        );
    }

    /**
     * Affiche une équipe spécifique
     */
    public function show(Equipe $team): JsonResponse
    {
        $team->load('membres');

        return $this->successResponse(
            new EquipeResource(resource: $team),
            'Équipe récupérée avec succès'
        );
    }

    /**
     * Met à jour une équipe
     */
    public function update(UpdateEquipeRequest $request, Equipe $team): JsonResponse
    {
        $team->update($request->validated());

        return $this->successResponse(
            new EquipeResource($team),
            'Équipe mise à jour avec succès'
        );
    }

    /**
     * Supprime une équipe avec toutes ses données associées
     */
    public function destroy(Equipe $team): JsonResponse
    {
        DB::beginTransaction();

        try {
            $membres = $team->membres;

            foreach ($membres as $membre) {
                $membre->assignedTasks()->detach();
                $membre->createdTasks()->delete();
            }

            $team->membres()->delete();
            $team->delete();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();

            return $this->errorResponse(
                'Erreur lors de la suppression de l\'équipe',
                500,
                $e->getMessage()
            );
        }

        return $this->deletedResponse('Équipe supprimée avec succès');
    }
}
