<?php

namespace App\Controller;

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
        // try{
        //     $mailer->sendWelcomeEmail();

           
        // }catch(Exception $e){
        //     dump($e);
        //     echo 'une erreur est survenue!';
        // }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

   
}
