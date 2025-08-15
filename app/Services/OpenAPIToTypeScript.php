<?php

namespace App\Services;

class OpenAPIToTypeScript
{
    private $apiSpec;
    private $generatedTypes = [];

    public function __construct($jsonFile)
    {
        echo $jsonFile;
        $jsonContent = file_get_contents($jsonFile);
        $this->apiSpec = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Erreur de parsing JSON: ' . json_last_error_msg());
        }
    }

    public function generateTypeScript()
    {
        $output = "// Types générés automatiquement depuis l'API OpenAPI\n";
        $output .= "// Ne pas modifier manuellement\n\n";

        // Générer les types de base
        $output .= $this->generateBaseTypes();

        // Générer les interfaces pour les ressources
        $output .= $this->generateSchemaInterfaces('Resource', '// Interfaces des ressources');

        // Générer les types de requêtes
        $output .= $this->generateSchemaInterfaces('Request', '// Interfaces des requêtes');

        // Générer les interfaces pour les endpoints avec la nouvelle nomenclature
        $output .= $this->generateEndpointInterfaces();

        // Générer les types utilitaires
        $output .= $this->generateUtilityTypes();

        return $output;
    }

    private function generateBaseTypes()
    {
        $output = "// Types de base\n";
        $output .= "export interface BaseApiResponse {\n";
        $output .= "  success: boolean;\n";
        $output .= "  message: string;\n";
        $output .= "}\n\n";

        $output .= "export interface ApiSuccessResponse<T = any> extends BaseApiResponse {\n";
        $output .= "  success: true;\n";
        $output .= "  data: T;\n";
        $output .= "}\n\n";

        $output .= "export interface ApiErrorResponse extends BaseApiResponse {\n";
        $output .= "  success: false;\n";
        $output .= "}\n\n";

        return $output;
    }

    private function generateSchemaInterfaces($suffix, $comment)
    {
        $output = "$comment\n";

        if (isset($this->apiSpec['components']['schemas'])) {
            foreach ($this->apiSpec['components']['schemas'] as $schemaName => $schema) {
                $shouldInclude = strpos($schemaName, $suffix) !== false;

                if ($shouldInclude) {
                    $output .= $this->generateInterface($schemaName, $schema);
                }
            }
        }

        return $output;
    }

    private function generateInterface($name, $schema)
    {
        $output = "export interface {$name} {\n";

        if (isset($schema['properties'])) {
            foreach ($schema['properties'] as $propName => $propSchema) {
                $type = $this->convertToTypeScriptType($propSchema);
                $optional = !in_array($propName, $schema['required'] ?? []) ? '?' : '';

                // Ajouter commentaire si description disponible
                if (isset($propSchema['description'])) {
                    $output .= "  /** {$propSchema['description']} */\n";
                }

                $output .= "  {$propName}{$optional}: {$type};\n";
            }
        }

        $output .= "}\n\n";
        return $output;
    }

    private function convertToTypeScriptType($schema)
    {
        // Gestion des références
        if (isset($schema['$ref'])) {
            $ref = str_replace('#/components/schemas/', '', $schema['$ref']);
            return $ref;
        }

        // Gestion des types avec enum
        if (isset($schema['enum'])) {
            $enumValues = array_map(function($val) {
                return is_string($val) ? "'$val'" : $val;
            }, $schema['enum']);
            return implode(' | ', $enumValues);
        }

        // Gestion des types multiples (union types)
        if (isset($schema['type']) && is_array($schema['type'])) {
            $types = array_map([$this, 'mapJsonTypeToTS'], $schema['type']);
            return implode(' | ', $types);
        }

        // Gestion des objets complexes avec properties
        if (isset($schema['type']) && $schema['type'] === 'object') {
            if (isset($schema['properties'])) {
                // Objet avec propriétés définies
                $output = "{\n";
                foreach ($schema['properties'] as $propName => $propSchema) {
                    $type = $this->convertToTypeScriptType($propSchema);
                    $optional = !in_array($propName, $schema['required'] ?? []) ? '?' : '';
                    $output .= "    {$propName}{$optional}: {$type};\n";
                }
                $output .= "  }";
                return $output;
            } elseif (isset($schema['additionalProperties'])) {
                // Objet avec propriétés dynamiques
                $valueType = $this->convertToTypeScriptType($schema['additionalProperties']);
                return "Record<string, {$valueType}>";
            } else {
                return 'Record<string, any>';
            }
        }

        // Gestion des tableaux
        if (isset($schema['type']) && $schema['type'] === 'array') {
            if (isset($schema['items'])) {
                $itemType = $this->convertToTypeScriptType($schema['items']);
                return "{$itemType}[]";
            }
            return 'any[]';
        }

        // Types de base
        if (isset($schema['type'])) {
            return $this->mapJsonTypeToTS($schema['type']);
        }

        return 'any';
    }

    private function mapJsonTypeToTS($jsonType)
    {
        $mapping = [
            'string' => 'string',
            'integer' => 'number',
            'number' => 'number',
            'boolean' => 'boolean',
            'null' => 'null',
            'object' => 'Record<string, any>',
            'array' => 'any[]'
        ];

        return $mapping[$jsonType] ?? 'any';
    }

    private function generateEndpointInterfaces()
    {
        $output = "// Interfaces des endpoints (nomenclature: METHOD_PATH_ACTION)\n";
        $endpoints = [];

        foreach ($this->apiSpec['paths'] as $path => $pathData) {
            foreach ($pathData as $method => $endpointData) {
                if (in_array($method, ['get', 'post', 'put', 'delete', 'patch'])) {
                    $endpointPrefix = $this->generateEndpointPrefix($method, $path);
                    $interfaces = $this->generateEndpointInterface($endpointPrefix, $endpointData);
                    $endpoints = array_merge($endpoints, $interfaces);
                }
            }
        }

        foreach ($endpoints as $interface) {
            $output .= $interface;
        }

        return $output;
    }

    private function generateEndpointPrefix($method, $path)
    {
        // Conversion : POST /tasks/{task}/assign -> POST_TASKS_TASK_ASSIGN
        $methodUpper = strtoupper($method);

        // Nettoyer le path et convertir en segments
        $cleanPath = trim($path, '/');
        $segments = explode('/', $cleanPath);

        $pathParts = [];
        foreach ($segments as $segment) {
            if (str_starts_with($segment, '{') && str_ends_with($segment, '}')) {
                // Paramètre de path : {task} -> TASK
                $param = trim($segment, '{}');
                $pathParts[] = strtoupper($param);
            } else {
                // Segment normal : tasks -> TASKS
                $pathParts[] = strtoupper($segment);
            }
        }

        $pathString = implode('_', $pathParts);
        return "{$methodUpper}_{$pathString}";
    }

    private function generateEndpointInterface($prefix, $endpointData)
    {
        $interfaces = [];
        $responses = $endpointData['responses'] ?? [];

        foreach ($responses as $statusCode => $responseData) {
            if ($statusCode >= 200 && $statusCode < 300) {
                // Réponse de succès
                $interfaces[] = $this->generateSuccessInterface($prefix, $responseData, $statusCode);
            } else {
                // Réponse d'erreur
                $interfaces[] = $this->generateErrorInterface($prefix, $responseData, $statusCode);
            }
        }

        return $interfaces;
    }

    private function generateSuccessInterface($prefix, $responseData, $statusCode)
    {
        $interfaceName = "{$prefix}_SUCCESS_RESPONSE";

        $output = "export interface {$interfaceName} extends ApiSuccessResponse {\n";

        if (isset($responseData['content']['application/json']['schema'])) {
            $schema = $responseData['content']['application/json']['schema'];

            if (isset($schema['properties']['data'])) {
                $dataType = $this->convertToTypeScriptType($schema['properties']['data']);
                $output .= "  data: {$dataType};\n";
            } elseif (isset($schema['properties']) && count($schema['properties']) > 2) {
                // Cas où la réponse a une structure complexe au niveau racine
                $output .= "  // Structure de réponse complexe détectée\n";
                foreach ($schema['properties'] as $propName => $propSchema) {
                    if (!in_array($propName, ['success', 'message'])) {
                        $type = $this->convertToTypeScriptType($propSchema);
                        $optional = !in_array($propName, $schema['required'] ?? []) ? '?' : '';
                        $output .= "  {$propName}{$optional}: {$type};\n";
                    }
                }
            }
        }

        $output .= "}\n\n";
        return $output;
    }

    private function generateErrorInterface($prefix, $responseData, $statusCode)
    {
        $interfaceName = "{$prefix}_ERROR_{$statusCode}";

        $output = "export interface {$interfaceName} extends ApiErrorResponse {\n";

        $hasErrors = false;
        $errorsType = null;

        // Cas spécifique : 422 a toujours des erreurs de validation
        if ($statusCode == 422) {
            $hasErrors = true;
            $errorsType = "Record<string, string[]>";
        }

        // Analyser le schema pour détecter la propriété errors
        if (isset($responseData['content']['application/json']['schema'])) {
            $schema = $responseData['content']['application/json']['schema'];
            if (isset($schema['properties']['errors'])) {
                $hasErrors = true;
                $errorsType = $this->convertToTypeScriptType($schema['properties']['errors']);
            }
        }

        if ($hasErrors && $errorsType) {
            $output .= "  errors: {$errorsType};\n";
        }

        // Ajouter les autres propriétés spécifiques (si elles existent dans le schema)
        if (isset($responseData['content']['application/json']['schema'])) {
            $schema = $responseData['content']['application/json']['schema'];
            if (isset($schema['properties'])) {
                foreach ($schema['properties'] as $propName => $propSchema) {
                    // Ignorer les propriétés de base et errors (déjà traité)
                    if (!in_array($propName, ['success', 'message', 'errors'])) {
                        $type = $this->convertToTypeScriptType($propSchema);
                        $optional = !in_array($propName, $schema['required'] ?? []) ? '?' : '';
                        $output .= "  {$propName}{$optional}: {$type};\n";
                    }
                }
            }
        }

        $output .= "}\n\n";
        return $output;
    }

    private function generateUtilityTypes()
    {
        $output = "// Types utilitaires\n";

        // Type union pour toutes les réponses d'un endpoint
        $output .= "export type ApiResponse<TSuccess, TError = ApiErrorResponse> = TSuccess | TError;\n\n";

        // Helper pour extraire le type de data d'une réponse
        $output .= "export type ExtractApiData<T> = T extends { data: infer D } ? D : never;\n\n";

        // Type pour les paramètres de path
        $output .= "export type PathParams = Record<string, string | number>;\n\n";

        // Type pour les query parameters
        $output .= "export type QueryParams = Record<string, any>;\n\n";

        return $output;
    }

    public function saveToFile($filename)
    {
        $content = $this->generateTypeScript();
        is_dir(dirname($filename)) || mkdir(dirname($filename), 0755, true);
        file_put_contents($filename, $content);
        echo "Fichier TypeScript généré : {$filename}\n";

        // Statistiques
        $lineCount = substr_count($content, "\n");
        $interfaceCount = substr_count($content, "export interface");
        echo "📊 Statistiques:\n";
        echo "  - {$lineCount} lignes générées\n";
        echo "  - {$interfaceCount} interfaces créées\n";
    }

    public function generateSummary()
    {
        $summary = "# Résumé des endpoints générés\n\n";

        foreach ($this->apiSpec['paths'] as $path => $pathData) {
            foreach ($pathData as $method => $endpointData) {
                if (in_array($method, ['get', 'post', 'put', 'delete', 'patch'])) {
                    $prefix = $this->generateEndpointPrefix($method, $path);
                    $summary .= "## {$prefix}\n";
                    $summary .= "**Endpoint:** `{$method} {$path}`\n";
                    $summary .= "**Description:** " . ($endpointData['summary'] ?? 'Non définie') . "\n";

                    $responses = $endpointData['responses'] ?? [];
                    $summary .= "**Réponses:**\n";
                    foreach ($responses as $statusCode => $responseData) {
                        if ($statusCode >= 200 && $statusCode < 300) {
                            $summary .= "- ✅ {$statusCode}: `{$prefix}_SUCCESS_RESPONSE`\n";
                        } else {
                            $summary .= "- ❌ {$statusCode}: `{$prefix}_ERROR_{$statusCode}`\n";
                        }
                    }
                    $summary .= "\n";
                }
            }
        }

        return $summary;
    }
}
