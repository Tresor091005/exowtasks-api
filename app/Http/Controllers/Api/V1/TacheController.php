<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\V1\StoreTacheRequest;
use App\Http\Requests\V1\UpdateTacheRequest;
use App\Http\Resources\V1\TacheResource;
use App\Models\Tache;
use App\Services\TacheService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TacheController extends BaseController
{
    protected TacheService $TacheService;

    public function __construct(TacheService $TacheService)
    {
        $this->TacheService = $TacheService;
    }

    /**
     * Affiche la liste des tâches avec filtres
     */
    public function index(Request $request): JsonResponse
    {
        $Taches = $this->TacheService->getTaches($request->all());

        return $this->successResponse(
            TacheResource::collection($Taches),
            'Tâches récupérées avec succès'
        );
    }

    /**
     * Crée une nouvelle tâche
     */
    public function store(StoreTacheRequest $request): JsonResponse
    {
        $task = $this->TacheService->createTache($request->validated());

        return $this->createdResponse(
            new TacheResource($task),
            'Tâche créée avec succès'
        );
    }

    /**
     * Affiche une tâche spécifique
     */
    public function show(Tache $task): JsonResponse
    {
        $task->load(['assignedMembers', 'creator']);

        return $this->successResponse(
            new TacheResource($task),
            'Tâche récupérée avec succès'
        );
    }

    /**
     * Met à jour une tâche
     */
    public function update(UpdateTacheRequest $request, Tache $task): JsonResponse
    {
        // TODO: autorisation manager - connexion membre
        // Vérifier si l'utilisateur peut modifier cette tâche
        // $this->authorize('update', $task);

        $task = $this->TacheService->updateTache($task, $request->validated());

        return $this->successResponse(
            new TacheResource($task),
            'Tâche mise à jour avec succès'
        );
    }

    /**
     * Supprime une tâche
     */
    public function destroy(Tache $task): JsonResponse
    {
        // Vérifier si l'utilisateur peut supprimer cette tâche
        // $this->authorize('delete', $task);

        $this->TacheService->deleteTache($task);

        return $this->deletedResponse('Tâche supprimée avec succès');
    }

    /**
     * Assigne des membres à une tâche
     */
    // public function assign(AssignTacheRequest $request, Tache $task): JsonResponse
    // {
    //     $this->TacheService->assignMembers($task, $request->validated()['member_ids']);

    //     return $this->successResponse(
    //         new TacheResource($task->fresh(['assignedMembers'])),
    //         'Members assigned to Tache successfully'
    //     );
    // }

    /**
     * Désassigne des membres d'une tâche
     */
    // public function unassign(AssignTacheRequest $request, Tache $task): JsonResponse
    // {
    //     $this->TacheService->unassignMembers($task, $request->validated()['member_ids']);

    //     return $this->successResponse(
    //         new TacheResource($task->fresh(['assignedMembers'])),
    //         'Members unassigned from Tache successfully'
    //     );
    // }
}
