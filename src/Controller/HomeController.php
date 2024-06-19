<?php

namespace App\Controller;

use App\Service\GetPath;
use App\Service\MailerService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(MailerService $mailer)
    {
        $button = "home";

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'button' => $button
        ]);
    }

    #[Route('/unset_admin', name: 'unset_admin')]
    public function unsetAdmin(MailerService $mailer, GetPath $getPath)
    {
        // dump($getPath->getDirPath());
        // dump($getPath->getParentDirectoryPath());
        $getPath->getDirPathBis();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'button' => 'admin',
        ]);

            // Lire le contenu du fichier
        //     $content = file_get_contents($filePath);
        //     if ($content === false) {
        //         die("Unable to read the file.");
        //     }
        
        //     // La ligne à rechercher
        //     $search = '/^(\s*-\s*\{ path: \^\/admin, roles: )(ROLE_ADMIN)( \})/m';
        
        //     // La ligne de remplacement
        //     $replace = '$1ROLE_SUPER_ADMIN$3';
        
        //     // Modifier le contenu
        //     $newContent = preg_replace($search, $replace, $content);
        
        //     if ($newContent === null) {
        //         die("Error occurred during the modification process.");
        //     }
        
        //     // Écrire le contenu modifié dans le fichier
        //     $result = file_put_contents($filePath, $newContent);
        //     if ($result === false) {
        //         die("Unable to write to the file.");
        //     }
        
        //     echo "The file '$filePath' has been updated successfully.";


        // $button = "unset admin";
        // return $this->render('home/index.html.twig', [
        //     'controller_name' => 'role_adminer',
        //     'button' => $button
        // ]);
    }

   
}
