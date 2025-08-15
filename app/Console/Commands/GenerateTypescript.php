<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Dedoc\Scramble\Scramble;
use App\Services\OpenAPIToTypeScript;
use Illuminate\Support\Facades\Artisan;

class GenerateTypescript extends Command
{
    protected $signature = 'typescript:generate
                            {--watch : Surveiller les changements}
                            {--output=public/js/types/api.ts : Fichier de sortie}';

    protected $description = 'Génère les types TypeScript depuis OpenAPI';

    public function handle()
    {
        if ($this->option('watch')) {
            $this->watchAndGenerate();
        } else {
            $this->generateOnce();
        }
    }

    private function generateOnce()
    {
        $this->info('🔄 Génération des types TypeScript...');

        try {
            // Générer le JSON OpenAPI depuis Scramble
            $jsonPath = public_path('api.json');
            Artisan::call('scramble:export', ['--path' => $jsonPath]);

            // Générer les types TypeScript
            $generator = new OpenAPIToTypeScript($jsonPath);
            $outputPath = $this->option('output');

            $generator->saveToFile($outputPath);

            $this->info("✅ Types générés : {$outputPath}");

        } catch (\Exception $e) {
            $this->error("❌ Erreur : " . $e->getMessage());
            return 1;
        }
    }

    private function watchAndGenerate()
    {
        $this->info('👀 Surveillance des changements activée...');

        $lastModified = 0;
        $watchPaths = [
            app_path('Http/Controllers'),
            app_path('Http/Requests'),
            app_path('Http/Resources'),
            app_path('Models'),
        ];

        while (true) {
            $currentModified = $this->getLastModifiedTime($watchPaths);

            if ($currentModified > $lastModified) {
                $this->info('🔄 Changements détectés, régénération...');
                $this->generateOnce();
                $lastModified = $currentModified;
            }

            sleep(2); // Vérifier toutes les 2 secondes
        }
    }

    private function getLastModifiedTime(array $paths): int
    {
        $lastModified = 0;

        foreach ($paths as $path) {
            if (is_dir($path)) {
                $iterator = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($path)
                );

                foreach ($iterator as $file) {
                    if ($file->isFile() && $file->getExtension() === 'php') {
                        $lastModified = max($lastModified, $file->getMTime());
                    }
                }
            }
        }

        return $lastModified;
    }
}
