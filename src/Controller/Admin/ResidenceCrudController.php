<?php

namespace App\Controller\Admin;

use App\Entity\Residence;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ResidenceCrudController extends AbstractCrudController
{

    use Trait\CombinedActionsTrait; 

    public int $genre = 1;

    public static function getEntityFqcn(): string
    {
        return Residence::class;
    }

    public function __construct()
    {
        $this->setEntityName($this->extractEntityName(self::getEntityFqcn()));
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            IntegerField::new('rooms')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Résidences')
            ->setPageTitle('detail', 'voir Résidence');
            // ->setPageTitle('edit', 'Modifier Réservation')
            // ->setPageTitle('detail', 'Détails de la Réservation');
    }
    
}
