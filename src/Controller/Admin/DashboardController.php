<?php

namespace App\Controller\Admin;

use App\Entity\Country;
use App\Entity\Locataire;
use App\Entity\Reservation;
use App\Entity\Residence;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
        
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $url = $this->adminUrlGenerator
               ->setController(ResidenceCrudController::class)
               ->generateUrl();

        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        ->setTitle('<h4 class="text-danger fw-bold">Sophia Air B N B</h1>');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau2bord');

        yield MenuItem::subMenu('Résidences',  'fa fa-home')->setSubItems([
            MenuItem::linkToCrud('Gérer résidences', 'fas fa-plus', Residence::class)
        ]);

        yield MenuItem::linkToCrud('Gérer les locataires', 'fas fa-user', Locataire::class);


        yield MenuItem::linkToCrud('Réservations', 'fa fa-book', Reservation::class);

        yield MenuItem::subMenu('Administrateur', 'fa-solid fa-lock')->setSubItems([
            MenuItem::linkToCrud('droits admin', 'fa-solid fa-lock', User::class),
            MenuItem::linkToCrud('pays de résidence', 'fa fa-globe', Country::class)
        ]);

    }

}
