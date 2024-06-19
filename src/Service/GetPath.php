<?php

namespace App\Service;

use Symfony\Component\Yaml\Yaml;

class GetPath
{
    // Propriété publique
    public $rootDirectory;

    // Propriétés privées
    private $pathToConfigDirectory;
    private $stringToCheck = "- { path: ^/admin, roles: ROLE_ADMIN }";
    private $pattern = '/^\s*- \{ path: \^\/admin, roles: ROLE_ADMIN \}\s*$/m';
    private $patterm = '/^\s*[^#]-\s*\{ path: \^\/admin, roles: ROLE_ADMIN \}\s*$/m';

    // private $replacement = '#$0';
    private $replacement = "\t\t# - { path: ^/admin, roles: ROLE_ADMIN }";
    private $decommenter = "\t\t - { path: ^/admin, roles: ROLE_ADMIN }";

    public function __construct()
    {
        // Initialisation des propriétés dans le constructeur
        $this->rootDirectory = realpath(__DIR__ . '/..');
        $this->pathToConfigDirectory = realpath(__DIR__ . '/../../config/packages');
    }

    public function getDirPathBis()
    {
        // Chemin complet vers le fichier 'security.yaml'
        $pathToSecurityYaml = $this->pathToConfigDirectory . '/security.yaml';
        if (self::checkFilePermission($pathToSecurityYaml)) {

            $fileContents = file_get_contents($pathToSecurityYaml);
            // dump(preg_match($this->patterm, $fileContents));dd('bol');
            if (preg_match($this->pattern, $this->stringToCheck)) {
                // Utilisation de preg_replace pour commenter la ligne
                $fileContentsUpdated = preg_replace($this->pattern, $this->decommenter, $fileContents);

                if ($fileContentsUpdated === null) {
                    // Gestion de l'erreur si la regex échoue (syntaxe invalide ou autre)
                    throw new \RuntimeException("La modification du fichier a échoué.");
                }
                $result = file_put_contents($pathToSecurityYaml, $fileContentsUpdated);

                if ($result === false) {
                    // Gestion de l'erreurf si l'écriture échoue
                    throw new \RuntimeException("Impossible d'écrire dans le fichier YAML : {$pathToSecurityYaml}");
                }

                // Indiquer que la ligne a été commentée avec succès
                echo "Ligne commentée avec succès.";
            } else {
                echo "Ligne non commentée.";
            }
        }
    }

    public function checkFilePermission($file)
    {
        // if (!file_exists($this->pathToSecurityYaml)) {
        if (!file_exists($file)) {
            // Obtient les permissions du fichier
            $permissions = fileperms($file);

            // Affiche les permissions sous forme de mode octal
            dump('Permissions du fichier : ' . decoct($permissions & 0777));

            return false;
        }

        $permissions = fileperms($file);

        if (!($permissions & 0200)) {
            return false;
            // Vérifie si le fichier est inscriptible pour le propriétaire
            // throw new \RuntimeException("Le fichier {$file} n'est pas inscriptible.");
        }

        return true;
    }
}
