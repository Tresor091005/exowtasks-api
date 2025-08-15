<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\OpenAPIToTypeScript;

class GenerateTypescript extends Command
{
    protected $dir_path;

    protected $signature = 'typescript:generate
                            {--output=public/TypescriptTypes : Dossier de sortie}';

    protected $description = 'Génère les types TypeScript depuis OpenAPI';

    public function handle()
    {
        $this->dir_path = $this->option('output');
        
        $this->info('🔄 Génération des types TypeScript...');

        try {
            $generator = new OpenAPIToTypeScript();

            $typescriptPath = "{$this->dir_path}/api-types.ts";
            $readmePath = "{$this->dir_path}/README.md";

            $generator->saveToFile($typescriptPath);
            $this->info("✅ Types générés : {$typescriptPath}");

            $generator->generateSummary($readmePath);
            $this->info("✅ Fichier de résumé généré : {$readmePath}");

            $this->info("✅ Génération terminée avec succès!");
            return 0;

        } catch (\Exception $e) {
            $this->error("❌ Erreur : " . $e->getMessage());
            return 1;
        } 
    }
}
