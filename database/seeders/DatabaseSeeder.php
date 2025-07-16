<?php

namespace Database\Seeders;

use App\Enums\MembreRole;
use App\Models\Equipe;
use App\Models\Membre;
use App\Models\Tache;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // équipes
        $equipeA = Equipe::factory()->create([
            'name' => 'Equipe A',
            'slug' => 'equipe-a',
        ]);
        $equipeH = Equipe::factory()->create([
            'name' => 'Equipe H',
            'slug' => 'equipe-h',
        ]);

        // managers
        $managerA = Membre::factory()->create([
            'first_name' => 'Rodrigue',
            'last_name' => 'Agossou',
            'email' => 'rodrigue.agossou@gmail.com',
            'role' => MembreRole::MANAGER->value,
            'team_id' => $equipeA->id
        ]);

        $managerH = Membre::factory()->create([
            'first_name' => 'Grâce',
            'last_name' => 'Tchokponhoué',
            'email' => 'grace.tchokponhoue@yahoo.fr',
            'role' => MembreRole::MANAGER->value,
            'team_id' => $equipeH->id
        ]);

        // membresA
        $membresA = [
            [
                'first_name' => 'Ulrich',
                'last_name' => 'Sogbossi',
                'email' => 'ulrich.sogbossi@yahoo.fr',
                'role' => MembreRole::DEVELOPER->value,
                'team_id' => $equipeA->id,
            ],
            [
                'first_name' => 'Christelle',
                'last_name' => 'Houndété',
                'email' => 'christelle.houndete@gmail.com',
                'role' => MembreRole::DEVELOPER->value,
                'team_id' => $equipeA->id,
            ],
            [
                'first_name' => 'Landry',
                'last_name' => 'Gnonlonfoun',
                'email' => 'landry.gnonlonfoun@yahoo.fr',
                'role' => MembreRole::DESIGNER->value,
                'team_id' => $equipeA->id,
            ],
            [
                'first_name' => 'Prisca',
                'last_name' => 'Kpochémè',
                'email' => 'prisca.kpocheme@gmail.com',
                'role' => MembreRole::DEVELOPER->value,
                'team_id' => $equipeA->id,
            ],
        ];

        $membresACreated = [];
        foreach ($membresA as $membre) {
            $membresACreated[] = Membre::factory()->create($membre);
        }

        // membresH
        $membresH = [
            [
                'first_name' => 'Germain',
                'last_name' => 'Ahissou',
                'email' => 'germain.ahissou@gmail.com',
                'role' => MembreRole::DESIGNER->value,
                'team_id' => $equipeH->id,
            ],
            [
                'first_name' => 'Éric',
                'last_name' => 'Dossou',
                'email' => 'eric.dossou@gmail.com',
                'role' => MembreRole::DESIGNER->value,
                'team_id' => $equipeH->id,
            ],
        ];

        $membresHCreated = [];
        foreach ($membresH as $membre) {
            $membresHCreated[] = Membre::factory()->create($membre);
        }

        // tâches pour l'équipe A
        $tachesA = [
            'Développer l\'interface utilisateur',
            'Configurer la base de données',
            'Créer les tests unitaires',
            'Optimiser les performances',
            'Concevoir les maquettes',
            'Intégrer l\'API REST',
            'Documenter le code',
            'Corriger les bugs critiques',
        ];

        foreach ($tachesA as $titre) {
            $tache = Tache::factory()->create([
                'title' => $titre,
                'created_by' => $managerA->id,
            ]);

            $membreAssigne = fake()->randomElement($membresACreated);
            $tache->assignedMembers()->attach($membreAssigne->id);
        }

        // Tâche assignée à plusieurs membres
        $tacheCollaborative = Tache::factory()->create([
            'title' => 'Projet collaboratif équipe A',
            'created_by' => $managerA->id,
        ]);

        $tacheCollaborative->assignedMembers()->attach([
            $membresACreated[0]->id,
            $membresACreated[1]->id
        ]);

        // tâches pour l'équipe H
        $tachesH = [
            'Créer le design system',
            'Concevoir l\'identité visuelle',
            'Optimiser l\'UX mobile',
            'Créer les animations',
            'Valider l\'accessibilité',
        ];

        foreach ($tachesH as $titre) {
            $tache = Tache::factory()->create([
                'title' => $titre,
                'created_by' => $managerH->id,
            ]);

            $membreAssigne = fake()->randomElement($membresHCreated);
            $tache->assignedMembers()->attach($membreAssigne->id);
        }
    }
}
