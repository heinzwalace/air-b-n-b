<?php

namespace App\Controller\Admin;

use App\Entity\Locataire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LocataireCrudController extends AbstractCrudController
{

    use Trait\CombinedActionsTrait;

    public int $genre = 2;

    public static function getEntityFqcn(): string
    {
        return Locataire::class;
    }

    public function __construct()
    {
        // $this->genre = 2; 

        $this->setEntityName($this->extractEntityName(self::getEntityFqcn()));
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Résidences')
            // ->setPageTitle('detail', 'voir Résidence')
            ->setPageTitle('detail', fn (Locataire $locataire) => (string) $locataire);

        // ->setPageTitle('edit', 'Modifier Réservation')
        // ->setPageTitle('detail', 'Détails de la Réservation');
    }
}
