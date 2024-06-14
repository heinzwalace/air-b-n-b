<?php

namespace App\Controller\Admin;

use App\Entity\Locataire;
use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReservationCrudController extends AbstractCrudController
{
    use Trait\CombinedActionsTrait;

    public int $genre = 1;

    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Réservation')
            ->setEntityLabelInPlural('Réservations')
            ->setPageTitle('new', 'nouvelle réservation')
            ->setSearchFields(['id', 'debut', 'fin']);
    }

    public function __construct()
    {
        $this->genre = 1; // ou 2 selon votre préférence
        $this->setEntityName($this->extractEntityName(self::getEntityFqcn()));
    }

    public function getGenre(): int
    {
        return $this->genre;
    }

    public function setGenre(int $genre): void
    {
        $this->genre = $genre;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Champs non mappés pour Locataire
            TextField::new('lastname')->setFormTypeOption('mapped', false)->setLabel('Nom'),
            TextField::new('firstname')->setFormTypeOption('mapped', false)->setLabel('prénom'),
            TelephoneField::new('telephone')->setFormTypeOption('mapped', false),
            EmailField::new('email')->setFormTypeOption('mapped', false),
            DateField::new('debut')->setLabel('arrivée'),
            DateField::new('fin')->setLabel('départ'),
            IntegerField::new('nb_jours')->hideOnForm()
        ];
    }

    
}
