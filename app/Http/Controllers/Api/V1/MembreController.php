<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\V1\StoreMembreRequest;
use App\Http\Requests\V1\UpdateMembreRequest;
use App\Http\Resources\V1\MembreResource;
use App\Http\Resources\V1\TacheResource;
use App\Models\Membre;
use App\Services\MembreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MembreController extends BaseController
{
    protected MembreService $membreService;

    public function __construct(MembreService $membreService)
    {
        $this->membreService = $membreService;
    }

    /**
     * Affiche la liste des membres avec filtres
     */
    public function index(Request $request): JsonResponse
    {
        $membres = $this->membreService->getMembres($request->all());

        return $this->successResponse(
            MembreResource::collection($membres),
            'Membres récupérés avec succès'
        );
    }

    /**
     * Crée un nouveau membre
     */
    public function store(StoreMembreRequest $request): JsonResponse
    {
        $member = $this->membreService->createMembre($request->validated());

        return $this->createdResponse(
            new MembreResource($member),
            'Membre créé avec succès'
        );
    }

    /**
     * Affiche un membre spécifique
     */
    public function show(Membre $member): JsonResponse
    {
        $member->load(['equipe', 'createdTasks', 'assignedTasks']);

        return $this->successResponse(
            new MembreResource($member),
            'Membre récupéré avec succès'
        );
    }

    /**
     * Met à jour un membre
     */
    public function update(UpdateMembreRequest $request, Membre $member): JsonResponse
    {
        $member = $this->membreService->updateMembre($member, $request->validated());

        return $this->successResponse(
            new MembreResource($member),
            'Membre mis à jour avec succès'
        );
    }

    /**
     * Supprime un membre
     */
    public function destroy(Membre $member): JsonResponse
    {
        $this->membreService->deleteMembre($member);

        return $this->deletedResponse('Membre supprimé avec succès');
    }
}
